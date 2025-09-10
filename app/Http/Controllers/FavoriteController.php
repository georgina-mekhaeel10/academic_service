<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteScholarship;
use App\Models\FavoritePaidProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    // Display favorites page
    public function index()
    {
        $student = auth('student')->user();
        
        $favoriteScholarships = $student->favoriteScholarships()->with('scholarship')->get();
        $favoritePaidPrograms = $student->favoritePaidPrograms()->with('paidProgram')->get();
        $favoriteCourses = $student->favoriteCourses()->with('course')->get();
        
        return view('student.favorites', compact('favoriteScholarships', 'favoritePaidPrograms', 'favoriteCourses'));
    }

    public function toggleScholarshipFavorite($id)
    {
        try {
            $student = auth('student')->user();
            
            if (!$student) {
                return response()->json(['error' => 'Student not authenticated'], 401);
            }
            
            $favorite = $student->favoriteScholarships()->where('scholarship_id', $id)->first();
            
            if ($favorite) {
                $student->favoriteScholarships()->detach($id);
                return response()->json(['status' => 'removed', 'message' => 'Removed from favorites']);
            } else {
                $student->favoriteScholarships()->attach($id);
                return response()->json(['status' => 'added', 'message' => 'Added to favorites']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function togglePaidProgramFavorite($id)
    {
        try {
            $student = auth('student')->user();
            
            if (!$student) {
                return response()->json(['error' => 'Student not authenticated'], 401);
            }
            
            $favorite = $student->favoritePaidPrograms()->where('paid_program_id', $id)->first();
            
            if ($favorite) {
                $student->favoritePaidPrograms()->detach($id);
                return response()->json(['status' => 'removed', 'message' => 'Removed from favorites']);
            } else {
                $student->favoritePaidPrograms()->attach($id);
                return response()->json(['status' => 'added', 'message' => 'Added to favorites']);
            }
        } catch (\Exception $e) {
            Log::error('Error toggling paid program favorite', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    // Add scholarship to favorites
    public function addScholarshipToFavorites(Request $request)
    {
        $studentId = Auth::guard('student')->id();
        $scholarshipId = $request->scholarship_id;

        $favorite = FavoriteScholarship::firstOrCreate([
            'student_id' => $studentId,
            'scholarship_id' => $scholarshipId
        ]);

        return response()->json([
            'status' => 'added',
            'message' => 'Scholarship added to favorites successfully'
        ]);
    }

    // Remove scholarship from favorites
    public function removeScholarshipFromFavorites(Request $request)
    {
        $studentId = Auth::guard('student')->id();
        $scholarshipId = $request->scholarship_id;

        FavoriteScholarship::where('student_id', $studentId)
            ->where('scholarship_id', $scholarshipId)
            ->delete();

        return response()->json([
            'status' => 'removed',
            'message' => 'Scholarship removed from favorites successfully'
        ]);
    }

    // Add paid program to favorites
    public function addPaidProgramToFavorites(Request $request)
    {
        $studentId = Auth::guard('student')->id();
        $paidProgramId = $request->paid_program_id;

        $favorite = FavoritePaidProgram::firstOrCreate([
            'student_id' => $studentId,
            'paid_program_id' => $paidProgramId
        ]);

        return response()->json([
            'status' => 'added',
            'message' => 'Paid program added to favorites successfully'
        ]);
    }

    // Remove paid program from favorites
    public function removePaidProgramFromFavorites(Request $request)
    {
        $studentId = Auth::guard('student')->id();
        $paidProgramId = $request->paid_program_id;

        FavoritePaidProgram::where('student_id', $studentId)
            ->where('paid_program_id', $paidProgramId)
            ->delete();

        return response()->json([
            'status' => 'removed',
            'message' => 'Paid program removed from favorites successfully'
        ]);
    }

    // Get all favorite scholarships for student
    public function getFavoriteScholarships()
    {
        $studentId = Auth::guard('student')->id();
        
        $favoriteScholarships = FavoriteScholarship::where('student_id', $studentId)
            ->with('scholarship')
            ->get();

        return view('student.favorites.scholarships', compact('favoriteScholarships'));
    }

    // Get all favorite paid programs for student
    public function getFavoritePaidPrograms()
    {
        $studentId = Auth::guard('student')->id();
        
        $favoritePaidPrograms = FavoritePaidProgram::where('student_id', $studentId)
            ->with('paidProgram')
            ->get();

        return view('student.favorites.paid-programs', compact('favoritePaidPrograms'));
    }
}
