<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Customer;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Mail\SendReminderEmail;
use Illuminate\Support\Facades\Mail;

class CronJobController extends Controller
{
    public function getAndSendEmails()
    {
        $enrollments = Enrollment::get();

        foreach ($enrollments as $enrollment) {

            $setting= Setting::first();
            $company= $setting->company_name;
            $phone= $setting->company_phone;
            $purchase_date= $enrollment->purchase_date;
            $renewl_date= $enrollment->renewl_date;
            $renewl_cost= $enrollment->renewl_cost;


            // Get student details
            $customer = Customer::where('id', $enrollment->Customer_id)->first();
            $customer_name = $customer->customer_name;

            $service = Service::where('id', $enrollment->service_ids)->first();
            $service_name= $service->service_name;


            if ($customer && $service) {
                Mail::to($customer->customer_email)->send(new SendReminderEmail($customer_name, $company, $phone, $service_name, $renewl_date, $purchase_date, $renewl_cost));

                if (Carbon::parse($renewl_date)->subMonths(2)->isToday()) {
                    Mail::to($customer->customer_email)->send(new SendReminderEmail($customer_name, $company, $phone, $service_name, $renewl_date, $purchase_date, $renewl_cost));
                }

                // Send emails 1 month before the renewal date
                if (Carbon::parse($renewl_date)->subMonth()->isToday()) {
                    Mail::to($customer->customer_email)->send(new SendReminderEmail($customer_name, $company, $phone, $service_name, $renewl_date, $purchase_date, $renewl_cost));
                }

                // Send emails 10 days before the renewal date
                if (Carbon::parse($renewl_date)->subDays(10)->isToday()) {
                    Mail::to($customer->customer_email)->send(new SendReminderEmail($customer_name, $company, $phone, $service_name, $renewl_date, $purchase_date, $renewl_cost));
                }

                // Send emails on the renewal date
                if (Carbon::parse($renewl_date)->isToday()) {
                    Mail::to($customer->customer_email)->send(new SendReminderEmail($customer_name, $company, $phone, $service_name, $renewl_date, $purchase_date, $renewl_cost));
                }

                $params = [
                    'customer_name' => $customer_name,
                    'service_name' => $service_name,
                    '$renewl_date' => $renewl_date,
                    '$renewl_costs' => $renewl_cost,
                    'purchase_date' => $purchase_date,
                    'company' => $company,
                    'sms_status' => 2
                ];
                $sms = get_sms($params);
                sms_module($customer->customer_number, $sms);

            }
        }

        return response()->json(['message' => 'Notifications sent to enrolled students.']);
    }

    private function sendWhatsAppMessage($whatsappNumber, $enrollment)
    {
        $message = "Hello, you have been enrolled in the course on " . $enrollment->created_at->format('Y-m-d') . ".";

        // Replace this part with your WhatsApp API logic
        // Example with Twilio (You need to configure Twilio SDK)

        // Twilio::message($whatsappNumber, $message);

        // Alternatively, you can integrate any other WhatsApp API.
    }
}
