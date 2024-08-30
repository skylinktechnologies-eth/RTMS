@extends('Frames.app')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">

            <li class="breadcrumb-item active">Reservation</li>
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
        <div class="row gutters">
            <div class="col-sm-12">
                <div class="text-right mb-3">
                    <!-- Button trigger modal -->
                    @can('reservation-create')
                        <a href="{{ route('reservation.create') }}" type="button" class="btn btn-primary">Add New
                            Reservation</a>
                    @endcan

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
                                    <th>Contact Name</th>
                                    <th>Contact Number</th>
                                    <th>Reservation Date</th>
                                    <th>Table</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($details->unique('reservation_id') as $detail)
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $detail->reservation->contact_name }}</td>
                                        <td>{{ $detail->reservation->contact_number }}</td>
                                        <td>{{ $detail->reservation->reservation_date }}</td>
                                        @php
                                            $detailStatus = $detail->reservation->status;
                                        @endphp
                                        <td> <button type="button" class="btn" data-toggle="modal"
                                                style="background-color: white;color:rgb(3, 89, 180)"
                                                data-target="#viewItem{{ $detail->reservation->id }}">view
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="viewItem{{ $detail->reservation->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="viewItemLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewItemLabel">Reservation Tables
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="">
                                                                @csrf

                                                                <div class="row">
                                                                    <div class="col-sm-3 col-2">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputCity1">Table</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 col-3">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputCity1">Occupacy Start
                                                                                date</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 col-3">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputCity1">Occupacy End
                                                                                date</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2 col-2">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputCity1">Reservation Time</label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                @php
                                                                    $detailId = $detail->reservation->id;
                                                                @endphp
                                                                @foreach ($details as $detail)
                                                                    @if ($detail->reservation_id == $detailId)
                                                                        <div class="row">
                                                                            <div class="col-sm-3 col-3">
                                                                                <p> {{ $detail->table->table_name }}</p>

                                                                            </div>
                                                                            <div class="col-sm-3 col-3">
                                                                      <p>{{ $detail->occupancy_start_date }}</p>
                                                                            </div>
                                                                            <div class="col-sm-3 col-3">
                                                                                <p> {{ $detail->occupancy_end_date }}</p>

                                                                            </div>
                                                                            <div class="col-sm-3 col-3">
                                                                        <p> {{ $detail->reservation_time }}</p>
                                                                            </div>

                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                                <div class="modal-footer custom">


                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="dropdown">

                                                @if ($detailStatus == 'Pending')
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="background-color: rgb(221, 193, 8)">
                                                        {{ $detailStatus }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="changeStatusToConfirmed/{{ $detailId }}">Confirmed
                                                            {{ $detailStatus }}</a>
                                                        <a class="dropdown-item"
                                                            href="changeStatusToCancelled/{{ $detailId }}">Cancelled</a>
                                                    </div>
                                                @elseif ($detailStatus == 'Confirmed')
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="background-color: rgb(5, 111, 37)">
                                                        {{ $detailStatus }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="changeStatusToCancelled/{{ $detailId }}">Cancelled</a>
                                                    </div>
                                                @elseif ($detailStatus == 'Cancelled')
                                                    <button class="btn btn-primary " type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="background-color: rgb(154, 11, 11)">
                                                        {{ $detailStatus }}
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @can('reservation-edit')
                                                    <a type="link" href="{{ route('reservation.edit', $detailId) }}">
                                                        <i class="icon-edit" style="color: blue"></i>
                                                    </a>
                                                @endcan


                                                @can('reservation-delete')
                                                    <form action="{{ route('reservation.destroy', $detailId) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link p-0">
                                                            <i class=" icon-trash-2" style="color:red"></i>
                                                        </button>
                                                    </form>
                                                @endcan

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
