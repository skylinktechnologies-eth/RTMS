@extends('Frames.app')
@section('content')
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
        <div class="card pt-1" style="">
            <div class="row d-flex align-items-end">

                <div class="col-md-1 d-flex justify-content-end">

                </div>
                <div class="col-md-12">
                    <div class="">
                        <h3 class="text-white"></h3>
                    </div>
                    <ul class="nav nav-tabs  nav-bordered">
                       
                        <li class="nav-item">
                            <a href="{{ route('report.index') }}" aria-expanded="true" class="nav-link ">
                                <span class="d-inline-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                <span class="d-none d-sm-inline-block">Sales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.purchase') }}" aria-expanded="false" class="nav-link ">
                                <span class="d-inline-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                <span class="d-none d-sm-inline-block">Purchase</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('report.inventory') }}" aria-expanded="true" class="nav-link active">
                                <span class="d-inline-block d-sm-none"><i class="mdi mdi-email-variant"></i></span>
                                <span class="d-none d-sm-inline-block">Inventory</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <hr>

            <div class="card rounded-3 border-primary px-3 mt-3">
                <div class="card-header border-all bg-white rounded-3" style="margin-top: -10px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-info">Inventory Report</h4>
                        <form class="d-flex align-items-center" method="GET" action="">
                            @csrf

                        </form>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="copy-print-inventory" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Supply Item</th>
                                    <th>Purchased Quantity</th>
                                    <th>Issued Quantity</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->item->item_name }}</td>
                                        <td>{{ $inventory->purchased_quantity }}</td>
                                        <td>{{ $inventory->issued_quantity  }}</td>
                                        <td>
                                           {{ $inventory->purchased_quantity -  $inventory->issued_quantity }} 
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

    
@endsection
