@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- @can('acstaff-create') --}}
        <div style="align:center">
            <a class="btn btn-success" href="{{ route('acstaffs.create') }}">Add New Acadamic Staff Member</a>
        </div>
     {{-- @endcan --}}
     <br>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Acadamic Staff Member Details</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                        <label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label">
                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label>
                    </div>
                </div>
            </div>

            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Rejistation Number</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($user_acstaffs as $acstaff)
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/avatars/avatar1.jpeg">{{$acstaff->name}}</td>
                            <td>{{$acstaff->phone}}</td>
                            <td>{{$acstaff->phone}}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('acstaffs.show',$acstaff->id) }}">
                                    view
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('acstaffs.edit',$acstaff->id) }}">
                                    editt
                                </a>
                                <form action="{{ route('acstaffs.destroy',$acstaff->user_id) }}" method="POST" onsubmit="" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="delete">
                                </form>
                           </td>
                        </tr>
                    @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Rejistation Number</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Phone</strong></td>
                            <td><strong>Email</strong></td>

                            <td><strong>Action</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                </div>
                <div class="col-md-6">
                 {!! $user_acstaffs->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
