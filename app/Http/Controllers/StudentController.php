<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\RequestScholarship;
use App\Models\RequestPaidProgram;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{   public function index()
    {
        // جلب الطلاب الموجودين في قاعدة البيانات
        $students = Student::all(); 
    
        // تمرير البيانات إلى الـ View
        return view('admin.student.index', compact('students'));
    }
    public function view()
    { 
        return redirect()->back();

    }
    public function blockPage()
    {
        // جلب الطلاب الموجودين في قاعدة البيانات
        $students = Student::all(); 
    
        // تمرير البيانات إلى الـ View
        return view('admin.student.block', compact('students'));
    }
    public function register(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
            'password' => 'required|string|min:8',
            'age' => 'required|integer|min:18',  // تأكد من أن العمر أكبر من أو يساوي 18
            'phone' => 'required|string',
            'gender' => 'required|string',
        ]);
        

        // إنشاء طالب جديد
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = bcrypt($request->password); // تشفير كلمة المرور
        $student->age = $request->age;
        $student->phone = $request->phone;
        $student->gender = $request->gender;
        $student->save();

        // إعادة التوجيه مع رسالة نجاح
        
        return redirect()->back()->with('success');
    }
      // حذف طالب
      public function destroy($id)
      {
          $student = Student::findOrFail($id);
          $student->delete();
  
          return redirect()->route('admin.students.Block')->with('success', 'Student deleted successfully!');
      }
      
      // حظر طالب
      public function block($id)
      {
          $student = Student::findOrFail($id);
          $student->update(['is_blocked' => 1]);
          
          return redirect()->route('admin.students.Block')->with('success', 'Student blocked successfully!');
      }
      
      // إلغاء حظر طالب
      public function unblock($id)
      {
          $student = Student::findOrFail($id);
          $student->update(['is_blocked' => 0]);
          
          return redirect()->route('admin.students.Block')->with('success', 'Student unblocked successfully!');
      }
      
      public function login(Request $request)
      {     // التحقق من البيانات المدخلة
        
        $request->validate([
            'email' => 'required|email', // التحقق من أن الحقل هو بريد إلكتروني
            'password' => 'required|string', // التحقق من أن الحقل كلمة مرور
        ]);
        
          $credentials = $request->only('email', 'password');
         
          if (Auth::guard('student')->attempt($credentials)) {
            
              return redirect()->route('student.dashboard');
          }
   
          return back()->withErrors(['email' => 'Invalid credentials']);
      }
      public function Logout(Request $request){
    	Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
       
        return redirect('/')->with('success', 'Logout successful. Please login.');
    }

    public function editProfile()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile.edit', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . Auth::guard('student')->id(),
            'age' => 'required|integer|min:18',
            'phone' => 'required|string',
            'gender' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $student = Auth::guard('student')->user();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->age = $request->age;
        $student->phone = $request->phone;
        $student->gender = $request->gender;
        
        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }
        
        $student->save();

        return redirect()->route('student.profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function updateWebsiteRating(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $student = Auth::guard('student')->user();
        $student->website_rate = $request->rating;
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Rating updated successfully!',
            'rating' => $student->website_rate
        ]);
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $id,
            'age' => 'required|integer|min:18',
            'phone' => 'required|string',
            'gender' => 'required|string',
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

}

