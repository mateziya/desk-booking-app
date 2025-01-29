<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReservationsController extends Controller
{
    public function calendar()
    {   
        return Inertia::render('Calendar');
    }
    public function userReservations($date)
    {
        $user = auth()->user();
        $reservations = Reservation::all();

        $desks = Desk::with(['reservations' => function ($query) use ($date) {
            $query->where('date', $date);
        }])->paginate(8);

        $hasReservation = $user->reservations()->where('date', $date)->exists();

        $reservedDesk = $user->reservations()->where('date', $date)->value('desk_id');

        return Inertia::render('UserReservation', [
            'desks' => $desks,
            'reservations' => $reservations,
            'selectedDate' => $date,
            'hasReservation' => $hasReservation,
            'reservedDesk' => $reservedDesk
        ]);
    }
    public function adminReservations($date)
    {
        $reservations = Reservation::with(['user', 'desk'])->paginate(10);

        return Inertia::render('AdminReservation', [
            'selectedDate' => $date,
            'reservations' => $reservations
        ]);
    }
    public function reserveDesk($date, Desk $desk)
    {
        $user = Auth::user();

        if (Reservation::where('user_id', $user->id)->where('date', $date)->exists()) {
            return redirect()->back();
        }

        if (Reservation::where('desk_id', $desk->id)->where('date', $date)->exists()) {
            return redirect()->back();
        }

        Reservation::create([
            'user_id' => $user->id,
            'desk_id' => $desk->id,
            'date' => $date
        ]);
        return redirect()->back();
    }

    public function cancelReservation($date, Desk $desk)
    {
        $user = Auth::user();

        $reservation = Reservation::where('user_id', $user->id)
            ->where('desk_id', $desk->id)
            ->where('date', $date)
            ->first();

        if ($reservation) {
            $reservation->delete();
        }

        return redirect()->back();
    }
    public function deleteReservation(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->back();
    }
}
