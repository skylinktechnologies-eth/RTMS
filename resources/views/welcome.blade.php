@extends('Frames.app')
@section('content')
  
<!-- Main container start -->
<div class="card">
    <div class="card-body">

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-4 col-sm-6 col-12">
                <p><code>Live search</code></p>
                <select class="form-control selectpicker" data-live-search="true">
                    <optgroup label="Picnic">
                        <option>United States</option>
                        <option>Brazil</option>
                        <option>Turkey</option>
                    </optgroup>
                    <optgroup label="Camping">
                        <option>Japan</option>
                        <option>India</option>
                        <option>Canada</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="form-group">
                    <p><code>Key words</code></p>
                    <select class="form-control selectpicker" data-live-search="true">
                        <option data-tokens="Brazil United States">Hot Dog, Fries and a Soda</option>
                        <option data-tokens="United States">Burger, Shake and a Smile</option>
                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="form-group">
                    <p><code>Limit the number of selections</code></p>
                    <select class="form-control selectpicker" multiple data-max-options="2"  data-live-search="true">
                        <option>United States</option>
                        <option>Brazil</option>
                        <option>Turkey</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
</div>
<!-- Main container end -->

   

@endsection
