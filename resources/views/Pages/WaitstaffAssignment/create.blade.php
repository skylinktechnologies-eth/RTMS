@extends('Frames.app')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Mantain</li>
        <li class="breadcrumb-item active">Supply Item</li>
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
    <div class="col-10 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">   Assign Waitstaff   </h4>

                <form method="POST" action="{{ route('waitstaffAssignment.store',$waitstaff->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12 col-sm-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm"
                                class="col-sm-1 col-form-label col-form-label-sm">Waitstaff</label>
                            <div class="col-sm-4">
                                <input type="text" name="waitstaff_id" class="form-control"
                                    value="{{ $waitstaff->first_name }} {{ $waitstaff->last_name }}" id="waitstaff_id">
                                @error('waitstaff_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
               
                            
                    </div>
                    <div class="row gutters">
                        <div class="col-sm-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table table-centered border mb-lg-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="width: 35%;">
                                             
                                                    <select id="table_id"  name="table_id" class="form-control selectpicker"  
                                                    data-live-search="true">
                                                        <option value="">Tables</option>
                                                        @foreach ($tables as $table)
                                                            <option value="{{ $table->id }}">{{ $table->table_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('table_id')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </th>
                                                <th style="width: 35%;">
                                             
                                                    <button type="submit" class="btn btn-gradient-primary me-2 " ><i class=" icon-plus"  style="color: green; font-size:20px" ></i></button>
                                                   
                                                </th>
                                            </tr> 
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
