@extends('layouts.header')

@section('main')
    @push('title')
        <title> {{ trans('messages.customer_lang', [], session('locale')) }}</title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ trans('messages.customer_lang', [], session('locale')) }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ trans('messages.pages_lang', [], session('locale')) }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {{ trans('messages.customer_lang', [], session('locale')) }}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#add_customer_modal">
                                    {{ trans('messages.add_data_lang', [], session('locale')) }}
                                </button>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="all_customer" class="table table-bordered dt-responsive nowrap w-80">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('messages.customer_lang', [], session('locale')) }}</th>
                                                <th>{{ trans('messages.contact_lang', [], session('locale')) }}</th>
                                                <th>{{ trans('messages.detail_lang', [], session('locale')) }}</th>
                                                <th>{{ trans('messages.added_by_lang', [], session('locale')) }}</th>
                                                <th>{{ trans('messages.actions_lang', [], session('locale')) }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data dynamically generated here -->
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

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

        @include('layouts.footer_content')
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    @include('layouts.footer')
@endsection
