@extends('layouts.header')

@section('main')
@push('title')
<title> {{ trans('messages.service_lang',[],session('locale')) }}</title>
@endpush

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.service_lang',[],session('locale')) }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('messages.pages_lang',[],session('locale')) }}</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.service_lang',[],session('locale')) }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <button
                                type="button"
                                class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal"
                                data-bs-target="#add_service_modal">
                                {{ trans('messages.add_data_lang', [], session('locale')) }}
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="all_service" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('messages.service_lang', [], session('locale')) }}</th>
                                            <th>{{ trans('messages.service_cost_lang', [], session('locale')) }}</th>
                                            <th>{{ trans('messages.notes_lang', [], session('locale')) }}</th>
                                            <th>{{ trans('messages.added_by_lang', [], session('locale')) }}</th>

                                            <th>{{ trans('messages.actions_lang', [], session('locale')) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
             <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <div class="modal fade" id="add_service_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ trans('messages.add_data_lang',[],session('locale')) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="add_service" method="POST">
                        @csrf
                        <input type="hidden" class="service_id" name="service_id">
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
                                    <input class="form-control service_cost" name="service_cost" type="text" id="service_cost">
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

    @include('layouts.footer_content')
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
@include('layouts.footer')
@endsection

