@extends('layouts.master')
@section('title', 'Quản Lý Province')
@section('title-nav', 'Category')
@section('title-nav-child', 'Province')
@section('main')
    <div id="tableHover" class="col-lg-12 col-12 layout-spacing pt-5">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif
                @if (Session::has('errors'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ Session::get('errors') }}</strong>
                    </div>
                @endif
                <div class="">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3 mt-3">
                        <h4>PROVINCE MANAGER</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('province.index') }}" method="get">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" class="form-control" name="display_name" id="display-name"
                                    aria-describedby="helpId" placeholder="Code or fullname" @if ($s_fullname)
                                value="{{ $s_fullname }}"
                                @endif
                                >
                            </div>
                        </div>
                        <div class="mt-3 pr-3 pt-1">
                            <button type="submit" class="btn btn-primary btn-lg btn-rounded " id="searchSubmit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-search toggle-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                Search</button>
                        </div>
                        @can('create', App\Models\Province::class)
                            <div class="mt-3 pt-1">
                                <a href="{{ route('province.create') }}" class="btn-rounded btn-lg btn-success btn ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    <span>Add</span>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-4">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Province Code</th>
                                    <th>Full Name</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provinces as $province)
                                    <tr id="link{{ $province->id }}">
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $province->code }}</td>
                                        <td>{{ $province->fullname }}</td>
                                        <td class="text-center">{{ $province->created_at }}</td>
                                        <td class="text-center">{!! $province->isvalid == 0
                                            ? '<span class="badge outline-badge-success">Hiệu lực</span>'
                                            : '<span class="badge outline-badge-danger">Hết hiệu lực</span>' !!}
                                        </td>
                                        <td class="text-center">
                                            {{-- edit --}}
                                            @can('update', App\Models\Province::class)
                                                <a href="{{ route('province.edit', $province->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-3 text-primary">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endcan
                                            {{-- delete --}}
                                            @can('delete', App\Models\Province::class)
                                                <a data-id="{{ $province->id }}" class="deleteProvince"
                                                    href="javascript:void(0)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-danger">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- pagination --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-dark"><span>Display</span>
                                <select name="limit" id="limitPage" aria-controls="example"
                                    class="btn bg-light border-dark">
                                    <option value="5" {{ $s_limit == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $s_limit == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ $s_limit == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ $s_limit == 50 ? 'selected' : '' }}>50</option>
                                </select> /Total {{ $provinces->total() }} record</label>
                        </div>
                        <div class="col-md-6">
                            {{ $provinces->links('vendor.pagination.custom', [
                                    'arr' => [
                                        'limit' => $s_limit,
                                        's_fullname' => $s_fullname,
                                    ],
                                    'lastpage' => $provinces->lastPage(),
                                ]) }}
                        </div>
                    </div>
                    {{-- End pagination --}}
                </form>

            </div>
        </div>
    </div>
@endsection
@section('js-custom')
    <script>
        $(document).ready(function() {
            $('.deleteProvince').click(function() {
                let idProvince = $(this).data("id");
                let url = "{{ url('/admin/province/destroyProvince') }}/" + idProvince;
                // console.log(url);
                swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    padding: '2em'
                }).then(function(result) {
                    // console.log(id);
                    console.log(url);
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                console.log('success:', data);
                                if (data.status == 1) {
                                    swal(
                                        'Cancelled!',
                                        data.message,
                                        'error'
                                    )
                                } else {
                                    swal(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    $('body').click(function(e) {
                                        window.location.reload(1);
                                    });
                                }
                            },
                        });
                    }
                })
            });
        });

    </script>
@endsection
