
@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Mantain</li>
            <li class="breadcrumb-item active">SupplyItem/Edit</li>
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
        <div class="card rounded-3 px-3  " style="height: 450px;">
            <div class="card-header bg-primary rounded-3" style="margin-top: -10px;color:#fff">
                <div style="display: flex; justify-content: space-between;">
                    <strong> Create Supply Item </strong>
                    <a href="{{ route('supplyItem.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('supplyItem.update',$items->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1"> Table Name</label>
                        <select class="form-control selectpicker" id="item_category_id" name="item_category_id"
                        data-live-search="true" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"  {{ old('table_id', $items->item_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->item_category_name }}</option>
                            @endforeach

                        </select>
                        @error('item_category_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $items->item_name }}"
                            placeholder="item_name" required>
                        @error('item_name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit_of_measure">Unit Of Measure</label>
                        <input type="text" class="form-control" id="unit_of_measure" placeholder="unit_of_measure" value="{{ $items->unit_of_measure }}"
                            name="unit_of_measure" required>
                        @error('unit_of_measure')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_name">Price</label>
                        <input type="number" class="form-control" id="price" name="price"  value="{{ $items->price }}"
                            placeholder="contact_name" required>
                        @error('price')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-xl-12">
                        <button type="submit" id="submit" name="submit"
                            class="btn btn-primary float-right">Submit
                            Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


