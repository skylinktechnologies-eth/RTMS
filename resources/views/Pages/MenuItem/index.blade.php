
@extends('Frames.app')
@section('content')
<style>
     .table td img {
            width: 70px;
            height: 50px;
            border-radius: 0%;
        }
</style>
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Menu Item</li>
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
                    <a href="{{ route('menuItem.create') }}" type="button" class="btn btn-primary">Add New
                        Menu</a>
                </div>
            </div>
        </div>
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-sm-12">

                <div class="table-container">

                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead >
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($items as $item)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td class="small-image-cell">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Image">
                                        </td>

                                        <td>{{ $item->category->category_name }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a type="link" href="{{ route('menuItem.edit', $item->id) }}">
                                                    <i class=" icon-edit " style="margin-right: 5px; color:blue"></i>
                                                </a>
                                                <form action="{{ route('menuItem.destroy', $item->id) }}" method="POST">
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

