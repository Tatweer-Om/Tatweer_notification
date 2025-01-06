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
                                        <a href="{{ url('enrol') }}">
                                            {{ trans('messages.add_subscription', [], session('locale')) }}
                                        </a>
                                    </li>

                                </ol>
                            </div>

                        </div>
                    </div>

                </div>


            <div class="table-responsive mb-4">
                <table class="table align-middle datatable dt-responsive table-check nowrap " id="all_subscription" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                    <thead>
                      <tr>
                        <th scope="col" style="text-align: start;">{{ trans('messages.sr_number', [], session('locale')) }}</th>

                        <th scope="col" style="text-align: start;">{{ trans('messages.customer_detail', [], session('locale')) }}</th>

                        <th scope="col" style="text-align: start;">{{ trans('messages.services', [], session('locale')) }}</th>
                        <th scope="col" style="text-align: start;">{{ trans('messages.renewl_date_on', [], session('locale')) }}</th>
                        <th scope="col" style="text-align: start;">{{ trans('messages.remaning_period', [], session('locale')) }}</th>


                        <th scope="col" style="text-align: start;">{{ trans('messages.added_by', [], session('locale')) }}</th>
                        <th scope="col" style="text-align: start;">{{ trans('messages.added_on', [], session('locale')) }}</th>
                        <th style="width: 80px; min-width: 80px; text-align: start;">{{ trans('messages.action', [], session('locale')) }}</th>

                      </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
                <!-- end table -->
            </div>
            <!-- end table responsive -->

        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="add_renewl_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ trans('messages.renewl_data_lang',[],session('locale')) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="add_renewl" method="POST">
                        @csrf
                        <input type="hidden" class="renewl_id" name="renewl_id" id="renewl_id" hidden>
                        <div class="row">

                            <!-- renewl Name -->
                            <div class="col-lg-6 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-primary-subtle p-2">
                                    <label for="renewl_name" class="form-label font-size-11">
                                        <i class="mdi mdi-tag font-size-11 me-1"></i>
                                        {{ trans('messages.service_name_lang', [], session('locale')) }}
                                    </label>
                                    <input class="form-control service_name" name="service_name" type="text" id="service_name">
                                </div>
                            </div>

                            <!-- renewl Cost -->
                            <div class="col-lg-6 col-12 mb-1">
                                <div class="external-event fc-event text-dark bg-primary-subtle p-2">
                                    <label for="renewl_cost" class="form-label font-size-11">
                                        <i class="mdi mdi-cash font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_cost_lang', [], session('locale')) }}
                                    </label>
                                    <input class="form-control renewl_cost" name="renewl_cost" type="text" id="renewl_cost">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mb-1 toggle-input">
                                <div class="external-event fc-event text-dark bg-primary-subtle" data-class="bg-primary">
                                    <label for="renewl_date" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.renewl_date_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form datepick" name="renewl_date"
                                        id="renewl_date">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mb-1 toggle-input">
                                <div class="external-event fc-event text-dark bg-primary-subtle" data-class="bg-primary">
                                    <label for="renewl_date" class="form-label font-size-11">
                                        <i class="mdi mdi-calendar-check font-size-11 me-1"></i>
                                        {{ trans('messages.new_renewl_date_lang', [], session('locale')) }}
                                    </label>
                                    <input type="text" class="form-control class_form datepick" name="new_renewl_date"
                                        id="new_renewl_date">
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
