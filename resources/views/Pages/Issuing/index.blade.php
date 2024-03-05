@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Issuing</li>
            <li class="breadcrumb-item active">Issuing </li>
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
                    @can('issuing-create')
                        <a href="{{ route('issuing.create') }}" type="button" class="btn btn-primary">Add New
                            Issuing </a>
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
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Item</th>
                                    <th> Total Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @php
                                    $groupedIssuedItems = [];
                                    foreach ($issuingItems as $issuingItem) {
                                        $issuingId = $issuingItem->issuing->id;

                                        if (!isset($groupedIssuedItems[$issuingId])) {
                                            $groupedIssuedItems[$issuingId] = [
                                                'total' => 0,
                                                'issuingItem' => $issuingItem, // Store one representative order item for details
                                            ];
                                        }

                                        $groupedIssuedItems[$issuingId]['total'] += $issuingItem->total;
                                    }
                                @endphp

                                @foreach ($groupedIssuedItems as $issuingId => $groupedIssuedItem)
                                    @php
                                        $total = $groupedIssuedItem['total'];
                                        $issuingItem = $groupedIssuedItem['issuingItem'];
                                    @endphp
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <!-- Display details from representative order item -->
                                        <td>{{ $no }}</td>
                                        <td>{{ $issuingItem->issuing->issued_date }}</td>
                                        <td>{{ $issuingItem->issuing->location->location_name }}</td>
                                        @php
                                            $issuingId = $issuingItem->issuing->id;
                                        @endphp
                                        <td> <button type="button" class="btn" data-toggle="modal"
                                                style="background-color: white;color:rgb(3, 89, 180)"
                                                data-target="#viewItem{{ $issuingId }}">view
                                            </button></td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="viewItem{{ $issuingId }}" tabindex="-1"
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
                                                        <form method="POST"
                                                            action="{{ route('issuing.update', $issuingId) }}">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-sm-3 col-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">Item</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">quantity</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            @foreach ($issuingItems as $issuingItem)
                                                                @if ($issuingItem->issuing_id == $issuingId)
                                                                    <div class="row">
                                                                        <div class="col-sm-4 col-4">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="category_name" name="item_id"
                                                                                    value=" {{ $issuingItem->item->item_name }}"
                                                                                    placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-4">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="quantity" name="quantity[]"
                                                                                    value="  {{ $issuingItem->quantity }}"
                                                                                    oninput="calculateTotal()"
                                                                                    placeholder="Category Name"
                                                                                    style="border-block-color: white;border-color:white">
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
                                        <td>{{ $total }}</td>
                                        <!-- Display action buttons -->
                                        <td>
                                            <div class="d-flex">
                                                @can('issuing-edit')
                                                    <a type="link" href="{{ route('issuing.edit', $issuingId) }}">
                                                        <i class="icon-edit" style="color: blue"></i>
                                                    </a>
                                                @endcan
                                                @can('issuing-delete')
                                                <form action="{{ route('issuing.destroy', $issuingId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link p-0">
                                                        <i class="icon-trash-2" style="color:red"></i>
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
