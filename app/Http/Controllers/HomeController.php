<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $latest_enrollments = Enrollment::latest()->take(10)->get();
        $latest_services= Service::latest()->take(10)->get();
        $latest_customers= Customer::latest()->take(10)->get();

        $user_count = User::count();
        $customer_count = Customer::count();
        $enrollment_count = Enrollment::count();
        $one_customer= Customer::latest()->take(1)->value('customer_name');
        $one_service= Service::latest()->take(1)->value('service_name');
        $one_enroll= Enrollment::latest()->take(1)->value('service_ids');
        $enrollment= Service::where('id',  $one_enroll)->value('service_name');
        $one_user= User::latest()->take(1)->value('user_name');



        if (Auth::check()) {
            return view('dashboard.index', [
                'latest_services' => $latest_services,
                'latest_customers' => $latest_customers,
                'latest_enrollments' => $latest_enrollments,
                'user_count' => $user_count,
                'customer_count' => $customer_count,
                'enrollment_count' => $enrollment_count,
                'one_customer'=>$one_customer,
                'one_service'=>$one_service,
                'enrollment'=>$enrollment,
                'one_user'=>$one_user,


            ]);
        } else {
            return redirect()->route('login_page')->with('error', 'Logged In First');
        }
    }



    public function switchLanguage($locale)
    {
        app()->setLocale($locale);
        config(['app.locale' => $locale]);
        // You can store the chosen locale in session for persistence
        session(['locale' => $locale]);

        return redirect()->back(); // or any other redirect you want
    }
}
