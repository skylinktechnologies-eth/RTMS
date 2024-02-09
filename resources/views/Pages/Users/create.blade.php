@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Management</li>
            <li class="breadcrumb-item active">Users/create </li>
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
                    <strong>Create new users</strong>
                    <a href="{{ route('users.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
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
               
                {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}

                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label class="mb-1">
                                <strong>Name:</strong>
                            </label>

                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="form-group ">
                            <label class="mb-1">
                                <strong>Email:</strong>
                            </label>

                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}


                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label class="mb-1">
                                <strong>Password:</strong>
                            </label>

                            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}


                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label class="mb-1">
                                <strong>Confirm Password:</strong>
                            </label>

                            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}


                        </div>
                    </div>

                   
                    <div class="col-lg-12 col-12 mb-2">
                        <div class="form-group">
                            <label class="mb-1">
                                <strong>Role:</strong>
                            </label>
                            {!! Form::select('roles[]', $roles, [], ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    
                    <div class="col-12 text-center mb-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>

                {!! Form::close() !!}
            </div>
        </div>
       
    </div>

@endsection
