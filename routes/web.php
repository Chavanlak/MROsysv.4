<?php

use App\Http\Controllers\UserController;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\MastbranchinfoController;
use App\Http\Controllers\NotiRepairController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FileUploadController;
use App\Mail\EmailCenter;
use App\Mail\TestMail;
// use App\Http\Controllers\NotiRepairContoller;
use App\Http\Controllers\StatustrackingController;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/logintest',function(){
    return view('login');
});

// Route::get('/login',[UserController::class, 'login'])->name('login');
Route::get('/',[UserController::class, 'login'])->name('login');
Route::post('/loginpost',[UserController::class,'loginPost']);

Route::get('logineror',[UserController::class,'logineror']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Route::get('/repair', [UserController::class, 'showrepair'])->middleware('customauth');

// Route::get('/branch', [MastbranchinfoController::class, 'getselectBranch'])->middleware('customauth');
// Route::post('/branch', [MastbranchinfoController::class, 'storeBranch'])->middleware('customauth')->name('store.branch');
Route::get('/send-multiple-gmails', [EmailController::class, 'sendMultipleGmails']);
Route::get('/branch', [MastbranchinfoController::class, 'getselectBranch']);
Route::post('/branchpost', [MastbranchinfoController::class, 'saveBranch']);
Route::get('/Zone',[NotiRepairController::class,'showallManegers']);
// Route::get('/showbranch',[MastbranchinfoController::class,'showallBranch']);
// Route::get('/nav', function () {
//     return view('navbar');
// });
Route::get('/layout', function () {
    return view('layout.mainlayout');
});
Route::get('/dashbord', function () {
    return view('dashborad.dashbord');
});
//  action="{{ route('select.branch') }}" method="POST"
// routes/web.php
//old
// Route::get('/repair', [NotiRepairController::class,'ShowRepairForm'])->middleware('customauth');
// Route::get('/repair/repair2', [EquipmentController::class, 'ShowAllEquipment'])->middleware('customauth');
// Route::get('/backtorepair', [EquipmentController::class, 'backtorepair'])->middleware('customauth');
// Route::post('/repair/submit', [NotiRepairController::class, 'saveNotiRepair'])->middleware('customauth');

Route::middleware(['customauth'])->group(function () {
    
    Route::get('/repair', [NotiRepairController::class, 'ShowRepairForm']);
    Route::get('/repair/repair2', [EquipmentController::class, 'ShowAllEquipment']);
    // Route::get('/repairBM', [NotiRepairController::class, 'ShowRepairFormBM']);
    Route::get('/backtorepair', [EquipmentController::class, 'backtorepair']);
    Route::post('/repair/submit', [NotiRepairController::class, 'saveNotiRepair']);
});

// Route::get('/repair/repair2', [MastbranchinfoController::class,'showRepair2Form'])->middleware('customauth');
// ถ้าต้องการ filter email
Route::get('/repair/mail', [NotiRepairController::class, 'getemail'])->middleware('customauth');


// Route::post('/repair', [NotiRepairController::class, 'handleForm']);
// Route::get('/repair/form', [NotiRepairController::class, 'showForm']);

//upload
// Route::get('/uploadfile',[FileUploadController::class,'getallUploadFile']);
// Route::post('/uploadfilepost',[FileUploadController::class,'savefile']);


// Route::post('/uploadfilepost',[FileUploadController::class,'getFileById']);
// Route::get('/file', function () {
//     return view('fileupload');
Route::get('/uploadfile',[FileUploadController::class,'createFile']);
// Route::post('/store',[FileUploadController::class,'uploadeFile']);
Route::post('/store',[FileUploadController::class,'store']);
// });
// Route::get('/mail', function () {
//     return view('email');
// });
// Mail::to('repaircentertgi@gmail.com')->send((new EmailCenter($name)));

// Route::get('/email', function () {
//     $name = 'Email Center';
//     Mail::to('repaircentertgi@gmail.com')->send(new EmailCenter($name));
//     // return "ส่งอีเมลแล้ว";
// });

// Route::get('/email', function () {
//     $name = 'Email Center';
//     $attachments = [
//         // 'path/to/attachment1.pdf',
//         // 'path/to/attachment2.jpg',
//     ];
//     Mail::to('

Route::get('/email', function () {
    $name = 'Test Mail';
    Mail::to('tgirepaircenter@gmail.com')->send(new TestMail($name));

});
Route::get('/testmail', [EmailController::class, 'sendEmailTother']);
Route::get('/emailpic', [EmailController::class, 'saveNotiRepair']);

Route::get('/sendmail', [EmailController::class, 'index']);
Route::get('/picshow/{notirepairId}',[FileUploadController::class,'getPicturePathfromNotiRepairId']);

Route::get('/email', function () {
    return view('email');
});
Route::get('/success', function () {
    return view('success');
})->middleware('customauth')->name('success');
//check email
// Route::get('/show', [MastbranchinfoController::class, 'showallBranch']);

/// dashbord admin////
// Route สำหรับแสดงรายการแจ้งซ่อมทั้งหมด
// Route::get('/noti',[NotiRepairController::class,'checkNotiRepair'])->name('noti.list');
// // Route::get('/noti/{notirepaitid}',[NotiRepairContoller::class,'reciveNotirepair']);
// // // 1. (GET) Route สำหรับแสดงหน้าฟอร์มอัพเดตสถานะ (เป้าหมายของการ Redirect)
// Route::get('/updatestatus/form/{notirepaitid}',[NotiRepairController::class,'showUpdateStatusForm'])->name('noti.show_update_form');
// Route::post('/updateitem',[NotiRepairController::class,'updateStatus'])->name('notiupdate');
// // // 2. (POST) Route สำหรับดำเนินการ 'กดรับของ' (Action จากหน้ารายการ)
// //พแกดปุ่มได้รับของเเล้วจะเข้าเร้านี้
// Route::post('/noti/accept/{notirepaitid}',[NotiRepairController::class,'acceptNotisRepair'])->name('noti.accept');

// // 3. (POST) Route สำหรับส่งข้อมูลอัพเดตสถานะจากฟอร์ม (ชื่อเดิมที่คุณใช้) //บันทึกสถานะใหม่ลงฐานข้อมูล
// //http://127.0.0.1:8000/updatestatus/form/265 เร้าอัพเดทสถานะการได้ของเเล้ว



// ///dashbord หน้าร้าน
// Route::get('/noti/storefront', [NotiRepairController::class, 'getNotiForStoreFront'])->name('noti.storefront');

Route::middleware(['RoleMiddleware:AdminTechnicianStore'])->group(function () {
    
    // หน้า Dashboard รายการแจ้งซ่อม
    Route::get('/noti', [NotiRepairController::class, 'checkNotiRepair'])->name('noti.list');

    // หน้าฟอร์มอัพเดตสถานะ (GET)
    Route::get('/updatestatus/form/{notirepaitid}', [NotiRepairController::class, 'showUpdateStatusForm'])->name('noti.show_update_form');

    // ปุ่มบันทึกสถานะใหม่ (POST Form)
    Route::post('/updaterecive', [NotiRepairController::class, 'updateStatus'])->name('notiupdate');

});

// =============================================================
// 2. กลุ่มสำหรับ Frontstaff (หน้าร้าน)
// =============================================================
// Middleware จะเช็คว่า user มี role เป็น 'Frontstaff' หรือไม่
Route::middleware(['RoleMiddleware:Frontstaff'])->group(function () {

    // หน้า Dashboard สำหรับหน้าร้าน
    Route::get('/noti/storefront', [NotiRepairController::class, 'getNotiForStoreFront'])->name('noti.storefront');
        // ปุ่มกดรับของ (POST Action)
    Route::post('/noti/accept/{notirepaitid}', [NotiRepairController::class, 'acceptNotisRepair'])->name('noti.accept');

});

// Route สำหรับ Action 'รับของ' (ใช้ POST เพื่อเปลี่ยนสถานะ)
// 💡 URL: /noti/accept/{NotirepairId}
// Route::post('/noti/accept/{notirepaitid}', [NotiRepairController::class, 'acceptNotisRepair'])->name('noti.accept');

//login dashbord

// Route::get('/loginstore',[UserController::class, 'loginDashbord']);
// Route::post('/loginpoststore',[UserController::class,'loginPostDashbord']);
// Route::get('loginerorstore',[UserController::class,'loginerrorstore']);


// Route::get('/showrepair',[UserController::class,'showrepair']);



//เดิม
// Route::get('/logout',[UserController::class,'logout'])->name('logout');

Route::post('/logoutstore', [UserController::class, 'logoutstore']);

Route::get('/ch',[NotiRepairController::class,'checkall']);

// Route::get('/admin',function(){
//     return view('dashborad.admin');
// });
Route::get('/addemail',[EmailController::class,'showEmail'])->name('addemail');
Route::post('/emailpost',[EmailController::class,'getEmailByAdmin']);

Route::post('/typenamepost',[EmailController::class,'getEquipmenttypeByAdmin']);
Route::post('/equipmentpost',[EmailController::class,'getEquipmentByAdmin']);

//delete
Route::get('/deleteequipment/{equipmentId}',[EmailController::class,'removeEquipment']);

//allnotirepair
Route::get('/showallnoti',[NotiRepairController::class,'ShowallNotirepair']);
Route::get('/cm',function(){
    return view('cm');
});


//dashbord
Route::get('/countnotirpair',[NotiRepairController::class,'getCountNotirepair']);
//his
Route::get('/history',[NotiRepairController::class,'NotiRepairHistory']);
// Route::get('/history', function () {
//     return view('dashborad.historynoti');
// });
