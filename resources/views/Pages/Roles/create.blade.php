@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Management</li>
            <li class="breadcrumb-item active">Roles/create </li>
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
        <div class="card  rounded-3 px-3 ">
            <div class="card-header  bg-primary rounded-3 " style="margin-top: -10px;color:#fff">
                <div style="display: flex; justify-content: space-between;">
                    <strong>Create Role</strong>
                    <a href="{{ route('roles.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)

                    <div class="alert alert-danger">

                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}

                <div class="row">

                    <div class="col-4">

                        <div class="form-group">
                            <label class="form-label" for="name">Name:</label>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            <br />
                        </div>

                    </div>

                    <div class="col-12 mb-1">

                        <div class="form-group">
                            <label class="form-label" for="name"><strong>Permission:</strong></label>
                            <br />
                            <div class="row">
                                {{-- Organize permissions by role names --}}
                                @php
                                    $permissionsByRole = [];
                            
                                    foreach ($permission as $value) {
                                        $roleName = Str::before($value->name, '-');
                                        $permissionName = Str::after($value->name, '-');
                                        $permissionsByRole[$roleName][] = [
                                            'id' => $value->id,
                                            'name' => $permissionName,
                                        ];
                                    }
                                @endphp
                            
                                @foreach ($permissionsByRole as $roleName => $permissions)
                                    <div class="col-md-3">
                                        {{ $roleName }} <br>
                                        <div class="row">
                                            @foreach ($permissions as $permission)
                                                <div class="col-md-12">
                                                    <label>{{ Form::checkbox('permission[]', $permission['id'], false, ['class' => 'name']) }}
                                                        {{ $permission['name'] }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>

                </div>

                {!! Form::close() !!}


            </div>
        </div>
       
    </div>

@endsection
