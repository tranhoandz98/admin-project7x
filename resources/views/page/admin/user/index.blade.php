@extends('layouts.master')
@section('title', 'Quản lý user')
@section('title-nav', 'User')
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
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-3">
                        <h4>USER LIST</h4>
                        {{-- {{ $s_limit }}
                        {{ $s_fullname }} --}}
                        {{ $s_type_user }}
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('user.index') }}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" class="form-control" name="display_name" id="display-name"
                                    aria-describedby="helpId" placeholder="Full name" value=" {{ $s_fullname }}">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for=""></label>
                                <select class="form-control form-control-sm" name="type_user" id="">
                                    <option value="">--Select type user--</option>
                                    <option value="1" {{ $s_type_user == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $s_type_user == 2 ? 'selected' : '' }}>Portal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for=""></label>
                                <select class="form-control form-control-sm" name="role_user" id="">
                                    <option value="">--Role--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $s_role_user == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="date" class="form-control" name="created_at" id="display-name"
                                    aria-describedby="helpId" placeholder="Full name" value=" {{ $s_created_at }}">
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
                        <div class="mt-3 pt-1">
                            <a href="{{ route('user.create') }}" class="btn-rounded btn-lg btn-success btn ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>Add</span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-4">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Display Name</th>
                                    <th>UserName</th>
                                    <th>Role</th>
                                    <th>Type User</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th class="text-center">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $user->display_name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @foreach ($user->roles as $item)
                                                {{ $item->name }}
                                            @endforeach
                                        </td>
                                        <td class="text-center">{!! $user->type_user == 1
                                            ? '<span class="badge outline-badge-success">Admin</span>'
                                            : '<span class="badge outline-badge-danger">Portal</span>' !!}
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td class="text-center">{!! $user->status == 1
                                            ? '<span class="badge outline-badge-success">Active</span>'
                                            : '<span class="badge outline-badge-danger">Block</span>' !!}
                                        </td>
                                        <td class="text-center">
                                            {{-- edit --}}
                                            <a href="{{ route('user.edit', ['user' => $user->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-3 text-primary">
                                                    <path d="M12 20h9"></path>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                            {{-- block or unblock
                                            --}}
                                            @if ($user->status == 1)
                                                <button type="button" class="btn-no-style" data-toggle="modal"
                                                    data-target="#lockModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-lock text-danger hover">
                                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                    </svg>
                                                </button>
                                                <div class="modal fade" id="lockModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="lockModalTitle" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-5">
                                                                <div class="primary mb-4">
                                                                    <p class="cham-than">!</p>
                                                                </div>
                                                                <h4 class="modal-heading mb-3 mt-3">Are you sure</h4>
                                                                <p class="modal-text pt-3"></p>
                                                                <a href="{{ route('user.changeStatus', $user->id) }}"
                                                                    class="btn btn-primary btn-lg">Lock</a>
                                                                <button
                                                                    class="btn btn-lg btn-light-dark text-primary bg-white"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button type="button" class="btn-no-style" data-toggle="modal"
                                                    data-target="#unlockModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-unlock text-danger">
                                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                                    </svg>
                                                </button>
                                                <div class="modal fade" id="unlockModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="lockModalTitle" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-5">
                                                                <div class="primary mb-4">
                                                                    <p class="cham-than">!</p>
                                                                </div>
                                                                <h4 class="modal-heading mb-3 mt-3">Are you sure</h4>
                                                                <p class="modal-text pt-3"></p>
                                                                <a href="{{ route('user.changeStatus', $user->id) }}"
                                                                    class="btn btn-primary btn-lg">Lock</a>
                                                                <button
                                                                    class="btn btn-lg btn-light-dark text-primary bg-white"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
                                    <option value="1" {{ $s_limit == 1 ? 'selected' : '' }}>1</option>
                                    <option value="5" {{ $s_limit == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $s_limit == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ $s_limit == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ $s_limit == 50 ? 'selected' : '' }}>50</option>
                                </select> /Total {{ $users->total() }} record</label>
                        </div>
                        <div class="col-md-6">
                            {{ $users->links('vendor.pagination.custom', ['limit' => $s_limit,'lastpage'=>$users->lastPage()])}}
                        </div>
                    </div>
                    {{-- End pagination --}}
                </form>

            </div>
        </div>
    </div>
@endsection