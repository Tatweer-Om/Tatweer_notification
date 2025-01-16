<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnrolController;

use App\Http\Controllers\OfferController;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CronJobController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\WinnLosController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCategoryController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('getAndSendEmails', [CronJobController::class, 'getAndSendEmails'])->name('getAndSendEmails');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/switch-language/{locale}', [HomeController::class, 'switchLanguage'])->name('switch_language');
// category dress

//user
Route::match(['get', 'post'], 'login_page', [UserController::class, 'login_page'])->name('login_page');
Route::match(['get', 'post'], 'login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'logout', [UserController::class, 'logout'])->name('logout');
Route::get('user', [UserController::class, 'index'])->name('user');
Route::post('add_user', [UserController::class, 'add_user'])->name('add_user');
Route::get('show_user', [UserController::class, 'show_user'])->name('show_user');
Route::post('edit_user', [UserController::class, 'edit_user'])->name('edit_user');
Route::post('update_user', [UserController::class, 'update_user'])->name('update_user');
Route::post('delete_user', [UserController::class, 'delete_user'])->name('delete_user');


Route::get('expense_category', [ExpenseCategoryController::class, 'index'])->name('expense_category');
Route::post('add_expense_category', [ExpenseCategoryController::class, 'add_expense_category'])->name('add_expense_category');
Route::get('show_expense_category', [ExpenseCategoryController::class, 'show_expense_category'])->name('show_expense_category');
Route::post('edit_expense_category', [ExpenseCategoryController::class, 'edit_expense_category'])->name('edit_expense_category');
Route::post('update_expense_category', [ExpenseCategoryController::class, 'update_expense_category'])->name('update_expense_category');
Route::post('delete_expense_category', [ExpenseCategoryController::class, 'delete_expense_category'])->name('delete_expense_category');

// expense_categoryController Routes

Route::get('expense', [ExpenseController::class, 'index'])->name('expense');
Route::post('add_expense', [ExpenseController::class, 'add_expense'])->name('add_expense');
Route::get('show_expense', [ExpenseController::class, 'show_expense'])->name('show_expense');
Route::post('edit_expense', [ExpenseController::class, 'edit_expense'])->name('edit_expense');
Route::post('update_expense', [ExpenseController::class, 'update_expense'])->name('update_expense');
Route::post('delete_expense', [ExpenseController::class, 'delete_expense'])->name('delete_expense_category');
Route::get('download_expense_image/{id}', [ExpenseController::class, 'download_expense_image'])->name('download_expense_image');


// AccountController Routes

Route::get('account', [AccountController::class, 'index'])->name('account');
Route::post('add_account', [AccountController::class, 'add_account'])->name('add_account');
Route::get('show_account', [AccountController::class, 'show_account'])->name('show_account');
Route::post('edit_account', [AccountController::class, 'edit_account'])->name('edit_account');
Route::post('update_account', [AccountController::class, 'update_account'])->name('update_account');
Route::post('delete_account', [AccountController::class, 'delete_account'])->name('delete_account');

Route::get('customer', [CustomerController::class, 'index'])->name('customer');
Route::post('add_customer', [CustomerController::class, 'add_customer'])->name('add_customer');
Route::post('add_customer2', [CustomerController::class, 'add_customer2'])->name('add_customer2');

Route::get('show_customer', [CustomerController::class, 'show_customer'])->name('show_customer');
Route::post('edit_customer', [CustomerController::class, 'edit_customer'])->name('edit_customer');
Route::post('update_customer', [CustomerController::class, 'update_customer'])->name('update_customer');
Route::get('customer_profile/{id}', [CustomerController::class, 'customer_profile'])->name('customer_profile');

Route::post('delete_customer', [CustomerController::class, 'delete_customer'])->name('delete_customer');

Route::get('service', [ServiceController::class, 'index'])->name('service');
Route::post('add_service', [ServiceController::class, 'add_service'])->name('add_service');
Route::post('add_service2', [ServiceController::class, 'add_service2'])->name('add_service2');

Route::get('show_service', [ServiceController::class, 'show_service'])->name('show_service');
Route::post('edit_service', [ServiceController::class, 'edit_service'])->name('edit_service');
Route::post('update_service', [ServiceController::class, 'update_service'])->name('update_service');
Route::post('delete_service', [ServiceController::class, 'delete_service'])->name('delete_service');


//sms
Route::get('sms', [SmsController::class, 'index'])->name('sms');
Route::post('get_sms_status', [SmsController::class, 'get_sms_status'])->name('get_sms_status');
Route::match(['get', 'post'], 'add_status_sms', [SmsController::class, 'add_status_sms'])->name('add_status_sms');


//Settings
Route::get('setting', [SettingController::class, 'setting'])->name('setting');
Route::post('add_setting', [SettingController::class, 'add_setting'])->name('add_setting');
Route::get('setting_data', [SettingController::class, 'setting_data'])->name('setting_data');
Route::post('dress_avail', [SettingController::class, 'dress_avail'])->name('dress_avail');










//enrollement

Route::match(['get', 'post'], 'enrol', [EnrolController::class, 'index'])->name('enrol');
Route::match(['get', 'post'], 'all_sub', [EnrolController::class, 'all_sub'])->name('all_sub');
Route::match(['get', 'post'], 'sub_detail/{id}', [EnrolController::class, 'sub_detail'])->name('sub_detail');


Route::get('/get-service-cost/{id}', [EnrolController::class, 'getServiceCost'])->name('get.service.cost');

Route::post('add_subscription', [EnrolController::class, 'add_subscription'])->name('add_subscription');
Route::post('add_subscription', [EnrolController::class, 'add_subscription'])->name('add_subscription');

Route::get('show_subscription', [EnrolController::class, 'show_subscription'])->name('show_subscription');
Route::get('show_subscription_exp', [EnrolController::class, 'show_subscription_exp'])->name('show_subscription_exp');
Route::match(['get', 'post'],'exp', [EnrolController::class, 'exp'])->name('exp');
Route::match(['get', 'post'],'add_renewl', [EnrolController::class, 'add_renewl'])->name('add_renewl');
Route::match(['get', 'post'],'add_renewl2', [EnrolController::class, 'add_renewl2'])->name('add_renewl2');




Route::get('edit_sub/{id}', [EnrolController::class, 'edit_sub'])->name('edit_sub');

Route::get('edit_subscription/{id}', [EnrolController::class, 'edit_subscription'])->name('edit_subscription');
Route::post('delete_subscription', [EnrolController::class, 'delete_subscription'])->name('delete_subscription');
Route::post('update_subscription', [EnrolController::class, 'update_subscription'])->name('update_subscription');
Route::post('add_service2', [EnrolController::class, 'add_service2'])->name('add_service2');
Route::post('add_customer2', [EnrolController::class, 'add_customer2'])->name('add_customer2');




//Report

Route::match(['get', 'post'], 'income_report', [ReportController::class, 'income_report'])->name('income_report');
Route::match(['get', 'post'], 'course_income_report', [ReportController::class, 'course_income_report'])->name('course_income_report');
Route::match(['get', 'post'], 'all_courses_income', [ReportController::class, 'all_courses_income'])->name('all_courses_income');



//winloss

Route::match(['get', 'post'], 'winlos', [WinnLosController::class, 'index'])->name('winlos');
Route::post('add_winlos', [WinnLosController::class, 'add_winlos'])->name('add_winlos');
Route::get('show_winlos', [WinnLosController::class, 'show_winlos'])->name('show_winlos');
Route::post('edit_winlos', [WinnLosController::class, 'edit_winlos'])->name('edit_winlos');
Route::post('update_winlos', [WinnLosController::class, 'update_winlos'])->name('update_winlos');
Route::post('delete_winlos', [WinnLosController::class, 'delete_winlos'])->name('delete_winlos');
