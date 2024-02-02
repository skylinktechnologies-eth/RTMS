@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Management</li>
            <li class="breadcrumb-item active">Roles </li>
        </ol>

        <ul class="app-actions">
            <li>
                <a href="#" id="reportrange">
                    <span class="range-text"></span>
                    <i class="icon-chevron-down"></i>
                </a>
            </li>
           
        </ul>
    </div>

    <div class="main-container">

        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success px-3" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header bg-white align-items-center">
                            <div class="row">
                                <div class="col col-md-9 justify-content-start">
                                    <h4 class="card-title ">Roles</h4>
                                </div>
                                <div class="col col-md-3 " style="text-align:right">

                                    @can('role-create')
                                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <div class="table-responsive">
                                    <table id="basicExample" class="table custom-table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                Number
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ $i++ }}</td>

                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @can('role-edit')
                                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                                    @endcan
                                                    @can('role-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
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
            </div>
        </div>
    </div>

@endsection
