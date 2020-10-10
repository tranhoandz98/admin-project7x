@extends('layouts.master')
@section('title', 'Thêm mới user')
@section('title-nav', 'Creat User')
@section('main')
    <div id="tableHover" class="col-lg-12 col-12 layout-spacing pt-5">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3">
                        <h4>CREATE USER</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="text-dark">Username <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                    placeholder="Nhập tên">
                                @error('name')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="code" class="text-dark">Acount code<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="code" id="code" aria-describedby="helpId"
                                    placeholder="Nhập code">
                                @error('code')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="display_name" class="text-dark">Display name <span
                                        class="text-red">*</span></label>
                                <input type="text" class="form-control" name="display_name" id="display_name"
                                    aria-describedby="helpId" placeholder="Nhập họ tên">
                                    @error('display_name')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="department" class="text-dark">Department</label>
                                <input type="text" class="form-control" name="department" id="department"
                                    aria-describedby="helpId" placeholder="Nhập phòng">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone" class="text-dark">Phone </label>
                                <input type="number" class="form-control" name="phone" id="phone" aria-describedby="helpId"
                                    placeholder="Nhập số điện thoại" >
                                    @error('phone')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email<span class="text-red">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                                    placeholder="Nhập email">
                                    @error('email')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col" id="password-field">
                            <div class="form-group" >
                                <label for="password" class="text-dark">Password<span class="text-red">*</span></label>
                                <input type="password" class="form-control" name="password" id="password"
                                    aria-describedby="helpId" placeholder="Nhập mật khẩu">

                                    @error('password')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="re_password" class="text-dark">Password Confirm <span
                                        class="text-red">*</span></label>
                                <input type="password" class="form-control" name="re_password" id="re_password"
                                    aria-describedby="helpId" placeholder="Nhập lại mật khẩu">
                                    @error('re_password')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="type" class="text-dark">Select type user <span class="text-red">*</span></label>
                                <select class="form-control" name="type" id="type" >
                                    <option value="">--Type--</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Portal</option>
                                </select>
                                @error('type')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="role_id" class="text-dark">Role <span class="text-red">*</span></label>
                                <select class="form-control" name="role_id" id="role_id">
                                    <option value="">--Role user--</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="province_id" class="text-dark">Tỉnh</label>
                                <select class="form-control" name="province_id" id="province_id">
                                    <option value="">--Tỉnh--</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->code }}">{{ $item->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="district_id" class="text-dark">Huyện</label>
                                <select class="form-control" name="district_id" id="district_id">
                                    <option value="">--Huyện--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-save">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Save
                        </button>
                        <a href="{{ url()->previous() }}" class="btn-lg btn-dark btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-skip-back">
                                <polygon points="19 20 9 12 19 4 19 20"></polygon>
                                <line x1="5" y1="19" x2="5" y2="5"></line>
                            </svg>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('#province_id').change(function() {
        var countryID = $(this).val();
        let _url = "{{ url('/admin/getDistricts') }}/" + countryID;
        // let _url = "../getDistricts/" + countryID;
        console.log(_url);
        // "admin/getDistricts/" + countryID
        if (countryID) {
            $.ajax({
                type: "GET",
                url: _url,
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $("#district_id").empty();
                        $("#district_id").append('<option>Select</option>');
                        $.each(response, function(key, value) {
                            $("#district_id").append('<option value="' +
                                value['code'] + '">' + value[
                                'fullname'] + '</option>');
                        });

                    } else {
                        $("#district_id").empty();
                    }
                }
            });
        } else {
            $("#district_id").empty();
        }
    });
});
</script>
@endsection

