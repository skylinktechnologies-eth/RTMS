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


                    {{-- @php
                        $total = $groupedOrderItem['sub_total'];
                        $orderItem = $groupedOrderItem['orderItem'];
                    @endphp
                --}}
                    <div class="row">
                        <div class="col-7" style=" margin-right: 15px;">
                            @php
                                $total = 0;
                            @endphp
                            <div class="row">
                                @foreach ($orderItems->unique('order_id') as $uniqueOrderItem)
                                    @if ($uniqueOrderItem->status == 'Pending' || $uniqueOrderItem->status == 'Preparing')
                                        <div class="col-4"
                                            style="background-color: #e6e2e2; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
                                            <div class="card border-primary">
                                                <div class="card-header d-flex flex-row align-items-center">
                                                    <img src="{{ asset('storage/' . $uniqueOrderItem->menuItem->image) }}"
                                                        alt="Table Image"
                                                        style="width: 50px; height: 40px; border-radius: 50%; margin-right: 10px;">
                                                    <span>{{ $uniqueOrderItem->order->table->table_name }}</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex flex-column align-items-center">

                                                        <div class="text-center">

                                                            <p>Date: {{ $uniqueOrderItem->order->order_date }}</< /p>
                                                        </div>

                                                        <div class="d-flex mt-2">


                                                            <button type="button" class="btn  mr-2" data-toggle="modal"
                                                                data-target="#viewItem1{{ $uniqueOrderItem->order_id }}"
                                                                style="color: #10418a">Detail
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="viewItem1{{ $uniqueOrderItem->order_id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="viewItemLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="viewItemLabel">
                                                                                Items</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST" action="">
                                                                                @csrf

                                                                                <div class="row">
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">Menu
                                                                                                Item</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">quantity</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">price</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">Sub
                                                                                                Total</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @php
                                                                                    $total = 0;
                                                                                @endphp
                                                                                @foreach ($orderItems as $orderItem)
                                                                                    @if ($orderItem->order_id == $uniqueOrderItem->order_id)
                                                                                        <div class="row">
                                                                                            <div class="col-sm-3 col-3">
                                                                                                <div class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="category_name"
                                                                                                        name="item_id"
                                                                                                        value="{{ $orderItem->menuItem->item_name }} "
                                                                                                        placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-3 col-3">
                                                                                                <div class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="quantity"
                                                                                                        name="quantity[]"
                                                                                                        value="{{ $orderItem->quantity }}  "
                                                                                                        placeholder="Category Name"
                                                                                                        style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-3 col-3">
                                                                                                <div class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="price"
                                                                                                        name="price[]"
                                                                                                        value="  {{ $orderItem->menuItem->price }} "
                                                                                                        placeholder="Category Name"
                                                                                                        style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-sm-3 col-3">
                                                                                                <div
                                                                                                    class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="total"
                                                                                                        name="total[]"
                                                                                                        value="{{ $orderItem->sub_total }} "
                                                                                                        placeholder="total"
                                                                                                        style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $total += $orderItem->sub_total;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endforeach
                                                                                <div class="text-right">
                                                                                    <p>Total:{{ $total }}</p>
                                                                                </div>
                                                                                <div class="modal-footer custom">

                                                                                    <div class="right-side">
                                                                                        <button type="submit"
                                                                                            class="btn btn-link success btn-block">unPaid</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="d-flex flex-row">
                                                            @if ($uniqueOrderItem->status == 'Pending')
                                                                <p class="bg-warning"
                                                                    style="color: white; margin-right: 20px;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    {{ $uniqueOrderItem->status }}
                                                                </p>
                                                            @elseif ($uniqueOrderItem->status == 'Preparing')
                                                                <p class="bg-info"
                                                                    style="color: white; margin-right: 20px;">
                                                                    <i
                                                                        class="fas fa-check-circle"></i>{{ $uniqueOrderItem->status }}
                                                                </p>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            </div>


                        </div>
                        <div class="col-4">
                            <div class="card border-primary">
                                <h6>ready product</h6>
                                <div class="row">

                                    @foreach ($orderItems->unique('order_id') as $uniqueOrderItem)
                                        @if ($uniqueOrderItem->status == 'Ready' && $uniqueOrderItem->order->status != 'Close')
                                            <div class="col-6"
                                                style="background-color: #e6e2e2; padding: 10px; border-radius: 10px; margin-bottom: 10px;">
                                                <div class="card">
                                                    <div class="card-header d-flex flex-row align-items-center">
                                                        <img src="{{ asset('storage/' . $uniqueOrderItem->menuItem->image) }}"
                                                            alt="Table Image"
                                                            style="width: 50px; height: 40px; border-radius: 50%; margin-right: 10px;">
                                                        <span>{{ $uniqueOrderItem->order->table->table_name }}</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="d-flex flex-column align-items-center">

                                                            <div class="text-center">

                                                                <p>Date: {{ $uniqueOrderItem->order->order_date }}</<
                                                                        /p>
                                                            </div>

                                                            <div class="d-flex mt-2">



                                                                <button type="button" class="btn  mr-2"
                                                                    data-toggle="modal"
                                                                    data-target="#viewItem1{{ $uniqueOrderItem->order_id }}"
                                                                    style="color: #10418a">Pay
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="viewItem1{{ $uniqueOrderItem->order_id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="viewItemLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="viewItemLabel">Items</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">


                                                                                <div class="row">
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">Menu
                                                                                                Item</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">quantity</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">price</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-3">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="exampleInputCity1">Sub
                                                                                                Total</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @php
                                                                                    $total = 0;
                                                                                @endphp
                                                                                @foreach ($orderItems as $orderItem)
                                                                                    @if ($orderItem->order_id == $uniqueOrderItem->order_id)
                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-sm-3 col-3">
                                                                                                <div
                                                                                                    class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="category_name"
                                                                                                        name="item_id"
                                                                                                        value="{{ $orderItem->menuItem->item_name }} "
                                                                                                        placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-sm-3 col-3">
                                                                                                <div
                                                                                                    class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="quantity"
                                                                                                        name="quantity[]"
                                                                                                        value="{{ $orderItem->quantity }}  "
                                                                                                        placeholder="Category Name"
                                                                                                        style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-sm-3 col-3">
                                                                                                <div
                                                                                                    class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="price"
                                                                                                        name="price[]"
                                                                                                        value="  {{ $orderItem->menuItem->price }} "
                                                                                                        placeholder="Category Name"
                                                                                                        style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-sm-3 col-3">
                                                                                                <div
                                                                                                    class="form-group">

                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        id="total"
                                                                                                        name="total[]"
                                                                                                        value="{{ $orderItem->sub_total }} "
                                                                                                        placeholder="total"
                                                                                                        style="border-block-color: white;border-color:white">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $total += $orderItem->sub_total;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endforeach
                                                                                <div class="text-right">
                                                                                    <p>Total:{{ $total }}</p>
                                                                                </div>
                                                                                <div class="modal-footer custom">

                                                                                    <div class="right-side">
                                                                                        <a href=" changeStatusClose-{{ $uniqueOrderItem->order->id }}"
                                                                                            type="button"
                                                                                            class="btn btn-primary">
                                                                                            Paid </a>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="bg-danger " style="color: white">
                                                                    <i class="fas fa-check-circle"></i> Ready
                                                                </p>
                                                            </div>
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

            </div>

        </div>
    </div>
