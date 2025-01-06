<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Enrollment;
use App\Models\BookingBill;
use App\Models\ReneHistory;
use Illuminate\Http\Request;
use App\Models\BookingPayment;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){



        if (!Auth::check()) {

            return redirect()->route('login_page')->with('error', 'Please LogIn first()');
        }

        $user = Auth::user();

        if (in_array(10, explode(',', $user->permit_type))) {

            return view ('customer.customer');

        } else {

            return redirect()->route('home')->with( 'error', 'You dont have Permission');
        }

    }

    public function show_customer()
    {
        $sno=0;

        $view_customer= Customer::all();
        if(count($view_customer)>0)
        {
            foreach($view_customer as $value)
            {

                $customer_name='<a href="customer_profile/' . $value->id . '">' . ($value->customer_name) . '</a>';

                $modal='<a class="btn btn-outline-secondary btn-sm edit" data-bs-toggle="modal" data-bs-target="#add_customer_modal" onclick=edit("'.$value->id.'") title="Edit">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                        </a>
                        <a class="btn btn-outline-secondary btn-sm edit" onclick=del("'.$value->id.'") title="Delete">
                            <i class="fas fa-trash" title="Edit"></i>
                        </a>';
                $add_data=get_date_only($value->created_at);



                $sno++;
                $json[] = array(
                    $sno,
                    $customer_name,
                    $value->customer_number . '<br>' . $value->customer_email,
                    $value->address,
                    '<span>أضيف بواسطة: ' . $value->added_by . '</span><br>' .
                    '<span>تاريخ الإضافة: ' . $add_data . '</span>',
                    $modal
                );

            }
            $response = array();
            $response['success'] = true;
            $response['aaData'] = $json;
            echo json_encode($response);
        }
        else
        {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }

    public function add_customer(Request $request){


        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;

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
        return response()->json(['customer_id' => $customer->id , 'status' => 1]);

    }

    public function edit_customer(Request $request){
        $customer = new Customer();
        $customer_id = $request->input('id');

        // Use the Eloquent where method to retrieve the customer by column name
        $customer_data = Customer::where('id', $customer_id)->first();

        if (!$customer_data) {
            return response()->json(['error' => trans('messages.customer_not_found', [], session('locale'))], 404);
        }


        $data = [
            'customer_id' => $customer_data->id,
            'customer_name' =>   $customer_data->customer_name,
            'customer_email' =>  $customer_data->customer_email,
            'customer_number' => $customer_data->customer_number,

            'address' => $customer_data->address,


        ];

        return response()->json($data);
    }

    public function update_customer(Request $request){


        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;

        $customer_id = $request->input('customer_id');
        $customer = Customer::where('id', $customer_id)->first();
        if (!$customer) {
            return response()->json(['error' => trans('messages.customer_not_found', [], session('locale'))], 404);
        }



        $customer->customer_name = $request['customer_name'];
        $customer->customer_number = $request['customer_number'];
        $customer->customer_email = $request['customer_email'];

        $customer->address = $request['address'];
        $customer->updated_by = $user;
        $customer->save();
        return response()->json(['customer_id' => '', 'status' => 1]);
    }

    public function delete_customer(Request $request){
        $customer_id = $request->input('id');
        $customer = Customer::where('id', $customer_id)->first();
        if (!$customer) {
            return response()->json(['error' => trans('messages.customer_not_found', [], session('locale'))], 404);
        }
        $customer->delete();
        return response()->json([
            'success' => trans('messages.customer_deleted_lang', [], session('locale'))
        ]);


    }

    // public function customer_profile($id){

    //     $customer= Customer::where('id', $id)->first();

    //     $enrollments = Enrollment::where('customer_id', $customer->id)->with('reneHistory')->get();
    //     $subs = [];

    //     foreach ($enrollments as $enrollment) {
    //         $his= ReneHistory::where('sub_id', $enrollment->id)->get();

    //         $serviceIds = explode(',', $enrollment->service_ids); // Split comma-separated IDs
    //         foreach ($serviceIds as $serviceId) {
    //             $service = Service::where('id', $serviceId)->first();
    //                if ($service) {
    //                 $subs[] = [
    //                     'service_name' => $service->service_name,
    //                     'service_cost' => $service->service_cost,
    //                     'renewl_date' => $enrollment->renewl_date,
    //                     'history' => [
    //                         'old_renewl_date' => $his->old_renewl_date,
    //                         'new_renewl_date' => $his->new_renewl_date,
    //                         'renewl_cost' => $his->renewl_cost,
    //                         'notes' => $his->notes,
    //                     ]
    //                 ];
    //             }
    //         }
    //     }

    //     return view ('customer.customer_profile', compact('customer', 'subs'));



    // }



    public function customer_profile($id)
    {
        // Get customer by ID
        $customer = Customer::where('id', $id)->first();

        // Get enrollments for the customer
        $enrollments = Enrollment::where('customer_id', $customer->id)->get();
        $subs = [];

        // Loop through each enrollment
        foreach ($enrollments as $enrollment) {
            // Split the service_ids into an array
            $serviceIds = explode(',', $enrollment->service_ids);

            // Fetch history for this enrollment (only once)
            $history = ReneHistory::where('sub_id', $enrollment->id)
                ->whereNotNull('new_renewl_date')  // Filter where new_renewl_date is not null
                ->get();

            // Loop through each service ID for the enrollment
            foreach ($serviceIds as $serviceId) {
                // Get the service by its ID
                $service = Service::where('id', $serviceId)->first();

                // If the service exists, add the relevant data to the subs array
                if ($service) {
                    $subs[] = [
                        'service_name' => $service->service_name,
                        'service_cost' => $service->service_cost,
                        'renewl_date' => $enrollment->renewl_date,
                        'history' => $history,
                    ];
                }
            }
        }

        // Return the view with customer and subs data
        return view('customer.customer_profile', compact('customer', 'subs'));
    }




}
