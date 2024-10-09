@extends('layouts.header')

@section('main')
@push('title')
<title> {{ $course->course_name ?? '' }}</title>
@endpush

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $course->course_name ?? '' }}  </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">{{ trans('messages.course_profile_lang', [], session('locale')) }}  </a></li>
                                <li class="breadcrumb-item active"><a href="{{ url('course') }}">{{ trans('messages.courses_lang', [], session('locale')) }}</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="mb-4">
                                            <img src="{{ asset('images/logo-sm.svg') }}" alt="" height="24">
                                            <span class="logo-txt">{{ $course->course_name ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="mb-4">
                                            <h4 class="float-end font-size-16">{{ trans('messages.course_id_lang', [], session('locale')) }} 00{{ $course->id ?? '' }} </h4>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="course_id" class="course_id" value="{{ $course->id ?? '' }}" hidden>

                                <p><span>{{ trans('messages.teacher_name_lang', [], session('locale')) }}:</span>{{ $teacher ?? '' }}</p>
                                <p><span>{{ trans('messages.start_date_lang', [], session('locale')) }}:</span> {{ $course->start_date ?? '' }}</p>
                                <p><span>{{ trans('messages.end_date_lang', [], session('locale')) }}:</span> {{ $course->end_date ?? ''}} ({{ $durationMonths ?? '' }}) Months </p>
                                <p><span>{{ trans('messages.start_time_lang', [], session('locale')) }}:</span> {{ $start_time ?? '' }}</p>
                                <p><span>{{ trans('messages.end_time_lang', [], session('locale')) }}:</span> {{ $end_time ?? ''}} ({{ $durationHours ?? ''}}) hours </p>

                            </div>
                            <hr class="my-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap " id="all_enroll_student" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" scope="col">Sr#</th>
                                            <th style="text-align: center;" scope="col">{{ trans('messages.student_detail_lang', [], session('locale')) }}</th>
                                            <th style="text-align: center;" scope="col">{{ trans('messages.course_detail_lang', [], session('locale')) }}</th>
                                            <th style="text-align: center;" scope="col">{{ trans('messages.price_detail_lang', [], session('locale')) }}</th>
                                            <th style="text-align: center;" scope="col">{{ trans('messages.added_by_lang', [], session('locale')) }}</th>
                                            <th style="width: 80px; min-width: 80px; text-align: center;">{{ trans('messages.action_lang', [], session('locale')) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="mt-5">
                                <h5 class="mb-3">{{ trans('messages.course_other_details_lang', [], session('locale')) }}</h5>
                                <ul class="list-unstyled fw-medium px-2">
                                    <li>
                                        <a href="javascript: void(0);" class="text-body pb-3 d-block border-bottom">
                                            {{ trans('messages.total_enrollments_lang', [], session('locale')) }}
                                            <span id="total_enrol" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                            {{ trans('messages.total_income_lang', [], session('locale')) }}
                                            <span id="total_income" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-5">
                                <h5 class="mb-3">{{ trans('messages.offers_lang', [], session('locale')) }}</h5>
                                <div id="offers" class="list-group list-group-flush">
                                    <!-- Bookings will be appended here via JavaScript -->
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card -->
                </div>

            </div>

        </div>
        <!-- end row -->
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>

@include('layouts.footer')
@endsection
