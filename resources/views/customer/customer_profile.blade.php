@extends('layouts.header')

@section('main')
@push('title')
<title> {{ $customer->customer_name ?? '' }}</title>
@endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $customer->customer_name ?? '' }}  </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">{{ trans('messages.customer_profile_lang',[],session('locale')) }}  </a></li>
                                    <li class="breadcrumb-item active"><a href="{{ url('customer') }}">Customers</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="mb-4">
                                                <img src="{{ asset('images/logo-sm.svg') }}" alt=""
                                                    height="24"><span class="logo-txt">
                                                        {{ $customer->customer_name ?? '' }}</span>
                                            </div>
                                        </div>
                                        <input type="hidden" id="customer_id" value="{{ $customer->id ?? '' }}">

                                    </div>

                                    <p class="mb-1">{{ $customer->address ?? '' }}</p>
                                    <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i>
                                        {{ $customer->customer_email ?? '' }}</p>
                                    <p><i class="mdi mdi-phone align-middle me-1"></i> {{ $customer->customer_number ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                   <!-- end card header -->

                                    <div class="card-body">
                                        <h5 class="text-start text-primary">Services Detail</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped align-middle dt-responsive nowrap" style="width: 100%;" id="all_profile_docs_1">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th style="text-align:center;">Service Name</th>
                                                        <th style="text-align:center;">Service Cost</th>
                                                        <th style="text-align:center;">Renewal Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($subs) > 0)
                                                        @foreach($subs as $sub)
                                                            <tr>
                                                                <td style="text-align:center;">{{ $sub['service_name'] }}</td>
                                                                <td style="text-align:center;">{{ $sub['service_cost'] }}</td>
                                                                <td style="text-align:center;">
                                                                    <span class="badge bg-primary">{{ $sub['renewl_date'] }}</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3" style="text-align:center;" class="text-danger">No records found</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                    <!-- end card-body -->

                                </div><!-- end card -->
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                   <!-- end card header -->

                                    <div class="card-body">
                                        <h5 class="text-start text-primary">Renewl History</h5>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped align-middle dt-responsive nowrap" style="width: 100%;" id="all_profile_docs_1">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th style="text-align:center;">Service Name</th>
                                                        <th style="text-align:center;">Renewal Dates</th>
                                                        <th style="text-align:center;">Renewal Cost</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($subs) > 0)
                                                        @foreach($subs as $sub)
                                                            @if(count($sub['history']) > 0)
                                                                @foreach($sub['history'] as $history)
                                                                    <tr>
                                                                        <td style="text-align:center;">{{ $sub['service_name'] }}</td>
                                                                        <td style="text-align:center;">
                                                                            <p>
                                                                                <span class="badge bg-secondary">Old : {{ $history->old_renewl_date }}</span>
                                                                            </p>
                                                                            <p>
                                                                                @if($history->new_renewl_date <= \Carbon\Carbon::now()->format('Y-m-d'))
                                                                                    <span class="badge bg-danger">New: {{ $history->new_renewl_date }}</span>
                                                                                @elseif($history->new_renewl_date > \Carbon\Carbon::now()->format('Y-m-d'))
                                                                                    <span class="badge bg-success">New: {{ $history->new_renewl_date }}</span>
                                                                                @else
                                                                                    <span class="badge bg-warning">No New Date</span>
                                                                                @endif
                                                                            </p>
                                                                        </td>
                                                                        <td style="text-align:center;">
                                                                            <span class="badge bg-info">{{ $history->renewl_cost }}</span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="3" style="text-align:center;" class="text-danger">No history records found</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                    <!-- end card-body -->

                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div>

                    {{-- <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="mt-5">
                                    <h5 class="mb-3">Customer's Other Details</h5>
                                    <ul class="list-unstyled fw-medium px-2">
                                        <li>
                                            <a href="javascript: void(0);" class="text-body pb-3 d-block border-bottom">
                                                Total Bookings
                                                <span id="booking_count" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                 Upcoming Bookings
                                                <span id="up_booking" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                 Total Pyments
                                                <span id="total_payment" class="badge bg-primary-subtle text-primary rounded-pill float-end ms-1 font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                 Total Panelty
                                                <span id="total_panelty" class="badge bg-primary-subtle text-primary rounded-pill float-end ms-1 font-size-12"></span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>

                                <div class="mt-5">
                                    <h5 class="mb-3">Current Bookings</h5>
                                    <div id="current_bookings" class="list-group list-group-flush">
                                        <!-- Bookings will be appended here via JavaScript -->
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end card -->
                    </div> --}}

                </div>

            </div>
            <!-- end row -->
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>



    @include('layouts.footer')
@endsection
