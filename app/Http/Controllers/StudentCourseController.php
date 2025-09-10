<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\CourseApplication;
use App\Models\FavoriteCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentCourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('university');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('instructor', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('language', 'like', "%{$search}%");
            });
        }
        
        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        
        // Filter by country
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        
        // Filter by price range
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 'free':
                    $query->where(function($q) {
                        $q->whereNull('cost')->orWhere('cost', 0);
                    });
                    break;
                case 'under_100':
                    $query->where('cost', '>', 0)->where('cost', '<', 100);
                    break;
                case '100_500':
                    $query->where('cost', '>=', 100)->where('cost', '<=', 500);
                    break;
                case 'over_500':
                    $query->where('cost', '>', 500);
                    break;
            }
        }
        
        $courses = $query->paginate(12);
        
        // Get filter options
        $types = Course::distinct()->pluck('type')->filter();
        $levels = Course::distinct()->pluck('level')->filter();
        $countries = Course::distinct()->pluck('country')->filter();
        
        // Get favorite course IDs and applied course IDs for current student
        $favoriteCourseIds = [];
        $appliedCourseIds = [];
        if (Auth::guard('student')->check()) {
            $student = Auth::guard('student')->user();
            $favoriteCourseIds = $student->favoriteCourses()->pluck('course_id')->toArray();
            $appliedCourseIds = $student->courseApplications()->pluck('course_id')->toArray();
        }
        
        return view('student.courses.index', compact('courses', 'types', 'levels', 'countries', 'favoriteCourseIds', 'appliedCourseIds'));
    }
    
    public function show($id)
    {
        $course = Course::with('university')->findOrFail($id);
        
        $isFavorite = false;
        $hasApplied = false;
        
        if (Auth::guard('student')->check()) {
            $student = Auth::guard('student')->user();
            $isFavorite = $student->favoriteCourses()->where('course_id', $id)->exists();
            $hasApplied = $student->courseApplications()->where('course_id', $id)->exists();
        }
        
        return view('student.courses.show', compact('course', 'isFavorite', 'hasApplied'));
    }
    
    public function apply(Request $request, $id)
    {
        if (!Auth::guard('student')->check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }
        
        $student = Auth::guard('student')->user();
        $course = Course::findOrFail($id);
        
        // Check if already applied
        $existingApplication = $student->courseApplications->where('course_id', $id)->first();
        if ($existingApplication) {
            return response()->json(['success' => false, 'message' => 'You have already applied to this course']);
        }
        
        // Create application
        CourseApplication::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => 'pending',
            'applied_at' => now(),
        ]);
        
        return response()->json(['success' => true, 'message' => 'Application submitted successfully']);
    }
    
    public function applyMultiple(Request $request)
    {
        if (!Auth::guard('student')->check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }
        
        $student = Auth::guard('student')->user();
        $courseIds = $request->course_ids;
        
        if (!is_array($courseIds) || empty($courseIds)) {
            return response()->json(['success' => false, 'message' => 'No courses selected']);
        }
        
        $successCount = 0;
        $errors = [];
        
        foreach ($courseIds as $courseId) {
            // Check if already applied
            $existingApplication = $student->courseApplications->where('course_id', $courseId)->first();
            if (!$existingApplication) {
                try {
                    CourseApplication::create([
                        'student_id' => $student->id,
                        'course_id' => $courseId,
                        'status' => 'pending',
                        'applied_at' => now(),
                    ]);
                    $successCount++;
                } catch (\Exception $e) {
                    $errors[] = "Failed to apply to course ID: {$courseId}";
                }
            }
        }
        
        return response()->json([
            'success' => $successCount > 0,
            'count' => $successCount,
            'message' => "Successfully applied to {$successCount} courses",
            'errors' => $errors
        ]);
    }
    
    public function toggleFavorite(Request $request, $id)
    {
        if (!Auth::guard('student')->check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }
        
        $student = Auth::guard('student')->user();
        $course = Course::findOrFail($id);
        
        $favorite = $student->favoriteCourses()->where('course_id', $id)->first();
        
        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed', 'message' => 'Course removed from favorites']);
        } else {
            FavoriteCourse::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
            ]);
            return response()->json(['status' => 'added', 'message' => 'Course added to favorites']);
        }
    }
    
    public function clearFavorites(Request $request)
    {
        if (!Auth::guard('student')->check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }
        
        $student = Auth::guard('student')->user();
        $student->favoriteCourses()->delete();
        
        return response()->json(['success' => true, 'message' => 'All favorites cleared successfully']);
    }
    
    public function favorites()
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('students.login');
        }
        
        $student = Auth::guard('student')->user();
        
        // جلب المقررات المفضلة
        $favoriteCourses = $student->favoriteCourses()->with('course.university')->get();
        
        // جلب المنح المفضلة
        $favoriteScholarships = \App\Models\FavoriteScholarship::where('student_id', $student->id)
            ->with('scholarship.university')
            ->get();
        
        // جلب البرامج المدفوعة المفضلة
        $favoritePaidPrograms = \App\Models\FavoritePaidProgram::where('student_id', $student->id)
            ->with('paidProgram.university')
            ->get();
        
        return view('student.favorites', compact('favoriteCourses', 'favoriteScholarships', 'favoritePaidPrograms'));
    }
    
    public function applications()
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('students.login');
        }
        
        $student = Auth::guard('student')->user();
        $applications = $student->courseApplications()->with('course.university')->orderBy('created_at', 'desc')->get();
        
        return view('student.courses.applications', compact('applications'));
    }
    
    public function withdrawApplication(Request $request, $id)
    {
        if (!Auth::guard('student')->check()) {
            return response()->json(['success' => false, 'message' => 'Please login first'], 401);
        }
        
        $student = Auth::guard('student')->user();
        $application = $student->courseApplications->findOrFail($id);
        
        if ($application->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Cannot withdraw a processed application']);
        }
        
        $application->delete();
        
        return response()->json(['success' => true, 'message' => 'Application withdrawn successfully']);
    }
    
    public function exportFavorites()
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('students.login');
        }
        
        $student = Auth::guard('student')->user();
        $favorites = $student->favoriteCourses()->with('course.university')->get();
        
        $filename = 'my_favorite_courses_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($favorites) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Course Name', 'University', 'Type', 'Level', 'Country', 'Language', 'Cost', 'Start Date', 'End Date']);
            
            foreach ($favorites as $favorite) {
                $course = $favorite->course;
                fputcsv($file, [
                    $course->name,
                    $course->university->name ?? 'N/A',
                    $course->type,
                    $course->level,
                    $course->country,
                    $course->language,
                    $course->cost == 0 ? 'Free' : '$' . number_format($course->cost, 2),
                    $course->start_date,
                    $course->end_date
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    public function exportApplications()
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('students.login');
        }
        
        $student = Auth::guard('student')->user();
        $applications = $student->courseApplications()->with('course.university')->get();
        
        $filename = 'my_course_applications_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Course Name', 'University', 'Type', 'Level', 'Status', 'Applied Date', 'Cost', 'Start Date']);
            
            foreach ($applications as $application) {
                $course = $application->course;
                fputcsv($file, [
                    $course->name,
                    $course->university->name ?? 'N/A',
                    $course->type,
                    $course->level,
                    ucfirst($application->status),
                    $application->applied_at ? $application->applied_at->format('Y-m-d H:i') : $application->created_at->format('Y-m-d H:i'),
                    $course->cost == 0 ? 'Free' : '$' . number_format($course->cost, 2),
                    $course->start_date
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}