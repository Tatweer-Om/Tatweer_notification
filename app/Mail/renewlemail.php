<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class renewlemail extends Mailable
{
    use Queueable, SerializesModels;

    public $service_name;
    public $purchase_date;
    public $renewl_date;
    public $company;
    public $renewl_cost;
    public $customer_name;
    public $logo;

    /**
     * Create a new message instance.
     */
    public function __construct($customer_name, $logo, $company, $service_name, $purchase_date, $renewl_cost, $renewl_date)
    {
        $this->customer_name = $customer_name;
        $this->company = $company;
        $this->purchase_date = $purchase_date;
        $this->service_name = $service_name;
        $this->renewl_cost = $renewl_cost;
        $this->renewl_date = $renewl_date;
        $this->logo = $logo;



    }

    /**
     * Build the message.
     */
    public function build()
{
    return $this->subject('Subscription Email')
                ->view('email.renew_email')
                ->with([
                    'customer_name' => $this->customer_name,
                    'service_name' => $this->service_name,
                    'renewl_date' => $this->renewl_date,
                    'renewl_cost' => $this->renewl_cost,
                    'purchase_date' => $this->purchase_date,
                    'logo' => $this->logo,
                    'company' => $this->company,
                ]);
}



}
