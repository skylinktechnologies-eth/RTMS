@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Management</li>
            <li class="breadcrumb-item active">Users/edit </li>
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
                    <strong>Edit users</strong>
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
                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}

                @csrf
                <div class="row   mt-3">
                    <div class="col-6">
                        <div class="form-group">

                            <strong>Name:</strong>

                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <strong>Email:</strong>

                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}

                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-6">
                        <div class="form-group">

                            <strong>Password:</strong>

                            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <strong>Confirm Password:</strong>

                            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group">

                            <strong>Role:</strong>

                            {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control']) !!}

                        </div>
                    </div>

                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

           
            {!! Form::close() !!}
        </div>
        </div>
       
    </div>

@endsection
