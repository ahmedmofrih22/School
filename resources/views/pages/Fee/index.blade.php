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
    {{ trans('main_trans.study fees') }}
@stop
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
                            <a href="{{ route('Fee.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('main_trans.add_study_fees') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Students_trans.title') }}</th>
                                            <th>{{ trans('Students_trans.amount') }}</th>
                                            <th>{{ trans('Students_trans.Grade_Name') }}</th>
                                            <th>{{ trans('Students_trans.Classroom_Name') }}</th>
                                            <th>{{ trans('Students_trans.Fee_Type') }}</th>

                                            <th>{{ trans('Students_trans.year') }}</th>
                                            <th>{{ trans('Students_trans.description') }}</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($Fee as $Fees)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $Fees->title }}</td>
                                                <td>{{ $Fees->amount }}</td>

                                                <td>{{ $Fees->grade->Name }}</td>
                                                <td>{{ $Fees->classroom->Name_Class }}</td>
                                                <td>
                                                    @if ($Fees->Fee_type === 1)
                                                        <span class="label text-success d-flex"
                                                            style="font-size: 20px;">
                                                            الرسوم الدراسيه
                                                        </span>
                                                    @else
                                                        <span class="label text-warning d-flex"
                                                            style="font-size: 20px;">
                                                            رسوم الباص
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $Fees->year }}</td>
                                                <td>{{ $Fees->description }}</td>
                                                <td>
                                                    <a href="{{ route('Fee.edit', $Fees->id) }}"
                                                        class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_Fee{{ $Fees->id }}"
                                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                    <a href="{{ route('Fee.show', $Fees->id) }}"
                                                        class="btn btn-warning btn-sm" role="button"
                                                        aria-pressed="true"><i class="far fa-eye"></i></a>



                                                </td>
                                            </tr>
                                            @include('pages.Fee.Delete')
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
