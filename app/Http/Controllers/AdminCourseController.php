<?php

namespace App\Http\Controllers;
use App\Models\University;
use App\Models\Course;
use App\Models\CourseApplication;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminCourseController extends Controller
{
    // عرض جميع الكورسات مع الجامعة المرتبطة
    public function index()
    {
        $courses = Course::with('university')->get();

        return view('admin.courses.index', compact('courses'));
    }

    // عرض واجهة إنشاء كورس جديد
    public function create()
    {
        $universities = University::all();

        return view('admin.courses.create', compact('universities'));
    }

    // عرض تفاصيل كورس معين
    public function show($id)
    {
        $course = Course::with('university')->findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    // تخزين الكورس في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'university_ID' => 'required|exists:universities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'cost' => 'nullable|numeric|min:0',
            'type' => 'required|in:online,offline,hybrid',
            'country' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'level' => 'required|in:beginner,intermediate,advanced',
            'language' => 'required|string|max:100',
            'instructor' => 'nullable|string|max:255',
            'max_students' => 'nullable|integer|min:1',
            'uploaded_data' => 'nullable|json',
            'application_url' => 'nullable|url'
        ]);
        
        $course = Course::create([
            'university_ID' => $request->university_ID,
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cost' => $request->cost,
            'type' => $request->type,
            'country' => $request->country,
            'duration' => $request->duration,
            'level' => $request->level,
            'language' => $request->language,
            'instructor' => $request->instructor,
            'max_students' => $request->max_students,
            'uploaded_data' => $request->uploaded_data,
            'application_url' => $request->application_url,
        ]);

        return redirect()->route('admin.courses.index')->with('success','Course created successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        
        $universities = University::all();

        return view('admin.courses.edit', compact('course', 'universities'));
    }

    public function update(Request $request, $id)
    { 
        $request->validate([
            'university_ID' => 'required|exists:universities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'cost' => 'nullable|numeric|min:0',
            'type' => 'required|in:online,offline,hybrid',
            'country' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'level' => 'required|in:beginner,intermediate,advanced',
            'language' => 'required|string|max:100',
            'instructor' => 'nullable|string|max:255',
            'max_students' => 'nullable|integer|min:1',
            'uploaded_data' => 'nullable|json',
            'application_url' => 'nullable|url'
        ]); 

        $course = Course::findOrFail($id);
        
        $course->update([ 
            'university_ID' => $request->university_ID,
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cost' => $request->cost,
            'type' => $request->type,
            'country' => $request->country,
            'duration' => $request->duration,
            'level' => $request->level,
            'language' => $request->language,
            'instructor' => $request->instructor,
            'max_students' => $request->max_students,
            'uploaded_data' => $request->uploaded_data,
            'application_url' => $request->application_url,
        ]);

        return redirect()->route('admin.courses.index')->with('success','Course updated successfully.');
    }

    // حذف الكورس
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        $course->delete();
        
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }

    // البحث في الكورسات (للواجهة الأمامية)
    public function search(Request $request)
    {
        $query = Course::query();
    
        if ($request->filled('university')) {
            $query->whereHas('university', function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->university . '%');
            });
        }
    
        if ($request->filled('place')) {
            $query->where('country', 'LIKE', '%' . $request->place . '%');
        }
        
        if ($request->filled('type')) {
            $query->where('type', 'LIKE', '%' . $request->type . '%');
        }
        
        if ($request->filled('level')) {
            $query->where('level', 'LIKE', '%' . $request->level . '%');
        }
    
        $countries = Course::distinct()->get(['country']);
        
        $universities = University::distinct()->get(['name']);
        
        $types = Course::distinct()->get(['type']);
        
        $levels = Course::distinct()->get(['level']);
        
        $courses = $query->with('university')->get();
    
        return view('courses', compact('courses', 'universities', 'countries', 'types', 'levels'));
    }

    public function downloadCoursesPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $adminId = Auth::guard('admin')->id();

        // حفظ التقرير في قاعدة البيانات
        Report::create([
            'report_type' => 'Courses', 
            'start_date' => $startDate,
            'end_date' => $endDate,
            'generated_by' => $adminId,
        ]);

        // جلب الكورسات التي تم إنشاؤها بين التواريخ
        $courses = Course::with('university')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $htmlContent = '<h1 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">Courses Report</h1>';
        $htmlContent .= '<div style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #007bff;">';
        $htmlContent .= '<p style="margin: 0; font-size: 14px;"><strong>Report Date Range:</strong> ' . $startDate . ' to ' . $endDate . '</p>';
        $htmlContent .= '<p style="margin: 5px 0 0 0; font-size: 14px;"><strong>Total Courses:</strong> ' . $courses->count() . '</p>';
        $htmlContent .= '</div>';
        
        if ($courses->count() > 0) {
            $htmlContent .= '<table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; font-size: 12px;">';
            $htmlContent .= '<thead style="background-color: #007bff; color: white;">';
            $htmlContent .= '<tr>';
            $htmlContent .= '<th style="text-align: center;">ID</th>';
            $htmlContent .= '<th style="text-align: center;">Course Name</th>';
            $htmlContent .= '<th style="text-align: center;">University</th>';
            $htmlContent .= '<th style="text-align: center;">Type</th>';
            $htmlContent .= '<th style="text-align: center;">Level</th>';
            $htmlContent .= '<th style="text-align: center;">Country</th>';
            $htmlContent .= '<th style="text-align: center;">Cost</th>';
            $htmlContent .= '<th style="text-align: center;">Created At</th>';
            $htmlContent .= '</tr>';
            $htmlContent .= '</thead>';
            $htmlContent .= '<tbody>';

            foreach ($courses as $course) {
                $htmlContent .= '<tr style="border-bottom: 1px solid #dee2e6;">';
                $htmlContent .= '<td style="text-align: center; padding: 8px;">' . $course->id . '</td>';
                $htmlContent .= '<td style="padding: 8px;">' . htmlspecialchars($course->name) . '</td>';
                $htmlContent .= '<td style="padding: 8px;">' . htmlspecialchars($course->university->name ?? 'N/A') . '</td>';
                $htmlContent .= '<td style="text-align: center; padding: 8px;">' . ucfirst($course->type) . '</td>';
                $htmlContent .= '<td style="text-align: center; padding: 8px;">' . ucfirst($course->level) . '</td>';
                $htmlContent .= '<td style="text-align: center; padding: 8px;">' . $course->country . '</td>';
                $htmlContent .= '<td style="text-align: center; padding: 8px;">' . ($course->cost == 0 ? 'Free' : '$' . number_format($course->cost, 2)) . '</td>';
                $htmlContent .= '<td style="text-align: center; padding: 8px;">' . $course->created_at->format('Y-m-d') . '</td>';
                $htmlContent .= '</tr>';
            }

            $htmlContent .= '</tbody>';
            $htmlContent .= '</table>';
        } else {
            $htmlContent .= '<div style="text-align: center; padding: 40px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">';
            $htmlContent .= '<p style="font-size: 16px; color: #6c757d; margin: 0;">No courses found in the specified date range.</p>';
            $htmlContent .= '</div>';
        }

        $pdf = Pdf::loadHTML($htmlContent);

        return $pdf->download('courses_report_' . now()->format('Y-m-d') . '.pdf');
    }

    // عرض طلبات الكورسات
    public function applications()
    {
        $applications = CourseApplication::with(['student', 'course.university'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.courses.applications', compact('applications'));
    }

    // تحديث حالة طلب الكورس
    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,withdrawn',
            'notes' => 'nullable|string|max:500'
        ]);

        $application = CourseApplication::findOrFail($id);
        
        $application->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        $statusText = $request->status == 'approved' ? 'Approved' : ($request->status == 'rejected' ? 'Rejected' : ($request->status == 'withdrawn' ? 'Withdrawn' : 'Pending'));
        
        return redirect()->back()->with('success', 'Application status updated to: ' . $statusText);
    }

    // جلب تفاصيل طلب الكورس عبر AJAX
    public function getApplicationDetails($id)
    {
        $application = CourseApplication::with(['student', 'course.university'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'application' => [
                'id' => $application->id,
                'status' => $application->status,
                'applied_at' => $application->applied_at ? $application->applied_at->format('Y-m-d H:i:s') : null,
                'notes' => $application->notes,
                'created_at' => $application->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $application->updated_at->format('Y-m-d H:i:s'),
                'student' => [
                    'id' => $application->student->id,
                    'name' => $application->student->name,
                    'email' => $application->student->email,
                    'phone' => $application->student->phone ?? 'غير محدد',
                    'gender' => $application->student->gender ?? 'غير محدد',
                ],
                'course' => [
                    'id' => $application->course->id,
                    'name' => $application->course->name,
                    'description' => $application->course->description,
                    'start_date' => $application->course->start_date,
                    'end_date' => $application->course->end_date,
                    'cost' => $application->course->cost,
                    'type' => $application->course->type,
                    'level' => $application->course->level,
                    'language' => $application->course->language,
                    'country' => $application->course->country,
                    'university' => [
                        'name' => $application->course->university->name,
                        'location' => $application->course->university->location
                    ]
                ]
            ]
        ]);
    }
}