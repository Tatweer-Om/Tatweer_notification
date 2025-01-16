@extends('layouts.header')

@section('main')
    @push('title')
        <title> {{ trans('messages.edit_subscription', [], session('locale')) }}</title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ trans('messages.edit_subscription', [], session('locale')) }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ trans('messages.edit_subscription', [], session('locale')) }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {{ trans('messages.subscription', [], session('locale')) }}</li>
                                </ol>
                            </div>

                        </div>
                    </div>

                </div>
                <form action="" class="update_subscription">
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

                                        <input type="text" class="sub_id" name="sub_id" value="{{ $sub_data->id ?? '' }}" hidden>

                                        <div class="col-lg-10 col-md-9 col-sm-8 mb-1">
                                            <select class="form-control service_id" name="service_id">
                                                <option value="">
                                                    {{ trans('messages.choose_lang', [], session('locale')) }}
                                                </option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        @if($service->id == $service_ids ?? '') selected @endif>
                                                        {{ $service->service_name ?? 'N/A' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-lg-2 col-md-3 col-sm-4 mb-1">
                                            <a type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                                data-bs-target="#add_service_modal">
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
                                            <select class="form-control customer_id" name="customer_id">
                                                <option value="">
                                                    {{ trans('messages.choose_lang', [], session('locale')) }}
                                                </option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        @if($customer->id == $customer_id)
                                                            selected
                                                        @endif>
                                                        {{ $customer->customer_name ?? '' }} (Phone: {{ $customer->customer_number ?? '' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-3 col-sm-4 mb-1">
                                            <a type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                                data-bs-target="#add_customer_modal">
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
                                        @foreach ($system_urls as $index => $url)
                                            <div class="row mb-1 {{ $index === 0 ? 'first-row' : '' }}">
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text" class="form-control" name="system_url[]" value="{{ $url }}" placeholder="{{ trans('messages.enter_system_url_lang', [], session('locale')) }}">
                                                </div>

                                                <!-- + button for first row, x button for others -->
                                                <div class="col-lg-2 col-md-3 col-sm-4">
                                                    @if ($index === 0)
                                                        <button type="button" id="add_url" class="btn btn-primary w-100 add-url">
                                                            +
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger w-100 remove-url">
                                                            x
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                    <!-- Add New Input Button -->



                                </div>
                            </div>



                            <div class="col-lg-3 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="purchase_date" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.purchase_date_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form datepick" name="purchase_date" id="purchase_date"
                                     value="{{ old('purchase_date', $purchase_date ?? '') }}">

                                </div>
                            </div>
                            <div class="col-lg-3 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="service_cost" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.service_cost_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form service_cost" name="service_cost" id="service_cost"
                                     value="{{ old('service_cost', $service_cost ?? '') }}">

                                </div>
                            </div>
                            <div class="col-lg-3 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="business_name" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.business_name_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form business_name" name="business_name" id="business_name"
                                     value="{{ old('business_name', $business_name ?? '') }}">

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
                                            <!-- Check if the value of renewl is 1 (on), if so, check the box -->
                                            <input type="checkbox" id="extra_service_switch" switch="success" name="extra_service"
                                                {{ $sub_data->renewl == 'on' ? 'checked' : '' }} />
                                            <label for="extra_service_switch"
                                                data-on-label="{{ trans('messages.yes_lang', [], session('locale')) }}"
                                                data-off-label="{{ trans('messages.no_lang', [], session('locale')) }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12 mb-1 toggle-input" style="display: {{ $sub_data->renewl == 1 ? 'block' : 'none' }};">
                                <!-- Full width on mobile (col-12), 3 columns on larger screens (col-lg-3) -->
                                <div class="external-event fc-event text-dark bg-success-subtle" data-class="bg-success">
                                    <label for="renewl_date" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_date_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form datepick" name="renewl_date"
                                        id="renewl_date" value="{{ old('renewl_date', $sub_data->renewl_date ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-12 mb-1 toggle-input" style="display: {{ $sub_data->renewl == 1 ? 'block' : 'none' }};">
                                <!-- Full width on mobile (col-12), 3 columns on larger screens (col-lg-3) -->
                                <div class="external-event fc-event text-dark bg-success-subtle p-2" data-class="bg-success">
                                    <label for="renewl_cost" class="form-label font-size-11">
                                        <i class="mdi mdi-cash font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_cost_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form renewl_cost" name="renewl_cost"
                                        id="renewl_cost" value="{{ old('renewl_cost', $sub_data->renewl_cost ?? '') }}">
                                </div>
                            </div>


                            <div class="col-lg-11 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-success-subtle text-left notes" data-class="bg-success" style="width:106.6%;">
                                    <label for="notes" class="form-label font-size-11">
                                        <i class="mdi mdi-note-outline font-size-11 me-1"></i> <!-- Change to a note icon -->
                                        {{ trans('messages.notes_lang', [], session('locale')) }}
                                    </label>
                                    <textarea class="form-control notes" name="notes" id="notes" rows="5">{{ old('notes', $sub_data->notes ?? '') }}</textarea>
                                </div>
                            </div>



                        </div>
                        <div class="col-lg-12 col-md-3 col-sm-4 d-flex justify-content-end subscription_btn">
                            <button type="submit" class="btn btn-primary w-100 update_subscription">
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



    @include('layouts.footer')
@endsection
