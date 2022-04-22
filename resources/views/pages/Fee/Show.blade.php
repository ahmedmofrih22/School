@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.study fees') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.study fees') }}@stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('Students_trans.name') }}</th>
                                                <th>{{ trans('Students_trans.email') }}</th>
                                                <th>{{ trans('Students_trans.gender') }}</th>
                                                <th>{{ trans('Students_trans.Grade') }}</th>
                                                <th>{{ trans('Students_trans.classrooms') }}</th>
                                                <th>{{ trans('Students_trans.section') }}</th>
                                                <th>{{ trans('Students_trans.Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->gender->Name }}</td>
                                                    <td>{{ $student->grade->Name }}</td>
                                                    <td>{{ $student->classroom->Name_Class }}</td>
                                                    <td>{{ $student->section->Name_Section }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-toggle="modal" data-target=""
                                                            title="{{ trans('Grades_trans.Delete') }}">سداد
                                                            الرسوم الدراسيه </button>
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal" data-target=""
                                                            title="{{ trans('Grades_trans.Delete') }}">عرض
                                                            المدفوعات</button>


                                                    </td>
                                                </tr>
                                                {{-- @include('pages.Students.Delete')
                                            @include('pages.Students.add_Graduated') --}}
                                            @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
