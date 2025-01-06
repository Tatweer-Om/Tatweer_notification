

@extends('layouts.header')

@section('main')
    @push('title')
        <title> {{ trans('messages.subscription', [], session('locale')) }}</title>
    @endpush

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Invoice Detail</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                <li class="breadcrumb-item active">Invoice Detail</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                           <div class="invoice-title" style="background-color: #0452a5; color: white; padding: 20px; position: relative;">
                                <!-- Logo Section -->
                                <div style="position: absolute; top: 50%; left: 20px; transform: translateY(-50%);">
                                    <img src="assets/images/logo-sm.svg" alt="Logo" height="50">
                                </div>

                                <!-- Centered Title -->
                                <div style="text-align: center; font-size: 24px; font-weight: bold;">
                                    Tatweer for Software Solutions
                                </div>
                            </div> <br>
                            <div class="invoice-title">
                                <div class="d-flex align-items-start">

                                    <div class="flex-shrink-0">
                                        <div class="mb-1">
                                            <h4 class=" font-size-16">Invoice # 2025-{{ $sub_data->id ?? ''}}</h4> <br>
                                            <h4 class=" font-size-16">{{ $customer->customer_name ?? ''}}</h4>

                                        </div>
                                        <p class="mb-1"><i class="mdi mdi-calendar align-middle me-1"></i>Subscription Date: {{ $sub_data->purchase_date ?? '' }}</p>

                                        <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> Customer Email: {{ $customer->customer_email ?? ''}}</p>
                                        <p><i class="mdi mdi-phone align-middle me-1"></i>Customer Phone: {{ $customer-> customer_number ?? ''}}</p>
                                    </div>
                                </div>

                            </div>
                            <hr class="my-4">
                            {{-- <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h5 class="font-size-15 mb-3">Billed To:</h5>
                                        <h5 class="font-size-14 mb-2">Richard Saul</h5>
                                        <p class="mb-1">1208 Sherwood Circle
                                            Lafayette, LA 70506</p>
                                        <p class="mb-1">RichardSaul@rhyta.com</p>
                                        <p>337-256-9134</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <div>
                                            <h5 class="font-size-15">Order Date:</h5>
                                            <p>February 16, 2020</p>
                                        </div>

                                        <div class="mt-4">
                                            <h5 class="font-size-15">Payment Method:</h5>
                                            <p class="mb-1">Visa ending **** 4242</p>
                                            <p>richards@email.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="py-2 mt-3">
                                <h5 class="font-size-15">Services summary</h5>
                            </div>
                            <div class="p-4 border rounded">
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Services Detail</th>
                                                <th>Renewl Detail</th>

                                                <th class="text-end" style="width: 120px;">Service Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $key => $service)
                                            @php
                                            $enroll = DB::table('enrollments')
                                                ->whereRaw("FIND_IN_SET(?, service_ids)", [$service->id])
                                                ->first();
                                        @endphp

                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{ $service->service_name ?? '' }}</h5>
                                                    <p class="font-size-13 text-muted mb-0">OMR {{ number_format($service->service_cost, 3) }}</p>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">
                                                        Renewal Price: OMR {{ number_format(optional($enroll)->renewl_cost, 3) }}
                                                    </h5>
                                                    <p class="font-size-13 text-muted mb-0">
                                                        Renewal Date: {{ optional($enroll)->renewl_date ?? 'N/A' }}
                                                    </p>
                                                </td>
                                                <td class="text-end">OMR</td>
                                            </tr>

                                        @endforeach

                                            <tr>
                                                <th scope="row" colspan="2" class="border-0 text-end">
                                                    Discount</th>
                                                <td class="border-0 text-end">$12.00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="2" class="border-0 text-end">
                                                    Paid Amount</th>
                                                <td class="border-0 text-end">$12.00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="2" class="border-0 text-end">Remaining Amount</th>
                                                <td class="border-0 text-end"><h4 class="m-0">$1010.00</h4></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-print-none mt-3">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                    <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
@include('layouts.footer')
@endsection
