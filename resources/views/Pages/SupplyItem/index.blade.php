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
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-right mb-3">
                    <!-- Button trigger modal -->
                    @can('supplyItem-create')
                    <a href="{{ route('supplyItem.create') }}" type="button" class="btn btn-primary">Add New
                        Supply Item</a>
                    @endcan
                   
                </div>
            </div>
        </div>
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-sm-12">

                <div class="table-container">

                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Item Name</th>
                                    <th>Unit of Measure</th>
                                    <th>Price</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($supplyItems as $supplyItem)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $supplyItem->itemCategory->item_category_name }}</td>
                                        <td>{{ $supplyItem->item_name }}</td>
                                        <td>{{ $supplyItem->unit_of_measure }}</td>
                                        <td>{{ $supplyItem->price }}</td>
                                        
                                        <td>
                                            <div class="d-flex">
                                          @can('supplyItem-edit')
                                          <a type="link" href="{{ route('supplyItem.edit', $supplyItem->id) }}">
                                            <i class="icon-edit" style="color: blue"></i>
                                        </a> 
                                          @endcan
                                              
                                                @can('supplyItem-edit')
                                                <form action="{{ route('supplyItem.destroy', $supplyItem->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link p-0">
                                                        <i class=" icon-trash-2" style="color:red"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                               
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
