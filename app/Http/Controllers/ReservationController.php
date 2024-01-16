<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\ResetInterface;

class ReservationController extends Controller
{
    //

    public function index()
    {

        $reservations = Reservation::all();
        $details = ReservationDetail::all();
        return view('Pages.Reservation.index', compact('reservations', 'details'));
    }

    public function create()
    {
        $reservations = Reservation::all();
        $tables = Table::all();
        return view('Pages.Reservation.create', compact('reservations', 'tables'));
    }
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        $details = ReservationDetail::all();
        $tables = Table::all();
        return view('Pages.Reservation.edit', compact('reservation', 'tables', 'details'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'reservation_date' => 'required',
            'reservation_time' => 'required',
            'party_size' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required'
        ]);

        $reservations = new Reservation();
        $statuses = "Pending";
        $reservations->reservation_time = $request->reservation_time;
        $reservations->reservation_date = $request->reservation_date;
        $reservations->party_size = $request->party_size;
        $reservations->contact_name = $request->contact_name;
        $reservations->contact_number = $request->contact_number;
        $reservations->status = $statuses;
        $reservations->save();

        foreach ($request->table_list as $table) {
            $detail = new ReservationDetail();
            $detail->reservation_id = $reservations->id;
            $detail->table_id = $table['table_id'];
            $detail->occupancy_start_date = $table['occupancy_start_date'];
            $detail->occupancy_end_date = $table['occupancy_end_date'];
            $detail->save();
        }

        return back()->with('success', 'Reservation created successfully!');
    }

    public function update(Request $request, $id)
    {

        $request->validate([


            'reservation_date' => 'required',
            'party_size' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'List' => 'required'


        ]);

        $reservations =  Reservation::find($id);
        $reservations->reservation_date = $request->reservation_date;
        $reservations->reservation_time = $request->reservation_time;
        $reservations->party_size = $request->party_size;
        $reservations->contact_name = $request->contact_name;
        $reservations->contact_number = $request->contact_number;
        $reservations->update();
        
        ReservationDetail::where('reservation_id', $id)->delete();
        foreach ($request->List as $table) {
            $detail = new ReservationDetail();
            $detail->reservation_id = $reservations->id;
            $detail->table_id = $table['table_id'];
            $detail->occupancy_start_date = $table['occupancy_start_date'];
            $detail->occupancy_end_date = $table['occupancy_end_date'];
            $detail->save();
        }
        return back()->with('success', 'Reservation update successfully!');
    }
    public function destroy(String $id)
    {
        $details = ReservationDetail::where('reservation_id', $id)->get();

        foreach ($details as $detail) {
            $detail->delete();
        }
        $reservation = Reservation::find($id);
        $reservation->delete();
        return back()->with('success', 'Reservation delete successfully!');
    }
    public function changeStatusToConfirmed($id)
    { 
       
        $reservation = Reservation::find($id);
        $reservation->status = 'Confirmed';
        $reservation->save();
        return back()->with('success', 'Change Status');
    }
    public function changeStatusToCancelled($id)
    {
      
        $reservation = Reservation::find($id);
        $reservation->status = 'Cancelled';
        $reservation->save();
        return back()->with('success', 'Change Status');
    }
}
