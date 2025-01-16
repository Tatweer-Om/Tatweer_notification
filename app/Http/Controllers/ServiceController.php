<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(){


        if (!Auth::check()) {

            return redirect()->route('login_page')->with('error', trans('messages.please_log_in', [], session('locale')));
        }

        $user = Auth::user();

        if (in_array(11, explode(',', $user->permit_type))) {

            return view ('services.service');

        } else {


 return redirect()->route('/')->with('error', trans('messages.you_dont_have_permissions', [], session('locale')));
        }

    }

    public function show_service()
    {
        $sno=0;

        $view_service= Service::all();
        if(count($view_service)>0)
        {
            foreach($view_service as $value)
            {





                $modal='<a class="btn btn-outline-secondary btn-sm edit" data-bs-toggle="modal" data-bs-target="#add_service_modal" onclick=edit("'.$value->id.'") title="Edit">
                            <i class="fas fa-pencil-alt" title="Edit"></i>
                        </a>
                        <a class="btn btn-outline-secondary btn-sm edit" onclick=del("'.$value->id.'") title="Delete">
                            <i class="fas fa-trash" title="Edit"></i>
                        </a>';
                $add_data=get_date_only($value->created_at);



                $sno++;
                $json[] = array(
                $sno,
                $value->service_name,
                $value->service_cost,
                '<span style="text-align: justify; white-space: pre-line;">' . $value->notes . '</span>',
                $value->added_by,
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

    public function add_service(Request $request)
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

        return response()->json(['service_id' => $service->id, 'service_name'=>$service->service_name, 'status' => 1]);
    }


    public function edit_service(Request $request)
    {
        $service_id = $request->input('id');
        $service_data = Service::where('id', $service_id)->first();

        if (!$service_data) {
            return response()->json(['error' => trans('messages.service_not_found', [], session('locale'))], 404);
        }

        $course_ids = !empty($service_data->course_id) ? explode(',', $service_data->course_id) : [];

        $select_option='';



        $data = [
            'service_id' => $service_data->id,
            'service_name' => $service_data->service_name,
            'service_cost' => $service_data->service_cost,
            'notes' => $service_data->notes,
        ];

        return response()->json($data);
    }


    public function update_service(Request $request)
    {
        $user_id = Auth::id();
        $userData = User::find($user_id);
        $user_name = $userData->user_name;

        // Find the service by ID
        $service_id = $request->input('service_id');
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            return response()->json(['error' => trans('messages.service_not_found', [], session('locale'))], 404);
        }

        $service->service_name = $request['service_name'];
        $service->service_cost = $request['service_cost'];
        $service->notes = $request['notes'];
        $service->updated_by = $user_name;
        $service->user_id = $user_id;
        $service->save();

        return response()->json(['service_id' => $service->id, 'status' => 1]);
    }


    public function delete_service(Request $request){
        $service_id = $request->input('id');
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            return response()->json(['error' => trans('messages.service_not_found', [], session('locale'))], 404);
        }
        $service->delete();
        return response()->json([
            'success' => trans('messages.service_deleted_lang', [], session('locale'))
        ]);


    }

    public function service_profile($id){

        $service= Service::where('id', $id)->first();

        return view ('service.service_profile', compact('service'));


    }



}
