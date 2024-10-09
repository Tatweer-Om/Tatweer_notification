@extends('layouts.header')

@section('main')
@push('title')
<title> {{ $teacher->full_name ?? '' }}</title>
@endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $teacher->full_name ?? '' }}  </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">{{ trans('messages.teacher_profile_lang',[],session('locale')) }}  </a></li>
                                    <li class="breadcrumb-item active"><a href="{{ url('teacher') }}">{{ trans('messages.teachers_lang',[],session('locale')) }}</a></li>
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
                                                <span class="logo-txt">{{ $teacher->full_name ?? '' }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="mb-4">
                                                <h4 class="float-end font-size-16">{{ trans('messages.teacher_id_lang', [], session('locale')) }} - 00{{ $teacher->id ?? '' }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="teacher_id" class="teacher_id" value="{{ $teacher->id ?? '' }}" hidden>

                                    <p>
                                        <span>{{ trans('messages.teacher_number_lang', [], session('locale')) }}:</span> {{ $teacher->teacher_number ?? '' }}
                                    </p>
                                    <p>
                                        <span>{{ trans('messages.teacher_email_lang', [], session('locale')) }}:</span> {{ $teacher->teacher_email ?? '' }}
                                    </p>
                                    <p>
                                        <span>{{ trans('messages.civil_number_lang', [], session('locale')) }}:</span> {{ $teacher->civil_number ?? '' }}
                                    </p>
                                </div>

                                <hr class="my-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive mb-4">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap " id="all_course_teacher" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">#</th>
                                                <th style="text-align: center;">{{ trans('messages.course_lang',[],session('locale')) }}</th>
                                                <th style="text-align: center;">{{ trans('messages.detail_lang',[],session('locale')) }}</th>
                                                <th style="text-align: center;">{{ trans('messages.notes_lang',[],session('locale')) }}</th>
                                                <th style="text-align: center;">{{ trans('messages.added_by_lang',[],session('locale')) }}</th>
                                                <th style="text-align: center;">{{ trans('messages.actions_lang',[],session('locale')) }}</th>
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
                                    <h5 class="mb-3">{{ trans('messages.teachers_other_details_lang', [], session('locale')) }}</h5>

                                    <ul class="list-unstyled fw-medium px-2">
                                        <li>
                                            <a href="javascript: void(0);" class="text-body pb-3 d-block border-bottom">
                                                {{ trans('messages.total_courses_lang', [], session('locale')) }}
                                                <span id="total_enrol" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12">{{ $total_courses ?? '' }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                {{ trans('messages.total_students_lang', [], session('locale')) }}
                                                <span id="total_students" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12">{{ $total_students ?? '' }}</span>
                                            </a>
                                        </li>



                                    </ul>
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
