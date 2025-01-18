<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationsController extends Controller
{
    public function userCallendar()
    {
        return Inertia::render('UserCalendar');
    }
    public function userReservations()
    {
        $desks = Desk::all();
        return Inertia::render('UserReservation', [
            'desks' => $desks
        ]);
    }
    
}
