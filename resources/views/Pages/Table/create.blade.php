@extends('Frames.app')
@section('content')
    <div>
        <h4>Create Table</h4>
    </div>
    <div class="col-md-12">
        <div class="card rounded-3 px-3">
            <div class="card-header   rounded-3 " style="margin-top: -10px;color:#9e7b7b ; background-color:#b66dff">
                <div style="display: flex; justify-content: space-between;">
                   <h5  class="text-white"> <strong>Table</strong></h5>
                
                    <a  href="{{ route('table.index') }}" class="text-white" style="text-decoration: none">
                        <i class=" mdi mdi-arrow-left " style="color: #ffffff"></i>back</a>
                   
                   
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
@endsection
