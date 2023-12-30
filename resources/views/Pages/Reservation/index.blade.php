@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Reservation</li>
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
                    <a href="{{ route('reservation.create') }}" type="button" class="btn btn-primary">Add New
                        Reservation</a>
                </div>
            </div>
        </div>
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-sm-12">

                <div class="table-container">

                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Table Name</th>
                                    <th>Reservation Date</th>
                                    <th>Party Size</th>
                                    <th>Contact Name</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($reservations as $reservation)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $reservation->table->table_name }}</td>
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>{{ $reservation->party_size }}</td>
                                        <td>{{ $reservation->contact_name }}</td>
                                        <td>{{ $reservation->contact_number }}</td>
                                        @if ($reservation->status == 'Pending')
                                            <td style="color: #fed713">{{ $reservation->status }}</td>
                                        @else
                                            <td>{{ $reservation->status }}</td>
                                        @endif


                                        <td>
                                            <div class="d-flex">

                                                <a type="link" href="{{ route('reservation.edit', $reservation->id) }}">
                                                    <i class="icon-edit" style="color: blue"></i>
                                                </a>


                                                <form action="{{ route('reservation.destroy', $reservation->id) }}"
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
