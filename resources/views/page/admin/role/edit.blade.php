@extends('layouts.master')
@section('title', 'Cập nhật role')
@section('title-nav', 'Update Role')
@section('css-custom')
<link rel="stylesheet" type="text/css" href="{{ url('public') }}/plugins/tree-select/style.css">
@endsection
@section('main')
    <div id="tableHover" class="col-lg-12 col-12 layout-spacing pt-5">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3 mt-3">
                        <h4>UPDATE ROLE</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="code" class="text-dark">Role code <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="code" id="code" aria-describedby="helpId"
                                    placeholder="" value="{{ $role->code }}">
                                @error('code')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="text-dark">Display name<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                    placeholder="" value="{{ $role->name }}">
                                @error('name')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="description" class="text-dark">Description<span
                                        class="text-red">*</span></label>
                                <input type="text" class="form-control" name="description" id="description"
                                    aria-describedby="helpId" placeholder="" value="{{ $role->description }}">
                                @error('description')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="code" class="text-dark">Permission</label>
                            <div class="controls mb-2">
                                <button class="btn btn-success" type="button">Checked All</button>
                                <button class="btn btn-danger" type="button">Unchek All</button>
                            </div>
                            <ul data-role="treeview">
                                @foreach ($parents as $parent)
                                    <li>
                                        <span class="caret"></span>
                                    <input type="checkbox" data-role="checkbox" data-caption="{{$parent->parent_name}}" title="">
                                        <ul class="nested ">
                                            @foreach ($permissions as $permission)
                                                @if ($permission->parent == $parent->parent)
                                                    <li>
                                                        <input
                                                            {{ $permission_active->contains($permission->id) ? 'checked' : '' }}
                                                            type="checkbox" data-role="checkbox"
                                                            data-caption="{{ $permission->description }}" title=""
                                                            name="permission[]" value="{{$permission->id}}">
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i data-feather="save"></i>
                            Save
                        </button>
                        <a href="{{ route('role.index') }}" class="btn-lg btn-dark btn">
                            <i data-feather="skip-back"></i>
                            Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js-custom')
    <script src="{{ url('public') }}/plugins/tree-select/tree.js"></script>
    <script src="{{ url('public') }}/plugins/treeview/custom-jstree.js"></script>
    <script src="{{ url('public') }}/plugins/tree-select/metro.min.js"></script>
@endsection
