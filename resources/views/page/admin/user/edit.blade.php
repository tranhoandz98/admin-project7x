@extends('layouts.master')
@section('title', 'Cập nhật user')
@section('title-nav', 'Update User')
@section('main')
    <div id="tableHover" class="col-lg-12 col-12 layout-spacing pt-5">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3">
                        <h4>UPDATE USER</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('user.update',$user->id) }}" method="POST" id="formPhone">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group form-cus">
                                <label for="name" class="text-dark">Username <span class="text-red">*</span></label>
                                <input type="text" class="form-control bg-gray"  name="name" id="name"
                                    aria-describedby="helpId" placeholder="" value="{{ $user->name }}">
                                    @error('name')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="code" class="text-dark">Acount code<span
                                        class="text-red">*</span></label>
                                <input type="text" class="form-control bg-gray" name="code" id="code"
                                    aria-describedby="helpId" placeholder="" value="{{ $user->code }}">
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
                                    aria-describedby="helpId" placeholder="" value="{{ $user->display_name }}">
                                    @error('display_name')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="department" class="text-dark">Department</label>
                                <input type="text" class="form-control" name="department" id="department"
                                    aria-describedby="helpId" placeholder="" value="{{ $user->department }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone" class="text-dark">Phone </label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    aria-describedby="helpId" placeholder="" value="{{ $user->phone }}">
                                    @error('phone')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email<span class="text-red">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    aria-describedby="helpId" placeholder=" " value="{{ $user->email }}">
                                    @error('email')
                                    <span class="text-red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="type" class="text-dark">Select type user <span
                                        class="text-red">*</span></label>
                                <select class="form-control" name="type" id="type">
                                    <option>--Type--</option>
                                    <option value="1" {{ ($user->type_user)===1?'selected':'' }}>Admin</option>
                                    <option value="2" {{ ($user->type_user)===2?'selected':'' }}>Portal</option>
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
                                    <option>--Client Role--</option>
                                    @foreach ($roles as $item)
                                    <option value="{{ $item->id }}"
                                        @foreach ($user->roles as $itemm)
                                        {{ ($itemm->id)==$item->id?'selected':'' }}
                                        @endforeach
                                        >
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="province_id" class="text-dark">Tỉnh <span class="text-red">*</span></label>
                                <select class="form-control" name="province_id" id="province_id">
                                    <option value="">--Tỉnh--</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->code }}" {{$user->province_id == $item->code ? 'selected' :''}}>{{ $item->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="district_id" class="text-dark">Huyện <span class="text-red">*</span></label>
                                <select class="form-control" name="district_id" id="district_id">
                                    <option value="">--Huyện--</option>
                                    @foreach ($districts as $item)
                                    <option value="{{ $item->code }}" {{$user->district_id == $item->code ? 'selected' :''}}>{{ $item->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg" id="submit" class="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                    Save
                                </button>
                                <a href="{{ route('user.index') }}" class="btn-lg btn-dark btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-skip-back"><polygon points="19 20 9 12 19 4 19 20"></polygon><line x1="5" y1="19" x2="5" y2="5"></line></svg>
                                        Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js-custom')
<script>
     $(document).ready(function() {
            $('#province_id').change(function() {
                var countryID = $(this).val();
                let _url = "{{ url('/admin/user/getDistricts') }}/" + countryID;
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
