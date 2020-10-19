@extends('layouts.master')
@section('title', 'Thêm mới Province')
@section('title-nav', 'Category')
@section('title-nav-child', 'Creat Province')
@section('main')
    <div id="tableHover" class="col-lg-12 col-12 layout-spacing pt-5">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3 mt-3">
                        <h4>CREATE PROVINCE</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('province.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="code" class="text-dark">Code <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="code" id="code" aria-describedby="helpId"
                                    placeholder="">
                                @error('code')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fullname" class="text-dark">Full name<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="fullname" id="fullname"
                                    aria-describedby="helpId" placeholder="">
                                @error('fullname')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="short_name" class="text-dark">Short name</label>
                                <input type="text" class="form-control" name="short_name" id="short_name"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="text-dark">Status</label>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded checkbox-outline-success">
                                      <input type="radio" class="new-control-input" name="status" value="0" checked>
                                      <span class="new-control-indicator"></span>Hiệu lực
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-rounded checkbox-outline-danger">
                                      <input type="radio" class="new-control-input" name="status" value="1">
                                      <span class="new-control-indicator"></span>Hết hiệu lực
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i data-feather="save"></i>
                            Save
                        </button>
                        <a href="{{ route('province.index') }}" class="btn-lg btn-dark btn">
                            <i data-feather="skip-back"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
