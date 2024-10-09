@extends('layouts.header')
@section('main')
    @push('title')
        <title>  {{ $report_name ?? '' }}</title>
    @endpush

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.reports') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('messages.reports') }}</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.income_report') }}</li>
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

                            <form id="incomeReportForm" action="{{ route('income_report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="w-100">
                                                <label for="date_from" class="form-label">{{ trans('messages.date_from') }} </label>
                                                <input class="form-control datepick" id="date_from" name="date_from" placeholder="{{ trans('messages.from_date') }}"
                                                       value="{{ old('date_from', $sdate ?? '') }}">
                                            </div>

                                            <div class="w-100">
                                                <label for="to_date" class="form-label">{{ trans('messages.date_to') }} </label>
                                                <input class="form-control datepick" id="to_date" name="to_date" placeholder="{{ trans('messages.to_date') }}"
                                                       value="{{ old('date_to', $edate ?? '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row text-center">
                                        <button type="button" class="col-lg-2 btn btn-danger" onclick="setDates('week')">{{ trans('messages.last_week') }}</button>
                                        <button type="button" class="col-lg-2 btn btn-info" onclick="setDates('month')">{{ trans('messages.last_month') }}</button>
                                        <button type="button" class="col-lg-2 btn btn-warning" onclick="setDates('3months')">{{ trans('messages.last_3_months') }}</button>
                                        <button type="button" class="col-lg-2 btn btn-primary" onclick="setDates('6months')">{{ trans('messages.last_6_months') }}</button>
                                        <button type="button" class="col-lg-2 btn btn-secondary" onclick="setDates('year')">{{ trans('messages.last_year') }}</button>
                                    </div>

                                    <div class="col-sm">
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ trans('messages.submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="example2" class="table align-middle dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th style="width: 120px; text-align:center;">{{ trans('messages.total_students') }}</th>
                                            <th style="width: 120px; text-align:center;">{{ trans('messages.total_income') }}</th>
                                            <th style="width: 120px; text-align:center;">{{ trans('messages.total_expense') }}</th>
                                            <th style="width: 120px; text-align:center;">{{ trans('messages.total_profit') }}</th>
                                        </tr>

                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td style="width: 120px; text-align:center;">{{ trans('messages.total_students') }}: {{ $total_student ?? '' }}</td>
                                            <td style="width: 120px; text-align:center;">{{ trans('messages.total_income') }}: {{ $total_income ?? '' }}</td>
                                            <td style="width: 120px; text-align:center;">{{ trans('messages.total_expense') }}: {{ $total_expense  ?? ''}}</td>
                                            <td style="width: 120px; text-align:center;">{{ trans('messages.total_profit') }}: {{ $profit ?? '' }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>

            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>

@include('layouts.footer')
@endsection
