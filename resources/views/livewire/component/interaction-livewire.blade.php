<div>

    <div class=" card">
        <div class="card-body"></div>
    </div>

    <div class=" container">
        <div class="card-body"></div>
    </div>
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="text-right mb-3">
                <!-- Button trigger modal -->
                <a href="{{ route('order.create') }}" type="button" class="btn btn-primary">Add New
                    Order </a>
            </div>
        </div>
    </div>
    @if (session('warning'))
        <div class="row">

            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="alert alert-warning px-3" id="warning-alert">

                    {{ session('warning') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row gutters">
        <div class="col-sm-3">

        </div>

        <div class="col-sm-6" style="display: flex; justify-content: space-between; align-items: center;">
            <form class="d-flex align-items-center" wire:submit.prevent="loadOrderItems">
                @csrf
                <div class="form-group mb-0 mr-2">
                    <select id="category_id" wire:model="selectedCategoryId" class="form-control">
                        <option value="">All Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-0 mr-2">
                    <select id="table_id" wire:model="selectedTableId" class="form-control">
                        <option value="">All Table</option>
                        @foreach ($tables as $table)
                            <option value="{{ $table->id }}">
                                {{ $table->table_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-0 mr-2">
                    <input type="date" id="order_date" wire:model="selectedDate" class="form-control">
                </div>

                <button type="submit" class="btn btn-info">Filter</button>
            </form>
        </div>
    </div>

    <div class="row pt-4" style="margin-left: 20px; margin-right: 10px;">
        @foreach ($orderItems->unique('order_id') as $uniqueOrderItem)
            @if (
                $uniqueOrderItem->status == 'Pending' ||
                    $uniqueOrderItem->status == 'Preparing' ||
                    ($uniqueOrderItem->status == 'Ready' && $uniqueOrderItem->order->status != 'Close'))
              
                <div class="col-lg-2 col-sm-4">
                    <div class="card" >
                        <div class="card-header bg-primary" style="color:white">
                            <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>
                        </div>
                        <div class="card-body text-center">
                            <div>
                                @if ($uniqueOrderItem->status == 'Pending')
                                <p class="bg-warning text-white rounded" style="font-size:16px;padding:3px">
                                    <strong>{{ $uniqueOrderItem->status }}</strong>
                                </p>
                            @elseif ($uniqueOrderItem->status == 'Preparing')
                                <p class="bg-danger text-white rounded" style="font-size:16px;padding:3px">
                                    <strong>{{ $uniqueOrderItem->status }}</strong>
                                </p>
                            @elseif ($uniqueOrderItem->status == 'Ready')
                                <p class="bg-success text-white rounded" style="font-size:16px;padding:3px">
                                    <strong>{{ $uniqueOrderItem->status }}</strong>
                                </p>
                            @endif
                            </div>
                            <div class=" ">

                                <button type="button" class="btn" data-toggle="modal"
                                    style="background-color: white;color:rgb(3, 89, 180)"
                                    data-target="#viewItem{{ $uniqueOrderItem->id }}">view
                                </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="viewItem{{ $uniqueOrderItem->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="viewItemLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewItemLabel">{{ $uniqueOrderItem->order->table->table_name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mt-2">
                                                    <div class="col-sm-3 col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputCity1">
                                                                Item</label>
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-sm-3 col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputCity1">remark</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputCity1">
                                                                Status</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputCity1">
                                                                Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @php
                                                    $total = 0;
                                                @endphp
                                                <div class="row mt-2 ">
                                                    @foreach ($orderItems as $orderItem)
                                                        @if ($orderItem->order_id == $uniqueOrderItem->order_id)
                                                            <div class="col-sm-3 col-3 ">
                                                                <h6>{{ $orderItem->quantity }}-{{ $orderItem->menuItem->item_name }}</h6>
                                                            </div>
                    
                                                            <div class="col-sm-3 col-3 ">
                                                                <h6> {{ $orderItem->remark }}</h6>
                                                            </div>
                                                            <div class="col-sm-3 col-3 text-center pt-2">
                                                                @if ($orderItem->status == 'Pending')
                                                                    <p class="bg-warning text-white rounded" style="font-size:16px;padding:3px">
                                                                        <strong>{{ $orderItem->status }}</strong>
                                                                    </p>
                                                                @elseif ($orderItem->status == 'Preparing')
                                                                    <p class="bg-info text-white rounded" style="font-size:16px;padding:3px">
                                                                        <strong>{{ $orderItem->status }}</strong>
                                                                    </p>
                                                                @elseif ($orderItem->status == 'Ready')
                                                                    <p class="bg-success text-white rounded" style="font-size:16px;padding:3px">
                                                                        <strong>{{ $orderItem->status }}</strong>
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-3 col-3 pt-2">
                                                                @php
                                                                    $interaction = \App\Models\KitchenInteraction::where('order_item_id', $orderItem->id)
                                                                        ->where('interaction_type', 'Serve')
                                                                        ->get();
                                                                @endphp
                    
                                                                @if ($interaction->isEmpty())
                                                                    <a href=" changeStatusToServe-{{ $orderItem->id }}" type="button"
                                                                        class="btn btn-info">
                                                                        Deliver
                                                                    </a>
                                                                @else
                                                                    <p class="" style="color: rgb(4, 95, 252)">
                                                                        <strong> Delivered </strong>
                                                                    </p>
                                                                @endif
                                                            </div>
                    
                                                            @php
                                                                $total += $orderItem->sub_total;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <p>Total:{{ $total }}</p>
                                                </div>
                                                <div class="text-center">
                                                    <a href=" changeStatusClose-{{ $uniqueOrderItem->order->id }}" type="button"
                                                        class="btn btn-primary" >
                                                        Paid
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
                   
             
                {{-- @if ($uniqueOrderItem->status == 'Preparing')
                    <div class=" text-center"
                        style="height: 120px; width:185px;background-color:rgb(6, 62, 185); color:white; margin-right: 10px; margin-bottom: 20px;">
                        <div class="pt-4">
                            <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>

                        </div>
                        <button type="button" class="btn" data-toggle="modal"
                            style="background-color: white;color:rgb(3, 89, 180)"
                            data-target="#viewItem{{ $uniqueOrderItem->id }}">View Detail
                        </button>
                    </div>
                @endif
                @if ($uniqueOrderItem->status == 'Ready')
                    <div class=" text-center"
                        style="height: 120px; width:185px;background-color:rgb(14, 139, 2); color:white; margin-right: 10px; margin-bottom: 20px;">
                        <div class="pt-4">
                            <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>
                        </div>
                        <button type="button" class="btn pt-3" data-toggle="modal"
                            style="background-color: rgb(183, 43, 5);color:rgb(255, 255, 255)"
                            data-target="#viewItem{{ $uniqueOrderItem->id }}">View Detail
                        </button>
                    </div>
                @endif --}}

                {{-- <div class=" col-lg-6 col-sm-12" style="margin-bottom: 30px;">
                    <div class="card  ">
                        <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                            <div style="display: flex; justify-content: space-between;">
                                <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="exampleInputCity1">
                                            Item</label>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="exampleInputCity1">remark</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="exampleInputCity1">
                                            Status</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="exampleInputCity1">
                                            Action</label>
                                    </div>
                                </div>
                            </div>
                            @php
                                $total = 0;
                            @endphp
                            <div class="row mt-2 ">
                                @foreach ($orderItems as $orderItem)
                                    @if ($orderItem->order_id == $uniqueOrderItem->order_id)
                                        <div class="col-sm-3 col-3 ">
                                            <h6>{{ $orderItem->quantity }}-{{ $orderItem->menuItem->item_name }}</h6>
                                        </div>

                                        <div class="col-sm-3 col-3 ">
                                            <h6> {{ $orderItem->remark }}</h6>
                                        </div>
                                        <div class="col-sm-3 col-3 text-center pt-2">
                                            @if ($uniqueOrderItem->status == 'Pending')
                                                <p class="bg-warning text-white rounded" style="font-size:16px;padding:3px">
                                                    <strong>{{ $orderItem->status }}</strong>
                                                </p>
                                            @elseif ($uniqueOrderItem->status == 'Preparing')
                                                <p class="bg-danger text-white rounded" style="font-size:16px;padding:3px">
                                                    <strong>{{ $orderItem->status }}</strong>
                                                </p>
                                            @elseif ($uniqueOrderItem->status == 'Ready')
                                                <p class="bg-success text-white rounded" style="font-size:16px;padding:3px">
                                                    <strong>{{ $orderItem->status }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-sm-3 col-3 pt-2">
                                            @php
                                                $interaction = \App\Models\KitchenInteraction::where('order_item_id', $orderItem->id)
                                                    ->where('interaction_type', 'Serve')
                                                    ->get();
                                            @endphp

                                            @if ($interaction->isEmpty())
                                                <a href=" changeStatusToServe-{{ $orderItem->id }}" type="button"
                                                    class="btn btn-info">
                                                    Deliver
                                                </a>
                                            @else
                                                <p class="" style="color: rgb(4, 95, 252)">
                                                    <strong> Delivered </strong>
                                                </p>
                                            @endif
                                        </div>

                                        @php
                                            $total += $orderItem->sub_total;
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Total:{{ $total }}</p>
                            </div>
                            <div class="text-center">
                                <a href=" changeStatusClose-{{ $uniqueOrderItem->order->id }}" type="button"
                                    class="btn btn-primary" >
                                    Paid
                                </a>
                            </div>
                        </div>


                    </div>
                </div> --}}
            @endif
        @endforeach
    </div>
    <div class="row" style="margin-left: 15px; margin-right: 7px">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-container">
                    <div class="t-header">Paid Orders</div>
                    <div class="table-responsive">
                        <table id="rowSelection" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Table</th>
                                    <th>Order Date</th>
                                    <th>Item </th>
                                    <th> Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($orders as $order)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    @if ($order->status == 'Close')
                                        <tr>
                                            <!-- Display details from representative order item -->
                                            <td>{{ $no }}</td>
                                            <td>{{ $order->table->table_name }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>
                                                @foreach ($orderItems as $orderItem)
                                                    @if ($orderItem->order_id == $order->id)
                                                        {{ $orderItem->menuItem->item_name }},
                                                    @endif
                                                @endforeach
                                            </td>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($orderItems as $orderItem)
                                                @if ($orderItem->order_id == $order->id)
                                                    @php
                                                        $total = $total + $orderItem->sub_total;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <td>
                                                {{ $total }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
