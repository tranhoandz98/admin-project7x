@extends('layouts.master')
@section('title', 'Thêm mới role')
@section('title-nav', 'Creat Role')
@section('css-custom')
@endsection
@section('main')
    <div id="tableHover" class="col-lg-12 col-12 layout-spacing pt-5">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3">
                        <h4>CREATE ROLE</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="code" class="text-dark">Role code <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="code" id="code" aria-describedby="helpId"
                                    placeholder="">
                                @error('code')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="text-dark">Display name<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                    placeholder="">
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
                                    aria-describedby="helpId" placeholder="">
                                @error('description')
                                <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="code" class="text-dark">Permission</label>
                            <div id="withoutSpacing" class="">
                            </div>
                            <div class="controls mb-2">
                                {{-- <button class="btn btn-primary" type="button">Collepsed</button>
                                <button class="btn btn-warning" type="button">Expanded</button> --}}
                                <button class="btn btn-success" type="button">Checked All</button>
                                <button class="btn btn-danger" type="button">Unchek All</button>
                            </div>
                            <ul class="tree">
                                @foreach ($parents as $parent)
                                    <li class="has collapsed">
                                        <span id="heading{{ $parent->parent }}" data-toggle="collapse"
                                            data-target="#withoutSpacingAccordion{{ $parent->parent }}"
                                            aria-expanded="false"
                                            aria-controls="withoutSpacingAccordion{{ $parent->parent }}">
                                            <span id="parentButtonDown{{ $parent->parent }}"><i
                                                    data-feather="chevron-down"></i>
                                            </span>
                                            <span id="parentButtonUp{{ $parent->parent }}"><i data-feather="chevron-up"></i>
                                            </span>
                                            <script>
                                                $('#parentButtonUp{{ $parent->parent }}').hide();
                                                $('#parentButtonDown{{ $parent->parent }}').click(function(e) {
                                                    $('#parentButtonUp{{ $parent->parent }}').show();
                                                    $('#parentButtonDown{{ $parent->parent }}').hide();
                                                });
                                                $('#parentButtonUp{{ $parent->parent }}').click(function(e) {
                                                    $('#parentButtonUp{{ $parent->parent }}').hide();
                                                    $('#parentButtonDown{{ $parent->parent }}').show();
                                                });

                                            </script>
                                        </span>
                                        <input type="checkbox" name="" value="" id="pa{{ $parent->parent }}" />
                                        <label for="pa{{ $parent->parent }}">
                                            {{ $parent->parent_name }}
                                        </label>
                                        <ul>
                                            @foreach ($permissions as $permission)
                                            <div id="withoutSpacingAccordion{{ $parent->parent }}" class="collapse"
                                                aria-labelledby="heading{{ $parent->parent }}" data-parent="#withoutSpacing"
                                                >
                                                @if ($permission->parent == $parent->parent)
                                                    <li class="">
                                                        <input type="checkbox" id="per{{ $permission->id }}" name="permission[]"
                                                            value="{{ $permission->id }}" />
                                                        <label for="per{{ $permission->id }}">
                                                            {{ $permission->description }}
                                                        </label>
                                                    </li>
                                                @endif
                                            </div>
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

</script>
@endsection
