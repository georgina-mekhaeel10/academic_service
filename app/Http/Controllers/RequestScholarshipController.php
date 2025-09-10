<?php

namespace App\Http\Controllers;
use App\Models\RequestScholarship;
use App\Models\Student;
use App\Models\Scholarships;

use Illuminate\Http\Request;

class RequestScholarshipController extends Controller
{
    //

    public function storeScholarshipRequest(Request $request)
    { // مثال على validation
        $validated = $request->validate([
            'type' => 'in:master,university,phd',
            'funding_type' => 'in:Full,Partial',
        ]);
        // تحقق من وجود الطالب والمنحة
        $student = Student::find($request->student_id);
        $scholarship = Scholarships::find($request->scholarship_id);
 

        if ($student && $scholarship) {
           // التحقق من أن الطالب لم يتقدم مسبقًا على نفس البرنامج المدفوع
           $existingRequest = RequestScholarship::where('student_id', $student->id)
           ->where('scholarship_id', $scholarship->scholarships_ID)
           ->first();


// إذا كان الطالب قد تقدم مسبقًا، إظهار رسالة الخطأ
if ($existingRequest) {
 
return redirect()->back()->with('error', 'لقد تقدمت مسبقًا لهذه المنحة.');
}
            // إضافة سجل في جدول request_scholarships
            RequestScholarship::create([
                'student_id' => $student->id,
                'student_name' => $student->name,
                'scholarship_id' => $scholarship->scholarships_ID,
                'scholarship_name' => $scholarship->name,
                'type' => $request->type,  // تخزين نوع المنحة
                'funding_type' => $request->funding_type,  // تخزين نوع التمويل
                'application_date' => now(),
               
              
            ]);
           // DD($lana->all());
            // إعادة توجيه الطالب إلى رابط المنحة
        return redirect($scholarship->application_url)->with('success', 'تم التقديم للمنحة بنجاح!');
        }

        return redirect()->back()->with('error', 'خطأ في التقديم. تأكد من وجود الطالب والمنحة.');
    }
}
