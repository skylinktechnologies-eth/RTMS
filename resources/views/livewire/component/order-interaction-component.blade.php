<div>

    <div class=" card">
        <div class="card-body"></div>
    </div>
    <div class="container ">
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
        <div class="row gutters">
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="filter" aria-label="filter">
                </div>
            </div>
        </div>

        <div class="card">

            <div class=" card-body">

                {{-- @php
                    $groupedOrderItems = [];

                    foreach ($orderItems as $orderItem) {
                        $orderId = $orderItem->order->id;

                        if (!isset($groupedOrderItems[$orderId])) {
                            $groupedOrderItems[$orderId] = [
                                'sub_total' => 0,
                                'orderItem' => $orderItem, // Store one representative order item for details
                            ];
                        }

                        $groupedOrderItems[$orderId]['sub_total'] += $orderItem->sub_total;
                    }
                @endphp --}}

                @foreach ($orderItems as $orderItem)
                    {{-- @php
                        $total = $groupedOrderItem['sub_total'];
                        $orderItem = $groupedOrderItem['orderItem'];
                    @endphp
                --}}
                    <div class="row">
                        <div class="col-2"
                            style="background-color: #e6e2e2; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
                            <div class="d-flex flex-column align-items-center">
                                <img src="tableimage.jpg" alt="Table Image"
                                    style="width: 50px; height: 40px; border-radius: 50%; margin-bottom: 10px;">

                                <div class="text-center">
                                    <p>{{ $orderItem->table->table_name }}</p>
                                    <p>Capacity: {{ $orderItem->table->capacity }}</< /p>
                                </div>

                                <div class="d-flex mt-2">


                                    <td> <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                            data-target="#viewItem1">Detail
                                        </button></td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="viewItem1" tabindex="-1" role="dialog"
                                        aria-labelledby="viewItemLabel" aria-hidden="true">
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
                                                    <form method="POST" action="">
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

                                                        <div class="row">
                                                            <div class="col-sm-3 col-3">
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="category_name" name="item_id" value=" "
                                                                        placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-3">
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="quantity" name="quantity[]" value="  "
                                                                        placeholder="Category Name"
                                                                        style="border-block-color: white;border-color:white">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-3">
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="price" name="price[]" value="   "
                                                                        placeholder="Category Name"
                                                                        style="border-block-color: white;border-color:white">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-3">
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="total" name="total[]" value=" "
                                                                        placeholder="total"
                                                                        style="border-block-color: white;border-color:white">
                                                                </div>
                                                            </div>
                                                        </div>
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
                                    <p class="bg-warning mr-2 pb-2" style="color: white">
                                        <i class="fas fa-check-circle"></i> pending
                                    </p>
                                </div>
                            </div>
                        </div>



                    </div>
                @endforeach
            </div>

        </div>

    </div>
</div>
