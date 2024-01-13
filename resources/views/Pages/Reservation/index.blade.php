@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Reservation</li>
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
                    <a href="{{ route('reservation.create') }}" type="button" class="btn btn-primary">Add New
                        Reservation</a>
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
                                    <th>Contact Name</th>
                                    <th>Contact Number</th>
                                    <th>Reservation Date</th>
                                    <th>Party Size</th>
                                    <th>Table</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($details as $detail)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $detail->reservation->contact_name }}</td>
                                        <td>{{ $detail->reservation->contact_number }}</td>
                                        <td>{{ $detail->reservation->reservation_date }}</td>
                                        <td>{{ $detail->reservation->party_size }}</td>
                                        
                                       
                                        <td> <button type="button" class="btn" data-toggle="modal" style="background-color: white;color:rgb(3, 89, 180)"
                                                data-target="#viewItem{{ $detail->id }}">view
                                            </button></td>
                                           
                                        <!-- Modal -->
                                        <div class="modal fade" id="viewItem{{ $detail->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="viewItemLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewItemLabel">Items</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('purchase.update') }}">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">Item</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">quantity</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">price</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">total</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @foreach ($orderItems as $orderItem) 
                                                            @if ($orderItem->supply_order_id ==  $detail->id )
                                                                        <div class="row">
                                                                            <div class="col-sm-3 col-3">
                                                                                <div class="form-group">
                                                                                 
                                                                                    <input type="text" class="form-control"
                                                                                        id="category_name" name="item_id" value=" {{ $orderItem->item->item_name }}"
                                                                                        placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 col-3">
                                                                                <div class="form-group">
                                                                                  
                                                                                    <input type="text" class="form-control" 
                                                                                        id="quantity" name="quantity[]" value="  {{ $orderItem->quantity }}" oninput="calculateTotal()"
                                                                                        placeholder="Category Name" style="border-block-color: white;border-color:white">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 col-3">
                                                                                <div class="form-group">
                                                                                   
                                                                                    <input type="text" class="form-control"
                                                                                        id="price" name="price[]" value="   {{ $orderItem->price }}" oninput="calculateTotal()"
                                                                                        placeholder="Category Name" style="border-block-color: white;border-color:white">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 col-3">
                                                                                <div class="form-group">
                                                                             
                                                                                    <input type="text" class="form-control"
                                                                                        id="total" name="total[]" value="  {{ $orderItem->total }}" 
                                                                                        placeholder="total" style="border-block-color: white;border-color:white">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                            @endif
                                                            @endforeach
                                                           
                                                            <div class="modal-footer custom">

                                                                <div class="right-side">
                                                                    <button type="submit"
                                                                        class="btn btn-link success btn-block">Save</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        @if ($reservation->status == 'Pending')
                                            <td style="color: #fed713">{{ $reservation->status }}</td>
                                        @else
                                            <td>{{ $reservation->status }}</td>
                                        @endif


                                        <td>
                                            <div class="d-flex">

                                                <a type="link" href="{{ route('reservation.edit', $reservation->id) }}">
                                                    <i class="icon-edit" style="color: blue"></i>
                                                </a>


                                                <form action="{{ route('reservation.destroy', $reservation->id) }}"
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
