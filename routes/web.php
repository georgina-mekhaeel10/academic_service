<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ScholarshipsController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\supportAuthController;
use App\Http\Controllers\PaidprogramCnotroller;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\ASupportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Livewire\ChatComponent;
use App\Http\Controllers\ReportController;
use App\Livewire\StudentChat;
use App\Livewire\SupportChat;
use App\Livewire\MessageReply;
use App\Http\Controllers\RequestScholarshipController;
use App\Http\Controllers\PaidProgramRequestController;
Route::get('/', function () {
    return view('index');
});




Route::get('/index', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/consultation', function () {
    return view('consultation');
});
Route::get('/scholarships', [ScholarshipsController::class, 'showscholarships'])->name('scholarships.index');

// Route for paid programs
Route::get('/paidprograms', [PaidprogramCnotroller::class, 'showpaidprograms'])->name('paidprograms.index');



// عرض قائمة الجامعات
Route::get('/admin/universities', [UniversityController::class, 'index'])->name('admin.universities.index');

// عرض نموذج إضافة جامعة جديدة
Route::get('/admin/universities/create', [UniversityController::class, 'create'])->name('admin.universities.create');

// تخزين جامعة جديدة
Route::post('/admin/universities', [UniversityController::class, 'store'])->name('admin.universities.store');

// عرض تفاصيل جامعة معينة
Route::get('/admin/universities/{id}', [UniversityController::class, 'show'])->name('admin.universities.show');

// عرض نموذج تعديل بيانات جامعة معينة
Route::get('/admin/universities/{id}/edit', [UniversityController::class, 'edit'])->name('admin.universities.edit');

// تحديث بيانات جامعة معينة
Route::put('/admin/universities/{id}', [UniversityController::class, 'update'])->name('admin.universities.update');

// حذف جامعة معينة
Route::delete('/admin/universities/{id}', [UniversityController::class, 'destroy'])->name('admin.universities.destroy');



// Routes لإدارة المنح الدراسية
Route::get('/admin/scholarships', [ScholarshipsController::class, 'index'])->name('admin.scholarships.index');

// عرض نموذج إضافة جامعة جديدة
Route::get('/admin/scholarships/create', [ScholarshipsController::class, 'create'])->name('admin.scholarships.create');

// تخزين جامعة جديدة
Route::post('/admin/scholarships', [ScholarshipsController::class, 'store'])->name('admin.scholarships.store');

// عرض تفاصيل جامعة معينة
Route::get('/admin/scholarships/{id}', [ScholarshipsController::class, 'show'])->name('admin.scholarships.show');

// عرض نموذج تعديل بيانات جامعة معينة
Route::get('/admin/scholarships/{id}/edit', [ScholarshipsController::class, 'edit'])->name('admin.scholarships.edit');

// تحديث بيانات جامعة معينة
Route::put('/admin/scholarships/{id}', [ScholarshipsController::class, 'update'])->name('admin.scholarships.update');

// حذف جامعة معينة
Route::delete('/admin/scholarships/{id}', [ScholarshipsController::class, 'destroy'])->name('admin.scholarships.destroy');

Route::get('/scholarships/search', [ScholarshipsController::class, 'search'])->name('scholarships.search');

// عرض تفاصيل منحة دراسية للطلاب
Route::get('/scholarship/{id}', [ScholarshipsController::class, 'showForStudents'])->name('scholarship.show');

// Routesلإدارة البرامج المدفوعة
Route::get('/admin/paidprograms', [PaidprogramCnotroller::class, 'index'])->name('admin.paidprograms.index');

//عرض نموذج إضافة برنامج دراسي
Route::get('/admin/paidprograms/create', [PaidprogramCnotroller::class, 'create'])->name('admin.paidprograms.create');

// تخزين برنامج دراسة
Route::post('/admin/paidprograms', [PaidprogramCnotroller::class, 'store'])->name('admin.paidprograms.store');

// عرض تفاصيل برنامج دراسة
Route::get('/admin/paidprograms/{id}', [PaidprogramCnotroller::class, 'show'])->name('admin.paidprograms.show');

// عرض نموذج تعديل بيانات برنامج دراسة
Route::get('/admin/paidprograms/{id}/edit', [PaidprogramCnotroller::class, 'edit'])->name('admin.paidprograms.edit');

// تحديث بيانات برنامج دراسة
Route::put('/admin/paidprograms/{id}', [PaidprogramCnotroller::class, 'update'])->name('admin.paidprograms.update');

// حذف برنامج دراسة معينة
Route::delete('/admin/paidprograms/{id}', [PaidprogramCnotroller::class, 'destroy'])->name('admin.paidprograms.destroy');

Route::get('/paidprograms/search', [PaidprogramCnotroller::class, 'search'])->name('paidprograms.search');

// عرض تفاصيل برنامج مدفوع للطلاب
Route::get('/paid-program/{id}', [PaidprogramCnotroller::class, 'showForStudents'])->name('paid-program.show');

// البحث في الكورسات (للواجهة الأمامية) - تم نقله لتجنب التضارب
// Route::get('/courses', [AdminCourseController::class, 'search'])->name('courses.search');

//Routes لإدارة الداعمين
Route::get('/admin/support', [ASupportController::class, 'index'])->name('admin.support.index');

//عرض نموذج إضافة الداعمين ة
Route::get('/admin/support/create', [ASupportController::class, 'create'])->name('admin.support.create');

//تخزين الداعمين جديد
Route::post('/admin/support', [ASupportController::class, 'store'])->name('admin.support.store');

// عرض تفاصيل الداعمين معينة
Route::get('/admin/support/{id}', [ASupportController::class, 'show'])->name('admin.support.show');

// عرض نموذج تعديل بيانات الداعمين معينة
Route::get('/admin/support/{id}/edit', [ASupportController::class, 'edit'])->name('admin.support.edit');

// تحديث بيانات الداعمين معينة
Route::put('/admin/support/{id}', [ASupportController::class, 'update'])->name('admin.support.update');

// حذف الداعمين معينة
Route::delete('/admin/support/{id}', [ASupportController::class, 'destroy'])->name('admin.support.destroy');
//login
Route::get('/admin/dashboard', [AdminAuthController::class, 'index'])->name('admin.dashboard');
Route::prefix('admin')->name('admin.')->group(function () {
 
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
  
});
Route::get('/support/dashboard', [SupportAuthController::class, 'index'])->name('support.dashboard');
// Support Routes
Route::prefix('support')->name('support.')->group(function () {
    Route::get('/login', [SupportAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SupportAuthController::class, 'login'])->name('login');
    Route::post('/logout', [SupportAuthController::class, 'logout'])->name('logout');
    
    // Profile routes with middleware
    Route::middleware('auth:support')->group(function () {
        Route::get('/profile', [SupportController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [SupportController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [SupportController::class, 'updateProfile'])->name('profile.update');
    });
});

Route::get('/student/dashboard', [StudentController::class, 'view'])->name('student.dashboard');
Route::get('/student/profile/edit', [StudentController::class, 'editProfile'])->name('student.profile.edit');
Route::put('/student/profile/update', [StudentController::class, 'updateProfile'])->name('student.profile.update');




// Route مؤقت للاختبار بدون middleware
Route::get('admin/courses/applications', [AdminCourseController::class, 'applications'])->name('admin.courses.applications.temp');

Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function () {
    Route::get('account/editprofile', [AdminController::class, 'editProfile'])->name('account.editprofile');
    Route::post('account/updateprofile', [AdminController::class, 'updateProfile'])->name('account.updateprofile');
    Route::post('account/changepassword', [AdminController::class, 'changePassword'])->name('account.changepassword');
    
    // Routes لإدارة الكورسات
    Route::get('courses', [AdminCourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [AdminCourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [AdminCourseController::class, 'store'])->name('courses.store');
    Route::get('courses/{id}', [AdminCourseController::class, 'show'])->name('courses.show');
    Route::get('courses/{id}/edit', [AdminCourseController::class, 'edit'])->name('courses.edit');
    Route::put('courses/{id}', [AdminCourseController::class, 'update'])->name('courses.update');
    Route::delete('courses/{id}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');
    Route::post('courses/download-pdf', [AdminCourseController::class, 'downloadCoursesPdf'])->name('courses.download.pdf');
    
    // Routes لإدارة طلبات الكورسات
    Route::get('courses/applications', [AdminCourseController::class, 'applications'])->name('courses.applications');
Route::put('courses/applications/{id}/status', [AdminCourseController::class, 'updateApplicationStatus'])->name('courses.applications.status');
Route::get('courses/applications/{id}/details', [AdminCourseController::class, 'getApplicationDetails'])->name('courses.applications.details');
});
// Student Routes
Route::post('/students/register', [StudentController::class, 'register'])->name('students.register');
Route::post('/students/login', [StudentController::class, 'login'])->name('students.login');
Route::get('/students/login', [StudentController::class, 'login'])->name('students.login');
Route::post('/students/logout', [StudentController::class, 'Logout'])->name('students.logout');
Route::get('/students/logout', [StudentController::class, 'Logout'])->name('students.logout');
Route::post('/students/update-website-rating', [StudentController::class, 'updateWebsiteRating'])->name('students.update.rating');
Route::get('/admin/students/index', [StudentController::class, 'index'])->name('admin.students.index');
Route::delete('admin/students/{id}', [StudentController::class, 'destroy'])->name('admin.student.destroy');
Route::patch('admin/students/{id}/block', [StudentController::class, 'block'])->name('admin.student.block');
Route::patch('admin/students/{id}/unblock', [StudentController::class, 'unblock'])->name('admin.student.unblock');
Route::get('/admin/students/Block', [StudentController::class, 'blockPage'])->name('admin.students.Block');

// Student Course Routes
use App\Http\Controllers\StudentCourseController;
// Student Courses Routes - Protected by auth:student middleware
    Route::get('/courses', [StudentCourseController::class, 'index'])->name('student.courses.index');
    // الروتات المحددة يجب أن تأتي قبل الروت العام {id}
    Route::get('/courses/favorites', [StudentCourseController::class, 'favorites'])->name('student.courses.favorites');
    Route::get('/courses/applications', [StudentCourseController::class, 'applications'])->name('student.courses.applications');
    Route::get('/courses/favorites/export', [StudentCourseController::class, 'exportFavorites'])->name('student.courses.favorites.export');
    Route::get('/courses/applications/export', [StudentCourseController::class, 'exportApplications'])->name('student.courses.applications.export');
    // الروت العام {id} يأتي في النهاية
    Route::get('/courses/{id}', [StudentCourseController::class, 'show'])->name('student.courses.show');
    Route::post('/courses/{id}/apply', [StudentCourseController::class, 'apply'])->name('student.courses.apply');
    Route::post('/courses/apply-multiple', [StudentCourseController::class, 'applyMultiple'])->name('student.courses.apply.multiple');
    Route::post('/courses/{id}/toggle-favorite', [StudentCourseController::class, 'toggleFavorite'])->name('student.courses.favorites.toggle');
    Route::delete('/courses/favorites/clear', [StudentCourseController::class, 'clearFavorites'])->name('student.courses.favorites.clear');
    Route::delete('/courses/applications/{id}/withdraw', [StudentCourseController::class, 'withdrawApplication'])->name('student.courses.applications.withdraw');

// Student Favorites Routes
use App\Http\Controllers\FavoriteController;
Route::middleware(['auth:student'])->group(function () {
    // Favorites routes
    Route::get('/student/favorites', [FavoriteController::class, 'index'])->name('student.favorites');
    Route::post('/student/favorites/scholarship/{id}', [FavoriteController::class, 'toggleScholarshipFavorite'])->name('student.favorites.scholarship.toggle');
    Route::post('/student/favorites/paidprogram/{id}', [FavoriteController::class, 'togglePaidProgramFavorite'])->name('student.favorites.paidprogram.toggle');
    
    // Direct toggle routes for scholarships and paid programs pages
    Route::post('/scholarships/{id}/toggle-favorite', [ScholarshipsController::class, 'toggleFavorite'])->name('scholarships.toggle-favorite');
    Route::post('/paidprograms/{id}/toggle-favorite', [PaidprogramCnotroller::class, 'toggleFavorite'])->name('paidprograms.toggle-favorite');
});
 


//email to support
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'storeMessage'])->name('contact.store');
   

// عرض جميع الرسائل للـ support
Route::get('/support/messages/show', [SupportController::class, 'showMessages'])->name('support.email.show');

// عرض نموذج الرد على الرسائل
Route::get('/support/email/reply/{id}', [SupportController::class, 'reply'])->name('support.email.reply');
Route::post('/support/email/reply/{id}', [SupportController::class, 'reply'])->name('support.email.reply');
Route::post('/support/email/reply/{id}', [SupportController::class, 'replymessage'])->name('support.email.replymessage');
// إرسال الرد عبر البريد الإلكتروني أو حفظ الرد


// لوحة تحكم الـ support
Route::get('/supports/dashboard', [SupportController::class, 'index'])->name('support.dashboard');



    // Reports
    
Route::prefix('admin/reports')->group(function () {
    Route::get('/students', [ReportController::class, 'generateStudentReport'])->name('admin.reports.students');
    Route::get('/scholarships', [ReportController::class, 'generateScholarshipReport'])->name('admin.reports.scholarships');
    Route::get('/paidprograms', [ReportController::class, 'generatePaidProgramReport'])->name('admin.reports.paidprograms');
    Route::get('/supports', [ReportController::class, 'generateSupportReport'])->name('admin.reports.supports');
    Route::get('/courses', [ReportController::class, 'generateCourseReport'])->name('admin.reports.courses');
});


Route::post('/admin/reports/students/pdf', [ReportController::class, 'downloadPdf'])->name('admin.reports.students.pdf');
Route::post('/admin/reports/scholarships/pdf', [ReportController::class, 'downloadScholarshipPdf'])->name('admin.reports.scholarships.pdf');
Route::post('/admin/reports/paidprograms/pdf', [ReportController::class, 'downloadPaidProgramPdf'])->name('admin.reports.paidprograms.pdf');
Route::post('/admin/reports/supports/pdf', [ReportController::class, 'downloadSupportPdf'])->name('admin.reports.supports.pdf');
Route::post('/admin/reports/courses/pdf', [ReportController::class, 'downloadCoursePdf'])->name('admin.reports.courses.pdf');


Route::get('/consultation/{conversationId}', StudentChat::class)
    ->middleware('auth:student')
    ->name('consultation.chat');

    
    // عرض جميع الرسائل للـ support
Route::get('/support/chatting/show', [MessageController::class, 'show'])->name('support.chat.show');

Route::get('/support/chat/reply/{messageId}', [MessageController::class, 'replymessage1'])->name('supports.chat.reply');



//requestscholarships
Route::post('/submit-scholarship-request', [RequestScholarshipController::class, 'storeScholarshipRequest'])->name('submitScholarshipRequest');


//requestpaidprogram
Route::get('/submit-paid-program-request', [PaidProgramRequestController::class, 'showPaidProgramRequestForm'])->name('submitPaidProgramRequest');
Route::post('/submit-paid-program-request', [PaidProgramRequestController::class, 'storePaidProgramRequest'])->name('submitPaidProgramRequest.store');

// Student Requested Applications Routes
Route::middleware(['auth:student'])->group(function () {
    Route::get('/student/requested-scholarships', [StudentController::class, 'requestedScholarships'])->name('student.requested.scholarships');
    Route::get('/student/requested-paid-programs', [StudentController::class, 'requestedPaidPrograms'])->name('student.requested.paidprograms');
});
