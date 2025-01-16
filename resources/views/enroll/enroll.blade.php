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
                            <h4 class="mb-sm-0 font-size-18">{{ trans('messages.subscription', [], session('locale')) }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ trans('messages.subscription', [], session('locale')) }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a href="{{ url('all_sub') }}">
                                            {{ trans('messages.subscription_list', [], session('locale')) }}
                                        </a>
                                    </li>

                                </ol>
                            </div>

                        </div>
                    </div>

                </div>
                <form action="" class="subscription_list">
                    @csrf
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-4 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                    <label for="choices-multiple-remove-button" class="form-label font-size-11">
                                        <i class="mdi mdi-cog font-size-11 me-1"></i> <!-- Added icon -->
                                        {{ trans('messages.select_services_lang', [], session('locale')) }}
                                    </label>
                                    <div class="row">

                                        <div class="col-lg-10 col-md-9 col-sm-8 mb-1">
                                            <select class="form-control service_id searchable" id="service_id" name="service_id">
                                                <option value="">
                                                    {{ trans('messages.choose_lang', [], session('locale')) }}
                                                </option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">
                                                        {{ $service->service_name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="col-lg-2 col-md-3 col-sm-4 mb-1">
                                            <a type="button" class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
                                               data-bs-toggle="modal" data-bs-target="#add_service_modal2">
                                                +
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>




                            <div class="col-lg-4 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                    <label for="customer_id" class="form-label font-size-11">
                                        <i class="mdi mdi-account font-size-11 me-1"></i>
                                        <!-- Added icon for consistency -->
                                        {{ trans('messages.customer_id_lang', [], session('locale')) }}
                                    </label>
                                    <div class="row">

                                        <div class="col-lg-10 col-md-9 col-sm-8 mb-1">
                                            <select class="form-control customer_id" id="customer_id" name="customer_id">
                                                <option value="">
                                                    {{ trans('messages.choose_lang', [], session('locale')) }}
                                                </option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">
                                                        {{ $customer->customer_name ?? '' }} (Phone: {{ $customer->customer_number ?? '' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-3 col-sm-4 mb-1">
                                            <a type="button" class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
                                               data-bs-toggle="modal" data-bs-target="#add_customer_modal">
                                                +
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                    <label for="system_url" class="form-label font-size-11">
                                        <i class="mdi mdi-web font-size-11 me-1"></i>
                                        {{ trans('messages.system_url_lang', [], session('locale')) }}
                                    </label>
                                    <div id="url-container">
                                        <div class="row mb-1">
                                            <div class="col-lg-10 col-md-9 col-sm-8">
                                                <input type="text" class="form-control" name="system_url[]"
                                                    placeholder="{{ trans('messages.enter_system_url_lang', [], session('locale')) }}">
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-4">
                                                <button type="button" class="btn btn-primary w-100 d-flex justify-content-center align-items-center add-url">
                                                    +
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-3 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="purchase_date" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.purchase_date_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form datepick" name="purchase_date"
                                        id="purchase_date">
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="service_cost" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.service_cost_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form service_cost" name="service_cost"
                                        id="service_cost">
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="business_name" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.business_name_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form business_name" name="business_name"
                                        id="business_name">
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <h5 class="font-size-11 mb-3">
                                        <i class="mdi mdi-plus-circle font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_lang', [], session('locale')) }}
                                    </h5>
                                    <div class="d-flex justify-content-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="extra_service_switch" switch="success" name="extra_service" />
                                            <label for="extra_service_switch"
                                                data-on-label="{{ trans('messages.yes_lang', [], session('locale')) }}"
                                                data-off-label="{{ trans('messages.no_lang', [], session('locale')) }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 mb-1 toggle-input" style="display: none;">
                                <!-- Full width on mobile (col-12), 3 columns on larger screens (col-lg-3) -->
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="renewl_date" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_date_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form datepick" name="renewl_date"
                                        id="renewl_date">
                                </div>
                            </div>
                            <div class="col-lg-3 col-12 mb-1 toggle-input" style="display: none;">
                                <!-- Full width on mobile (col-12), 3 columns on larger screens (col-lg-3) -->
                                <div class="external-event fc-event text-dark bg-success-subtle p-2"
                                    data-class="bg-success">
                                    <label for="renewl_cost" class="form-label font-size-11">
                                        <i class="mdi mdi-cash font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_cost_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form renewl_cost" name="renewl_cost"
                                        id="renewl_cost">
                                </div>
                            </div>

                            <div class="col-lg-11 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle text-left notes" data-class="bg-success" style="width:106.6%;">
                                    <label for="notes" class="form-label font-size-11">
                                        <i class="mdi mdi-note-outline font-size-11 me-1"></i> <!-- Change to a note icon -->
                                        {{ trans('messages.notes_lang', [], session('locale')) }}
                                    </label>
                                    <textarea class="form-control notes" name="notes" id="notes" rows="5"></textarea>
                                </div>

                            </div>


                        </div>
                        <div class="col-lg-12 col-md-3 col-sm-4 d-flex justify-content-end subscription_btn">
                            <button type="submit" class="btn btn-primary w-100 add-url">
                                Submit
                            </button>
                        </div>

                    </div>



                    <!-- New Row for the Second Card Body -->

            </div>

            </form>


            <!-- end table responsive -->

        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="add_customer_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ trans('messages.add_data_lang', [], session('locale')) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" class="add_customer" method="POST">
                    @csrf
                    <input type="hidden" class="customer_id" name="customer_id">

                    <div class="row">
                        <!-- Customer Name -->
                        <div class="col-lg-4 col-12 mb-1">
                            <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                <label for="customer_name" class="form-label font-size-11">
                                    <i class="mdi mdi-account font-size-11 me-1"></i>
                                    {{ trans('messages.customer_name_lang', [], session('locale')) }}
                                </label>
                                <input class="form-control customer_name" name="customer_name" type="text"
                                    id="customer_name">
                            </div>
                        </div>

                        <!-- Customer Number -->
                        <div class="col-lg-4 col-12 mb-1">
                            <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                <label for="customer_number" class="form-label font-size-11">
                                    <i class="mdi mdi-phone font-size-11 me-1"></i>
                                    {{ trans('messages.customer_number_lang', [], session('locale')) }}
                                </label>
                                <input class="form-control customer_number isnumber" name="customer_number"
                                    type="text" id="customer_number">
                            </div>
                        </div>

                        <!-- Customer Email -->
                        <div class="col-lg-4 col-12 mb-1">
                            <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                <label for="customer_email" class="form-label font-size-11">
                                    <i class="mdi mdi-email font-size-11 me-1"></i>
                                    {{ trans('messages.customer_email_lang', [], session('locale')) }}
                                </label>
                                <input class="form-control customer_email" name="customer_email" type="text"
                                    id="customer_email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="col-12 mb-1">
                            <div class="external-event fc-event text-dark bg-success-subtle p-2">
                                <label for="address" class="form-label font-size-11">
                                    <i class="mdi mdi-note font-size-11 me-1"></i>
                                    {{ trans('messages.notes_lang', [], session('locale')) }}
                                </label>
                                <textarea class="form-control address" name="address" id="address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ trans('messages.close_lang', [], session('locale')) }}</button>
                        <button type="submit"
                            class="btn btn-primary submit_form">{{ trans('messages.submit_lang', [], session('locale')) }}</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
</div>


    <div class="modal fade" id="add_service_modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ trans('messages.add_data_lang',[],session('locale')) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="add_service2" method="POST">
                        @csrf
                        <div class="row">

                            <!-- Service Name -->
                            <div class="col-lg-6 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-primary-subtle p-2">
                                    <label for="service_name" class="form-label font-size-11">
                                        <i class="mdi mdi-tag font-size-11 me-1"></i>
                                        {{ trans('messages.service_name_lang', [], session('locale')) }}
                                    </label>
                                    <input class="form-control service_name" name="service_name" type="text" id="service_name">
                                </div>
                            </div>

                            <!-- Service Cost -->
                            <div class="col-lg-6 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-primary-subtle p-2">
                                    <label for="service_cost" class="form-label font-size-11">
                                        <i class="mdi mdi-cash font-size-11 me-1"></i>
                                        {{ trans('messages.service_cost_lang', [], session('locale')) }}
                                    </label>
                                    <input class="form-control service_cost2" name="service_cost" type="text" id="service_cost">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Notes -->
                            <div class="col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-primary-subtle p-2">
                                    <label for="notes" class="form-label font-size-11">
                                        <i class="mdi mdi-note font-size-11 me-1"></i>
                                        {{ trans('messages.notes_lang', [], session('locale')) }}
                                    </label>
                                    <textarea class="form-control notes" name="notes" id="notes" rows="3"></textarea>
                                </div>
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                {{ trans('messages.close_lang', [], session('locale')) }}
                            </button>
                            <button type="submit" class="btn btn-primary submit_form">
                                {{ trans('messages.submit_lang', [], session('locale')) }}
                            </button>
                        </div>
                    </form>

                </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
