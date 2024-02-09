@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Issuing</li>
            <li class="breadcrumb-item active">Issuing/edit</li>
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
        <div class="container-fluid">
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
            <!-- start page title -->
           
               
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-container">
                                <div class="t-header">purchase Product</div>
                                <div class="table-responsive">
                                    <table id="rowSelection" class="table custom-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Item </th>
                                                <th> Total Quantity</th>
    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 0;
                                        @endphp
    
                                            @foreach ($inventories as $inventory)
                                                @php
                                                    $no = $no + 1;
                                                @endphp
                                               
                                                    <tr>
                                                        <!-- Display details from representative order item -->
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $inventory->item->item_name }}</td>
                                                       
                                                        <td>
                                                            {{ $inventory->purchased_quantity - $inventory->issued_quantity }}
                                                        </td>
                                                    </tr>
                                               
                                            @endforeach
    
    
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <form method="POST" action="{{ route('issuing.update', $issuing->id) }}">
                                @csrf
                                @method('put')
                                <div class="card-header border-bottom bg-transparent">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="header-title mb-0">Edit Issuing Form</h5>
                                        </div>

                                        <div class="col-lg-4">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6">
                                                    <div for="contact_name">Date</label>
                                                        <input type="date" name="issued_date" class="form-control"
                                                            value="{{$issuing->issued_date }}" id="issued_date">
                                                        @error('issued_date')
                                                            <div class="alert alert-danger">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="contact_name">Location</label>
                                                        <select class="form-control selectpicker" id="location_id"
                                                            name="location_id" data-live-search="true">
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}"
                                                                    {{ old('location_id', $issuing->location_id) == $location->id ? 'selected' : '' }}>
                                                                    {{ $location->location_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('location_id')
                                                            <div class="alert alert-danger">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="contact_name">Issued To(opt)</label>
                                                        <input type="text" class="form-control" id="issued_to" value="{{ $issuing->issued_to }}"
                                                            name="issued_to" placeholder="issued_to">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="mt-2">
                                        <div class="row">
                                           
                                            
                                           
                                            <div class="col-lg-8 mb-2">
                                              
                                               @php
                                                   $no=0;
                                               @endphp
                                                <div class="card  mt-2">
                                                    <div class="card-body bg-light " style="border-color:white">
                                                        @foreach ($issuingItems as $issuingItem)
                                                        @if ($issuing->id ==$issuingItem->issuing_id)
                                                        <div class="row mt-2">
                                                           
                                                            <div class="col "> <select class="form-control selectpicker"
                                                                    id="item_id{{ $issuingItem->id }}" name="List[{{ $no }}][item_id]" data-live-search="true">
                                                                  
                                                                    @foreach ($items as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ old('item_id', $issuingItem->item_id) == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->item_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                @error('item_id')
                                                                    <div class="alert alert-danger">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col ">
                                                                <input type="number" id="quantity{{ $issuingItem->id }}" step="any"
                                                                    min="0" name="List[{{ $no }}][quantity]" value="{{ $issuingItem->quantity }}"
                                                                     class="form-control"
                                                                    placeholder="Quantity">
                                                            </div>
                                                            
                                                            <div class="col">
                                                            </div>
                                                        </div>
                                                     @php
                                                         $no=$no+1;
                                                     @endphp
                                                        @endif
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-8 mt-10">
                                        </div>
                                        <div class="col-lg-4 mt-10">

                                            <div>
                                                <div class="table-responsive">
                                                    <table class="table table-centered border mb-0">
                                                        <thead class="bg-light">
                                                            <tr>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row m-5">
                                                        <button style="float: right;" class="btn btn-primary"
                                                            type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
               
                <!-- end card -->

           
        </div>
    </div>




    </div>

    <!-- Add the following script to your HTML file -->
  
@endsection
