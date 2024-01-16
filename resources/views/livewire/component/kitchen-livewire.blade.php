<div>
    <div class=" card">
        <div class="card-body"></div>
    </div>
    <div class="container ">
        <div class=" container">
            <div class="card-body"></div>
        </div>
        <div class="row gutters">
            <div class="col-4">
                <div class="text-right mb-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="search" aria-label="filter">
                    </div>
                </div>
            </div>
        </div>
    </div>
  
        <div class="row gutters pl-3  " >
            @foreach ($orderItems->unique('order_id') as  $uniqueOrderItem)
            @if ($uniqueOrderItem->status == 'Pending' || $uniqueOrderItem->status == 'Preparing' && $uniqueOrderItem->order->status != 'Close')
                <div class="col-4 " style="margin-bottom: 30px;">
                    
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
