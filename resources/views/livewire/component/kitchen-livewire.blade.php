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
            <div class="col-sm-3">
                <div class="form-group">
                  
                    <select class="form-control" id="categoryFilter">
                        <option value="">All Categories</option>
                        <!-- Add options dynamically based on your category data -->
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
               
            </div>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-md-12">
            <div class="d-flex align-items-center mb-3">
                <i style="font-size: 2rem" class="fas fa-file-alt text-primary"></i>
                <div style="margin-left: 20px">
                  
                    <div class="row gutters   ">
                        @foreach ($orderItems->unique('order_id') as $uniqueOrderItem)
                            @if (
                                $uniqueOrderItem->status == 'Pending' ||
                                    $uniqueOrderItem->status == 'Preparing' ||
                                    ($uniqueOrderItem->status == 'Ready' && $uniqueOrderItem->order->status != 'Close'))
                                <div class="col-6 " style="margin-bottom: 30px;">
                                    <div class="card rounded-3 px-3   ">
                                        <div class="card-header bg-primary rounded-3"
                                            style="margin-top: -10px;color:#fff">
                                            <div style="display: flex; justify-content: space-between;">
                                                <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>
                                                <a href="" class="text-white"><i class="fas fa-arrow-left"></i>
                                                    {{ $uniqueOrderItem->order->order_date }}</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-2">
                                                <div class="col-sm-2 col-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputCity1">
                                                            Item</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputCity1">quantity</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-2">
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
                                                        <div class="col-sm-3 col-3 ">
                                                            <h6>{{ $orderItem->menuItem->item_name }}</h6>
                                                        </div>
                                                        <div class="col-sm-1 col-1 ">
                                                            <h6> {{ $orderItem->quantity }}</h6>
                                                        </div>
                                                        <div class="col-sm-2 col-2 ">
                                                            <h6> {{ $orderItem->remark }}</h6>
                                                        </div>
                                                        <div class="col-sm-3 col-3 ">
                                                            @if ($uniqueOrderItem->status == 'Pending')
                                                                <h6 class="bg-warning" style="color: white"> {{ $orderItem->status }}</h6>
                                                                @elseif  ($uniqueOrderItem->status == 'Preparing')
                                                                <h6 class="bg-info" style="color: white"> {{ $orderItem->status }}</h6>
                                                                @elseif ($uniqueOrderItem->status == 'Ready')
                                                                <p class="bg-danger"style="color: white" >
                                                                    <strong> {{ $orderItem->status }} </strong>
                                                                </p>
                                                                @endif
                                                        </div>
                                                        <div class="col-sm-2 col-2 ">
                                                            @if ($orderItem->status == 'Pending')
                                                                 
                                                                        <a href=" changeStatusToPreparing-{{ $orderItem->id }}"
                                                                            type="button" class="btn btn-primary">
                                                                            Start </a>
                                                                    @elseif ($orderItem->status == 'Preparing')
                                                                  
                                                                        <a href=" changeStatusToReady-{{ $orderItem->id }}"
                                                                            type="button" class="btn btn-secondary">
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
            </div>
        </div>
    </div>

    {{-- <div class="row pt-4">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-3">
                <i style="font-size: 2rem" class="fas fa-file-alt text-primary"></i>
                <div style="margin-left: 20px">
                    <h4 class="text-muted" style="margin-bottom: -1px"> Pending Order</h4>
                    
                    <div class="row gutters mt-5  " >
                        @foreach ($orderItems->unique('order_id') as  $uniqueOrderItem)
                        @if ($uniqueOrderItem->status == 'Pending' || $uniqueOrderItem->status == 'Preparing' && $uniqueOrderItem->order->status != 'Close')
                            <div class="col-6 " style="margin-bottom: 30px;">
                                
                                        <div class="card rounded-3 px-3  h-100 ">
                                            <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                                                <div style="display: flex; justify-content: space-between;">
                                                    <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>
                                                    <a href="" class="text-white"><i class="fas fa-arrow-left"></i>
                                                        {{ $uniqueOrderItem->order->order_date }}</a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mt-2 ">
                                                @foreach ($orderItems as $orderItem)
                                                    @if ($orderItem->order_id == $uniqueOrderItem->order_id)
                                                      
                                                            <div class="col-sm-6 col-6 " style="display: flex; justify-content: space-between;">
                                                                <h5>{{ $orderItem->menuItem->item_name }}</h5>
                                                                <h5> {{ $orderItem->quantity }}</h5>
                                                                <h5>{{ $orderItem->remark }}</h5>
                                                            </div>
                                                            <div class="col-sm-3 col-3 ">
                                                                @if ($uniqueOrderItem->status == 'Pending')
                                                                <h6 class="bg-warning" style="color: white"> {{ $orderItem->status }}</h6>
                                                                @elseif  ($uniqueOrderItem->status == 'Preparing')
                                                                <h6 class="bg-info" style="color: white"> {{ $orderItem->status }}</h6>
                                                               
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-3 col-3">
                                                               
                                                                    @if ($orderItem->status == 'Pending')
                                                                 
                                                                        <a href=" changeStatusToPreparing-{{ $orderItem->id }}"
                                                                            type="button" class="btn btn-primary">
                                                                            Start </a>
                                                                    @elseif ($orderItem->status == 'Preparing')
                                                                  
                                                                        <a href=" changeStatusToReady-{{ $orderItem->id }}"
                                                                            type="button" class="btn btn-secondary">
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
            </div>
        </div>
        <div class="col-md-4 px-2" style="border-left: 1px solid #ccc;">
            <div class="d-flex align-items-center mb-4">
                <i style="font-size: 2rem" class="fas fa-file-alt text-primary"></i>
                <div style="margin-left: 10px">
                    <h4 class="text-muted" style="margin-bottom: -1px">Ready Order</h4>
                    <div class="row gutters mt-5  " >
                        @foreach ($orderItems->unique('order_id') as  $uniqueOrderItem)
                        @if ($uniqueOrderItem->status == 'Ready'  && $uniqueOrderItem->order->status != 'Close')
                            <div class="col-12 " style="margin-bottom: 30px;">
                                
                                        <div class="card rounded-3 px-3  h-100 ">
                                            <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                                                <div style="display: flex; justify-content: space-between;">
                                                    <strong> {{ $uniqueOrderItem->order->table->table_name }} </strong>
                                                    <a href="" class="text-white"><i class="fas fa-arrow-left"></i>
                                                        {{ $uniqueOrderItem->order->order_date }}</a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($orderItems as $orderItem)
                                                    @if ($orderItem->order_id == $uniqueOrderItem->order_id)
                                                        <div class="row mt-2 ">
                                                            <div class="col-sm-6 col-6 " style="display: flex; justify-content: space-between;">
                                                                <h5>{{ $orderItem->menuItem->item_name }}</h5>
                                                                <h5> {{ $orderItem->quantity }}</h5>
                                                                <h5>{{ $orderItem->remark }}</h5>
                                                            </div>
                                                            <div class="col-sm-4 col-4 ">
                                                                @if ($uniqueOrderItem->status == 'Ready')
                                                                <h6 class="bg-danger" style="color: white"> {{ $orderItem->status }}</h6>
                                                               @endif
                                                            </div>
                                                            <div class="col-sm-2 col-2 ">
                                                                @if ($uniqueOrderItem->status == 'Ready')
                                                                <h6 class="bg-danger" style="color: white"> {{ $orderItem->status }}</h6>
                                                               @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                   
                   
                            @endif
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div> --}}
</div>
</div>
