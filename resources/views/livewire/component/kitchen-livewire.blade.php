<div>
    <div class=" card">
        <div class="card-body"></div>
    </div>
    <div class="container ">
        <div class=" container">
            <div class="card-body"></div>
        </div>
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
                        <select id="item_status" wire:model="selectedItemStatus" class="form-control">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Preparing">Preparing</option>
                            <option value="Ready">Ready</option>
                        </select>
                    </div>
                    <div class="form-group mb-0 mr-2">
                        <input type="date" id="order_date" wire:model="selectedDate" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-info">Filter</button>
                </form>
            </div>
        </div>

    </div>
    <div class="row pt-4" style="margin-left: 20px; margin-right: 10px">
        @foreach ($orderItems->unique('order_id') as $uniqueOrderItem)
            @if (
                $uniqueOrderItem->status == 'Pending' ||
                    $uniqueOrderItem->status == 'Preparing' ||
                    ($uniqueOrderItem->status == 'Ready' && $uniqueOrderItem->order->status != 'Close'))
                <div class="col-md-6 col-sm-12" style="margin-bottom: 30px;">
                    <div class="card    ">
                        <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                            <div style="display: flex; justify-content: space-between;">
                                <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ">
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
                                <div class="col-sm-2 col-2">
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
                                        <div class="col-sm-3 col-3 pt-2">
                                            <h6> {{ $orderItem->quantity }}-{{ $orderItem->menuItem->item_name }}
                                            </h6>
                                        </div>

                                        <div class="col-sm-3 col-3  pt-2 ">
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
                                        
                                        <div class="col-sm-2 col-2  pt-2 ">
                                            @if ($orderItem->status == 'Pending')
                                                <a href=" changeStatusToPreparing-{{ $orderItem->id }}" type="button"
                                                    class="btn btn-primary">
                                                    Start </a>
                                            @elseif ($orderItem->status == 'Preparing')
                                                <a href=" changeStatusToReady-{{ $orderItem->id }}" type="button"
                                                    class="btn btn-secondary">
                                                    Finish </a>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>
