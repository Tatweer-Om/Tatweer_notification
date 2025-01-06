<?php

use App\Models\Enrollment;
use App\Models\Sms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

function get_date_only($timestamp)
{
    // Create a DateTime object from the timestamp
    $dateTime = new DateTime($timestamp);

    // Format the date as YYYY-MM-DD
    $dateOnly = $dateTime->format('Y-m-d');

    return $dateOnly;
}
function getColumnValue($table, $columnToSearch, $valueToSearch, $columnToRetrieve)
{
    $result = DB::table($table)
                ->where($columnToSearch, $valueToSearch)
                ->first();

    if ($result) {
        return $result->{$columnToRetrieve};
    }

    return 'n/a'; // or any default value you prefer
}
function get_date_time($timestamp)
{
    // Create a DateTime object from the timestamp
    $dateTime = new DateTime($timestamp);

    // Format the date as YYYY-MM-DD
    $formattedDateTime = $dateTime->format('Y-m-d h:i A');

    return $formattedDateTime;
}



function get_sms($params)
{
    $customer_name = "";
    $customer_number = "";
    $renewl_date = "";
    $purchase_date= "";
    $renewl_cost = "";
    $service_name= "";
    $teacher_name= "";
    $company= "";
    $notes="";
    $sms_status="";


    $sms_text = Sms::where('sms_status', $params['sms_status'])->first();
    if($params['sms_status']==1)
    {

        $customer_name = $params['customer_name'];
        $purchase_date = $params['purchase_date'];
        $renewl_date= $params['renewl_date'];
        $renewl_cost= $params['renewl_cost'];
        $service_name= $params['service_name'];
        $company= $params['company'];

    }


    $variables = [

        'customer_name' => $customer_name,
        'service_name' => $service_name,
        'renewl_date' => $renewl_date,
        'renewl_cost' => $renewl_cost,
        'purchase_date' => $purchase_date,
        'company' => $company,


    ];

    $string = base64_decode($sms_text->sms);
    foreach ($variables as $key => $value) {
        $string = str_replace('{' . $key . '}', $value, $string);
    }
    return $string;
}
function sms_module($contact, $sms)
{
    if (!empty($contact)) {
        $url = "http://myapp3.com/whatsapp_admin_latest/Api_pos/send_request";

        $form_data = [
            'status' => 1,
            'sender_contact' => '968' . $contact,
            'customer_id' => 'tatweeersoftweb',
            'instance_id' => '1xwaxr8k',
            'sms' => base64_encode($sms),
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $result=json_decode($resp,true);
        // $return_status= $result['response'];

    }
}


?>
