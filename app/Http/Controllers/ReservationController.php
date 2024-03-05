<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class ReservationController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:reservation-list|reservation-create|reservation-edit|reservation-delete', ['only' => ['index', 'store', 'changeStatusToConfirmed', 'changeStatusToCancelled']]);
        $this->middleware('permission:reservation-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:reservation-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:reservation-delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        $reservations = Reservation::all();
        $details = ReservationDetail::orderBy('created_at', 'desc')->get();
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
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required',
            'party_size' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'table_list' => 'required|array|min:1', // Ensure 'table_list' is an array with at least one element
            'table_list.*.table_id' => 'required',
            'table_list.*.occupancy_start_date' => 'required|date',
            'table_list.*.reservation_time' => 'required',
            'table_list.*.occupancy_end_date' => 'required|date|after_or_equal:table_list.*.occupancy_start_date',
         
        ]);
  
        // If validation fails, return the error response
        if ($validator->fails()) {
            return redirect()->route('reservation.index')->withErrors($validator)->withInput();
        }
    
        // Check table availability
        foreach ($request->table_list as $table) {
            $isTableAvailable = $this->isTableAvailable($table['table_id'], $table['occupancy_start_date'], $table['occupancy_end_date'],$table['reservation_time']);
    
            if (!$isTableAvailable) {
                return redirect()->route('reservation.index')->with('success', 'Table is already reserved for the specified date and time.');
            }
        }
    
        // Create a new reservation
        $reservation = new Reservation();
        $reservation->reservation_date = $request->reservation_date;
        $reservation->party_size = $request->party_size;
        $reservation->contact_name = $request->contact_name;
        $reservation->contact_number = $request->contact_number;
        $reservation->status = "Pending";
        $reservation->save();
    
        // Update table status and create reservation details
        foreach ($request->table_list as $table) {
            $reservationDetail = new ReservationDetail();
            $reservationDetail->reservation_id = $reservation->id;
            $reservationDetail->table_id = $table['table_id'];
            $reservationDetail->occupancy_start_date = $table['occupancy_start_date'];
            $reservationDetail->occupancy_end_date = $table['occupancy_end_date'];
            $reservationDetail->reservation_time = $table['reservation_time'];
            $reservationDetail->save();
        }
    
        return redirect()->route('reservation.index')->with('success', 'Reservation created successfully.');
    }
    
    // Helper function to check table availability
    private function isTableAvailable($tableId, $startDate, $endDate ,$time)
    {
        return !ReservationDetail::where('table_id', $tableId)
            ->where('occupancy_start_date', '<=', $endDate)
            ->where('occupancy_end_date', '>=', $startDate)
            ->where('reservation_time', '>=', $time)
            ->exists();
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
            $detail->reservation_time = $table['reservation_time'];
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
