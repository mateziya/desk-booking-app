<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $desks = Desk::all();
        return Inertia::render('DeskList', [
            'desks' => $desks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('AddDesk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Desk $desk)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'image_path' => 'nullable|image|max:3072|mimes:jpeg,jpg,png,webp'
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('desks', 'public');
        }
        $desk = Desk::create([
            'name' => $fields['name'],
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.desks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Desk $desk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desk $desk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desk $desk)
    {   
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desk $desk)
    {
        if ($desk->image_path) {
            Storage::disk('public')->delete($desk->image_path);
        };

        $desk->delete();
        return redirect()->route('admin.desks');
    }
}
