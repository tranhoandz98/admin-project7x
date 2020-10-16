@extends('layouts.master')
@section('title','Trang chủ')
@section('css-custom')
<link href="{{ url('public') }}/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="{{ url('public') }}/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
@endsection
@section('main')
<div class="row layout-top-spacing">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading">
                <h5 class="">Trang chủ</h5>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js-custom')
<script src="{{ url('public') }}/plugins/apex/apexcharts.min.js"></script>
    <script src="{{ url('public') }}/assets/js/dashboard/dash_2.js"></script>
@stop
