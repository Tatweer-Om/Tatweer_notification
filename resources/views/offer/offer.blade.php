@extends('layouts.header')

@section('main')
@push('title')
<title> {{ trans('messages.offer_lang',[],session('locale')) }}</title>
@endpush
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.offer_lang',[],session('locale')) }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('messages.pages_lang',[],session('locale')) }}</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.offer_lang',[],session('locale')) }}</li>
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
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add_offer_modal">
                                {{ trans('messages.add_data_lang',[],session('locale')) }}
                            </button>
                        </div>
                        <div class="card-body">

                            <table id="all_offer" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('messages.offer_lang',[],session('locale')) }}</th>
                                        <th>{{ trans('messages.detail_lang',[],session('locale')) }}</th>
                                        <th>{{ trans('messages.notes_lang',[],session('locale')) }}</th>
                                        <th>{{ trans('messages.added_by_lang',[],session('locale')) }}</th>
                                        <th>{{ trans('messages.actions_lang',[],session('locale')) }}</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <div class="modal fade" id="add_offer_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ trans('messages.add_data_lang',[],session('locale')) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="add_offer" method="POST">
                        @csrf
                        <input type="hidden" class="offer_id" name="offer_id">
                        <div class="row">

                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <label for="choices-multiple-remove-button" class="form-label font-size-13 text-muted">Choose Courses</label>
                                    <select class="form-control course_id" name="course_id[]"
                                        id="choices-multiple-remove-button"
                                        placeholder="This is a placeholder" multiple>
                                        <option value="">{{ trans('messages.choose_lang',[],session('locale')) }}</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="offer_name" class="form-label">{{ trans('messages.offer_name_lang',[],session('locale')) }}</label>
                                    <input class="form-control offer_name" name="offer_name" type="text" id="offer_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="offer_discount" class="form-label">{{ trans('messages.offer_discount_lang',[],session('locale')) }}</label>
                                    <input class="form-control offer_discount issnumber" name="offer_discount" type="text" id="offer_discount">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">{{ trans('messages.start_date_lang',[],session('locale')) }}</label>
                                    <input class="form-control start_date datepick" name="start_date" type="text" id="start_date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">{{ trans('messages.end_date_lang',[],session('locale')) }}</label>
                                    <input class="form-control end_date datepick" name="end_date" type="text" id="end_date">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">{{ trans('messages.notes_lang',[],session('locale')) }}</label>
                                    <textarea class="form-control notes" name="notes" id="notes" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('messages.close_lang',[],session('locale')) }}</button>
                            <button type="submit" class="btn btn-primary submit_form">{{ trans('messages.submit_lang',[],session('locale')) }}</button>
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

