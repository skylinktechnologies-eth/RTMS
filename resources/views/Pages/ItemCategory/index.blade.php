@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Mantain</li>
            <li class="breadcrumb-item active">Item Category</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewCategory">Add New
                        Category</button>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog"
                        aria-labelledby="addNewCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNewCategoryLabel">New Item Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('itemCategory.store') }}">
                                        @csrf
                                        <div class="col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputCity1">Item Category Name</label>
                                                <input type="text" class="form-control" id="item_category_name"
                                                    name="item_category_name" placeholder="Category Name"
                                                    value="{{ old('item_category_name') }}">
                                            </div>


                                        </div>
                                        <div class="modal-footer custom">


                                            <div class="right-side">
                                                <button type="submit" class="btn btn-link success btn-block">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters">
            <div class="col-sm-12">

                <div class="table-container">

                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($itemCategories as $itemCategory)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $itemCategory->item_category_name }}</td>
                                        <td>
                                            <div class="d-flex">

                                                <a href="#" class="edit-card" data-toggle="modal"
                                                    data-target="#editCategory{{ $itemCategory->id }}">
                                                    <i class="icon-edit" style="color: blue"></i>
                                                </a>
                                                <form action="{{ route('itemCategory.destroy', $itemCategory->id) }}"
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

                                    <div class="modal fade" id="editCategory{{ $itemCategory->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCategoryLabel">Edit Item Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form method="POST"
                                                        action="{{ route('itemCategory.update', $itemCategory->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputCity1">Item Category Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="item_category_name" name="item_category_name"
                                                                    value="{{ $itemCategory->item_category_name }}"
                                                                    placeholder="Category Name">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer custom">
                                                            <div class="center">
                                                                <button type="submit"
                                                                    class="btn btn-link success btn-block">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
