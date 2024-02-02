@extends('Frames.app')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active">Users </li>
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
                            <h4 class="card-title ">Users</h4>
                        </div>
                        <div class="col col-md-3 " style="text-align:right">
                            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
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
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Roles
                                    </th>
                                    <th class="text-right" width="25%">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>

                                        <td>{{ $user->name }}</td>

                                        <td>{{ $user->email }}</td>
                                        <td>

                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <label >{{ $v }}</label>
                                                @endforeach
                                            @endif

                                        </td>
                                        <td>
                                            @can('user-edit')
                                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                            @endcan
                                            @can('user-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- {!! $data->render() !!} --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection