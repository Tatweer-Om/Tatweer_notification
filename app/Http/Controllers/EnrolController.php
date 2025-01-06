<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Course;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Enrollment;
use App\Models\ReneHistory;
use Illuminate\Http\Request;
use App\Mail\SendReminderEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class EnrolController extends Controller
{
    public function index()
    {

        $services = Service::all();
        $customers = Customer::all();

        if (!Auth::check()) {

            return redirect()->route('login_page')->with('error', trans('messages.please_log_in', [], session('locale')));
        }

        $user = Auth::user();

        if (in_array(3, explode(',', $user->permit_type))) {

            return view('enroll.enroll', compact('services', 'customers'));
        } else {

            return redirect()->route('/')->with('error', trans('messages.you_dont_have_permissions', [], session('locale')));
        }
    }




    public function show_subscription(Request $request)
    {


        $sno = 0;
        $view_subscription = Enrollment::orderBy('created_at', 'desc')->get();
        if (count($view_subscription) > 0) {
            foreach ($view_subscription as $value) {

                $service_ids = $value->service_ids; // Convert string to array
                $services = Service::where('id', $service_ids)->value('service_name'); // Query services



                $modal = '<a href="' . url('edit_subscription', ['id' => $value->id]) . '" class="btn btn-outline-secondary btn-sm" title="Edit">
            <i class="fas fa-pencil-alt" title="Edit"></i>
          </a>
          <a  class="btn btn-outline-secondary btn-sm" title="Delete" onclick=del("' . $value->id . '")>
            <i class="fas fa-trash" title="Delete"></i>
          </a>
                <a class="btn btn-outline-secondary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#add_renewl_modal"
                data-value1="' . $services . '"
                 data-value3="' . $value->renewl_date . '"
                data-value2="' . $value->renewl_cost . '"
                data-value4="' . $value->id . '">

                    <i class="fas fa-calendar" title="Renew"></i>
                </a>';


                $add_data = \Carbon\Carbon::parse($value->created_at)->format('d-m-Y (h:iA)');

                $customer = Customer::where('id', $value->customer_id)->value('customer_name');
                $customer_name='<a href="customer_profile/' . $value->customer_id . '">' . $customer . '</a>';

                $renewal_date = new DateTime($value->renewl_date); // Renewal date from database
                $current_date = new DateTime(); // Current date
                $interval = $current_date->diff($renewal_date); // Calculate the difference

                // Format the remaining time
                $remaining_time = '';
                if ($interval->y > 0) {
                    $remaining_time .= $interval->y . ' ' . trans('messages.years_lang') . ' ';
                }
                if ($interval->m > 0) {
                    $remaining_time .= $interval->m . ' ' . trans('messages.months_lang') . ' ';
                }
                if ($interval->d > 0) {
                    $remaining_time .= $interval->d . ' ' . trans('messages.days_lang');
                }
                $remaining_date = \Carbon\Carbon::parse($value->renewl_date);
                $now = \Carbon\Carbon::now();
                $remaining_period = $remaining_date->diff($now);

                // Check if the remaining period is less than 1 month
                $badge_class = ($remaining_period->m < 1) ? 'bg-danger' : 'bg-info';
                $sno++;
                $json[] = array(
                    $sno,
                    $customer_name,
                    $services,
                    '<span class="badge bg-primary">' . $value->renewl_date . '</span>', // Renewal date
                    '<span class="badge ' . $badge_class . '">' . $remaining_time . '</span>', // Remaining time
                    '<span class="added_by">' . trans('messages.added_by') . ': ' . $value->added_by . '</span><br>' . // Added by
                    '<span class="badge bg-success">' . trans('messages.purchase_date') . ': ' . $value->purchase_date . '</span>', // Purchase date
                 $add_data ,
                    $modal // Modal or additional action
                );



            }



            $response = array();
            $response['success'] = true;
            $response['aaData'] = $json;
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }

    public function show_subscription_exp(Request $request)
    {


        $sno = 0;

        $view_subscription = Enrollment::whereRaw('DATEDIFF(renewl_date, ?) <= 30', [Carbon::now()])->get();
                if (count($view_subscription) > 0) {
            foreach ($view_subscription as $value) {

                $service_ids = $value->service_ids; // Convert string to array
                $services = Service::where('id', $service_ids)->value('service_name'); // Query services


                $modal = '<a href="' . url('edit_subscription', ['id' => $value->id]) . '" class="btn btn-outline-secondary btn-sm" title="Edit">
                <i class="fas fa-pencil-alt" title="Edit"></i>
              </a>
              <a  class="btn btn-outline-secondary btn-sm" title="Delete" onclick=del("' . $value->id . '")>
                <i class="fas fa-trash" title="Delete"></i>
              </a>
                    <a class="btn btn-outline-secondary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#add_renewl_modal"
                    data-value1="' . $services . '"
                     data-value3="' . $value->renewl_date . '"
                    data-value2="' . $value->renewl_cost . '"
                    data-value4="' . $value->id . '">

                        <i class="fas fa-calendar" title="Renew"></i>
                    </a>';


                    $add_data = \Carbon\Carbon::parse($value->created_at)->format('d-m-Y (h:iA)');

                $customer = Customer::where('id', $value->customer_id)->value('customer_name');
                $customer_name='<a href="customer_profile/' . $value->customer_id . '">' . $customer . '</a>';


                $renewal_date = new DateTime($value->renewl_date); // Renewal date from database
                $current_date = new DateTime(); // Current date
                $interval = $current_date->diff($renewal_date); // Calculate the difference

                // Format the remaining time
                $remaining_time = '';
                if ($interval->y > 0) {
                    $remaining_time .= $interval->y . ' ' . trans('messages.years_lang') . ' ';
                }
                if ($interval->m > 0) {
                    $remaining_time .= $interval->m . ' ' . trans('messages.months_lang') . ' ';
                }
                if ($interval->d > 0) {
                    $remaining_time .= $interval->d . ' ' . trans('messages.days_lang');
                }
                $remaining_date = \Carbon\Carbon::parse($value->renewl_date);
                $now = \Carbon\Carbon::now();
                $remaining_period = $remaining_date->diff($now);

                // Check if the remaining period is less than 1 month
                $badge_class = ($remaining_period->m < 1) ? 'bg-danger' : 'bg-info';
                $sno++;
                $json[] = array(
                    $sno,
                    $customer_name,
                    $services,
                    '<span class="badge bg-primary">' . $value->renewl_date . '</span>', // Renewal date
                    '<span class="badge ' . $badge_class . '">' . $remaining_time . '</span>', // Remaining time
                    '<span class="added_by">' . trans('messages.added_by') . ': ' . $value->added_by . '</span><br>' . // Added by
                    '<span class="badge bg-success">' . trans('messages.purchase_date') . ': ' . $value->purchase_date . '</span>', // Purchase date
                 $add_data ,
                    $modal // Modal or additional action
                );

            }



            $response = array();
            $response['success'] = true;
            $response['aaData'] = $json;
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }

    public function exp(){
        return view('enroll.exp');
    }


    public function add_subscription(Request $request)
    {

        $user_id = Auth::id();
        $userData = User::find($user_id);
        $user_name = $userData->user_name;

        $services = $request['service_id'];
        $urls = $request['system_url'];
        $extraService = $request->has('extra_service') ? true : false;

        $enroll = new Enrollment();

        $enroll->service_ids = $services;
        $enroll->customer_id = $request['customer_id'];
        $enroll->service_cost = $request['service_cost'];

        $enroll->renewl = $extraService;
        $enroll->system_urls = implode(',', $urls);
        $enroll->purchase_date =  $request['purchase_date'];
        $enroll->renewl = $request['extra_service'];
        $enroll->renewl_date = $request['renewl_date'];
        $enroll->renewl_cost = $request['renewl_cost'];
        $enroll->notes = $request['notes'];
        $enroll->added_by = $user_name;
        $enroll->user_id = $user_id;
        $enroll->save();

        $history = new ReneHistory();
        $history->sub_id= $enroll->id;
        $history->old_renewl_date= $request->input('renewl_date');
        $history->new_renewl_date= $request->input('new_renewl_date');
        $history->renewl_cost= $request->input('renewl_cost');
        $history->notes= $request->input('notes');
        $history->save();

        $setting= Setting::first();
        $company= $setting->company_name;


        $logoPath= $setting->logo;
        $phone= $setting->company_phone;
        $customer = Customer::where('id',$enroll->customer_id)->first();
        $service = Service::where('id',$enroll->service_ids)->first();

        if ($customer && $service) {
            $customer_name = $customer->customer_name;
            $service_name = $service->service_name;
            $renewl_date = $enroll->renewl_date;
            $purchase_date = $enroll->purchase_date;
            $renewl_cost = $enroll->renewl_cost;

            $logo = asset('images/logo/' . $logoPath);


            $smsParams = [
                'sms_status' => 1, // Status for this message type, adjust as needed
                'customer_name' => $customer_name,
                'customer_number' => $customer->customer_number,
                'service_name' => $service_name,
                'purchase_date' => $purchase_date,
                'renewl_date' => $renewl_date,
                'renewl_cost' => $renewl_cost,
                'company' => $company,
            ];

            // Get the SMS content
            $smsContent = get_sms($smsParams);

            // Send the WhatsApp message using sms_module function
            sms_module($customer->customer_number, $smsContent);


            Mail::to($customer->customer_email)->send(new SendReminderEmail($customer_name, $logo,  $service_name, $company, $phone, $renewl_date, $purchase_date, $renewl_cost));
        }
        return response()->json(['sub_id' => $enroll->id, 'status' => 1]);
    }
    public function edit_subscription($id, Request $request)
    {
        $sub_id = $id;

        $sub_data = Enrollment::where('id', $sub_id)->first();

        if (!$sub_data) {
            return response()->json(['error' => trans('messages.enroll_not_found', [], session('locale'))], 404);
        }

        $service_ids = $sub_data->service_ids;
        $system_urls = $sub_data->system_urls ? explode(',', $sub_data->system_urls) : [];

        $services = Service::all();
        $customers = Customer::all();
        // Pass variables directly to the view
        return view('enroll.edit_sub', [
            'sub_id' => $sub_data->id,
            'sub_data'=>$sub_data,
            'purchase_date'=>$sub_data->purchase_date,
            'service_cost'=>$sub_data->service_cost,
            'customer_id' => $sub_data->customer_id,
            'service_ids' => $service_ids, // Parsed as an array
            'system_urls' => $system_urls,
            'services'=>$services, 'customers'=>$customers, // Parsed as an array
        ]);
    }


    public function edit_sub($id){

        $services = Service::all();
        $customers = Customer::all();
        return view('enroll.edit_sub', compact('services', 'customers'));
    }



    public function update_subscription(Request $request)
    {
        // Get the authenticated user's ID and details
        $user_id = Auth::id();
        $userData = User::find($user_id);
        $user_name = $userData->user_name;

        $sub_id = $request->input('sub_id');


        $services = $request['service_id'];
        $urls = $request['system_url'];
        $extraService = $request->has('extra_service') ? true : false;

        $enroll = Enrollment::where('id', $sub_id)->first();

        $enroll->service_ids =  $services;
        $enroll->customer_id = $request['customer_id'];
        $enroll->service_cost = $request['service_cost'];

        $enroll->renewl = $extraService;
        $enroll->system_urls = implode(',', $urls);
        $enroll->purchase_date =  $request['purchase_date'];
        $enroll->renewl = $request['extra_service'];
        $enroll->renewl_date = $request['renewl_date'];
        $enroll->renewl_cost = $request['renewl_cost'];
        $enroll->notes = $request['notes'];

        $enroll->added_by = $user_name;
        $enroll->user_id = $user_id;
        $enroll->save();
        // Return a successful response with the status
        return response()->json(['enroll_id' => $enroll->id, 'status' => 1]);
    }


    public function delete_subscription(Request $request)
    {
        $enroll_id = $request->input('id');
        $enroll = Enrollment::where('id', $enroll_id)->first();
        if (!$enroll) {
            return response()->json(['error' => trans('messages.subscription_not_found', [], session('locale'))], 404);
        }
        $enroll->delete();
        return response()->json([
            'success' => trans('messages.subscription_deleted_lang', [], session('locale'))
        ]);
    }




    public function add_service2(Request $request)
    {


        $user_id = Auth::id();
        $userData = User::find($user_id);
        $user_name = $userData->user_name;

        $service = new Service();
        $service->service_name = $request['service_name'];
        $service->service_cost = $request['service_cost'];
        $service->notes = $request['notes'];
        $service->added_by = $user_name;
        $service->user_id = $user_id;
        $service->save();

        return response()->json(['service_id' => $service->id, 'status' => 1]);
    }


    public function add_customer2(Request $request)
    {


        $user_id = Auth::id();
        $data = User::find($user_id)->first();
        $user = $data->user_name;

        $customer = new Customer();




        $customer->customer_name = $request['customer_name'];
        $customer->customer_number = $request['customer_number'];
        $customer->customer_email = $request['customer_email'];

        $customer->address = $request['address'];
        $customer->added_by = $user;
        $customer->user_id =  $user_id;
        $customer->save();
        // customer add sms
        // $params = [
        //     'customer_id' => $customer->id,
        //     'sms_status' => 1
        // ];
        // $sms = get_sms($params);
        // sms_module($request['customer_phone'], $sms);

        //
        return response()->json(['customer_id' => $customer->id, 'status' => 1]);
    }

    public function all_sub()
    {
        return view('enroll.all_sub');
    }

    public function sub_detail($id)
    {

        $sub_data= Enrollment::where('id', $id)->first();
        $service_ids = explode(',',  $sub_data->service_ids);
        $services = Service::whereIn('id', $service_ids)->get();

        $customer= Customer::where('id', $sub_data->customer_id)->first();



        return view('bill.sub_detail', compact('sub_data', 'customer', 'services'));
    }


    public function add_renewl(Request $request){


        $id=$request->input('renewl_id');
        $enroll= Enrollment::where('id', $id)->first();

        $history = new ReneHistory();

        $history->sub_id= $id;
        $history->old_renewl_date= $request->input('renewl_date');
        $history->new_renewl_date= $request->input('new_renewl_date');
        $history->renewl_cost= $request->input('renewl_cost');
        $history->notes= $request->input('notes');
        $history->save();

        $enroll->renewl_cost= $request->input('renewl_cost');
        $enroll->renewl_date= $request->input('new_renewl_date');
        $enroll->save();


        return response()->json([ 'status' => 1]);




    }

    public function getServiceCost($id)
{
    $service = Service::where('id', $id)->first();

    if ($service) {
        return response()->json([
            'status' => true,
            'service_cost' => $service->service_cost,
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'Service not found',
    ]);
}



}
