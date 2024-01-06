

@extends('Frames.app')
@section('content')
<style>
     .table td img {
            width: 70px;
            height: 50px;
            border-radius: 0%;
        }
</style>
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Waitstaff</li>
            <li class="breadcrumb-item active">Staff</li>
        </ol>

        <ul class="app-actions">
            <li>
                <a href="#" id="reportrange">
                    <span class="range-text"></span>
                    <i class="icon-chevron-down"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">
                    <i class="icon-print"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="Download CSV">
                    <i class="icon-cloud_download"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-container">

        @if (session('success'))
            <div class="row">

                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="alert alert-success px-3" id="success-alert">

                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-right mb-3">
                    <!-- Button trigger modal -->
                    <a href="{{ route('waitstaff.create') }}" type="button" class="btn btn-primary">Add New
                        Staff</a>
                </div>
            </div>
        </div>
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead style="">
                                <tr>
                                    <th>No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact Number</th>
                                    <th>Hire Date</th>
                                    <th>Status</th>
                                    <th>Assigned Table</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($waitstaffs as $waitstaff)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $waitstaff->first_name }}</td>
                                        <td>{{ $waitstaff->last_name }}</td>
                                        <td>{{ $waitstaff->contact_number }}</td>
                                        <td>{{ $waitstaff->hire_date }}</td>
                                        <td>{{ $waitstaff->status }}</td>
                                        <td> <a href="{{ route('waitstaff.view', $waitstaff->id) }}" type="button" class="btn btn-info">View
                                            </a></td>
                                        <td>
                                            <div class="d-flex">

                                                <a type="link" href="{{ route('waitstaff.edit', $waitstaff->id) }}">
                                                    <i class="icon-edit" style="color: blue"></i>
                                                </a>

                                                <form action="{{ route('waitstaff.destroy', $waitstaff->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link p-0">
                                                        <i class=" icon-trash-2" style="color:red"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection





