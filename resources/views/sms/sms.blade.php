@extends('layouts.header')

@section('main')
@push('title')
<title> {{ trans('messages.sms_panel',[],session('locale')) }}</title>
@endpush


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.sms_lang',[],session('locale')) }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('messages.pages_lang',[],session('locale')) }}</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.sms_lang',[],session('locale')) }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                    {{ Session::get('success') }}
                </div>
            @endif
                <form action="{{ url('add_status_sms') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-row">
                                <label for="validationCustom04">{{ trans('messages.panel_available_msg_lang', [], session('locale')) }}:</label>
                                <select class="form-control sms_status" name="status" id="sms_status">
                                    <option value="">{{ trans('messages.panel_choose_lang', [], session('locale')) }}</option>
                                    <option value="1">{{ trans('messages.panel_customer_subscription_lang', [], session('locale')) }}</option>
                                    <option value="2">{{ trans('messages.renewl_date_lang', [], session('locale')) }}</option>
                                    <option value="3">{{ trans('messages.eid_ul_fitar_lang', [], session('locale')) }}</option>
                                    <option value="4">{{ trans('messages.eid_ul_adha_lang', [], session('locale')) }}</option>
                                    <option value="5">{{ trans('messages.national_day_lang', [], session('locale')) }}</option>

                                </select>
                            </div>
                            <br>
                            <b>
                                <div class="form-row">
                                    <p>{{ trans('messages.panel_variables_lang', [], session('locale')) }}</p>
                                </div>

                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success customer_name">{{ trans('messages.customer_name', [], session('locale')) }}</p>
                                </div>
                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success customer_number">{{ trans('messages.customer_number', [], session('locale')) }}</p>
                                </div>

                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success purchase_date">{{ trans('messages.purchase_date', [], session('locale')) }}</p>
                                </div>

                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success renewl_date">{{ trans('messages.renewl_date', [], session('locale')) }}</p>
                                </div>
                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success service_name">{{ trans('messages.service_name', [], session('locale')) }}</p>
                                </div>
                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success status">{{ trans('messages.status_lang', [], session('locale')) }}</p>
                                </div>
                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success company">{{ trans('messages.company_lang', [], session('locale')) }}</p>
                                </div>
                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success renewl_cost">{{ trans('messages.renewl_cost_lang', [], session('locale')) }}</p>
                                </div>

                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success notes">{{ trans('messages.notes_lang', [], session('locale')) }}</p>
                                </div>
                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success url">{{ trans('messages.url_lang', [], session('locale')) }}</p>
                                </div>

                                <div class="form-row">
                                    <p style="text-decoration: none;cursor: pointer;" class="text text-success expiry_date">{{ trans('messages.expiry_date_lang', [], session('locale')) }}</p>
                                </div>




                            </b>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <label for="validationCustom04">{{ trans('messages.panel_content_lang', [], session('locale')) }}</label>
                                <textarea class="form-control sms_area" id="sms" name="sms" placeholder="{{ trans('messages.sms_placeholder_lang', [], session('locale')) }}" rows="9" required=""></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-primary" type="submit">{{ trans('messages.submit_lang', [], session('locale')) }}</button>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
</div>


@include('layouts.footer')
@endsection

