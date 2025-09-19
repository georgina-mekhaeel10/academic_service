<?php

namespace App\Http\Controllers;

use App\Models\RequestPaidProgram;
use App\Models\Student;
use App\Models\Paidprograms;
use Illuminate\Http\Request;

class PaidProgramRequestController extends Controller
{
    //
    
    // عرض نموذج طلب البرنامج المدفوع
    public function showPaidProgramRequestForm(Request $request)
    {
        $paidProgramId = $request->get('paid_program_id');
        $paidProgram = null;
        
        if ($paidProgramId) {
            $paidProgram = Paidprograms::with('university')->find($paidProgramId);
        }
        
        return view('submit-paid-program-request', compact('paidProgram'));
    }

        // دالة لحفظ طلب البرنامج المدفوع
        public function storePaidProgramRequest(Request $request)
        {$validated = $request->validate([
            'type' => 'in:master,university,phd',
            
        ]);
            // التحقق من وجود الطالب والبرنامج المدفوع
            $student = Student::find($request->student_id);
            $paidProgram = Paidprograms::find($request->paid_program_id);
    
            // إذا كان الطالب والبرنامج المدفوع موجودين، قم بتخزين الطلب
            if ($student && $paidProgram) {
                   // التحقق من أن الطالب لم يتقدم مسبقًا على نفس البرنامج المدفوع
        $existingRequest = RequestPaidProgram::where('student_id', $student->id)
        ->where('paid_program_id', $paidProgram->id)
        ->first();

// إذا كان الطالب قد تقدم مسبقًا، إظهار رسالة الخطأ
if ($existingRequest) {
return redirect()->back()->with('error', 'لقد تقدمت مسبقًا لهذا البرنامج المدفوع.');
}
                // إنشاء سجل في جدول request_paid_programs
                RequestPaidProgram::create([
                    'student_id' => $student->id,
                    'student_name' => $student->name,
                    'paid_program_id' => $paidProgram->id,
                    'paid_program_name' => $paidProgram->name,
                    'application_date' => now(),
                ]);
    
                   // إعادة توجيه الطالب إلى رابط المنحة
        return redirect($paidProgram->application_url)->with('success', 'تم التقديم للبرنامج بنجاح!');
            }
    
            // إعادة التوجيه مع رسالة خطأ إذا لم يتم العثور على الطالب أو البرنامج المدفوع
            return redirect()->back()->with('error', 'خطأ في التقديم. تأكد من وجود الطالب والبرنامج المدفوع.');
        }
    
}
