<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the volunteers.
     */
    public function index()
    {
        $volunteers = User::where('role', 'volunteer')->get();
        return view('volunteers.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new volunteer.
     */
    public function create()
    {
        return view('volunteers.create');
    }

    /**
     * Store a newly created volunteer in storage.
     */
    public function store(Request $request)
    {
        // Check if the authenticated user is a supervisor
        if (auth()->user()->role !== 'supervisor') {
            abort(403, 'Only supervisors can register new volunteers.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'volunteer',
        ]);

        return redirect()->route('volunteers.index');
    }

    /**
     * Display the specified volunteer.
     */
    public function show(User $volunteer)
    {
        return view('volunteers.show', compact('volunteer'));
    }

    /**
     * Show the form for editing the specified volunteer.
     */
    public function edit(User $volunteer)
    {
        return view('volunteers.edit', compact('volunteer'));
    }

    /**
     * Update the specified volunteer in storage.
     */
    public function update(Request $request, User $volunteer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $volunteer->id,
        ]);

        $volunteer->update($request->all());

        return redirect()->route('volunteers.index');
    }

    /**
     * Remove the specified volunteer from storage.
     */
    public function destroy(User $volunteer)
    {
        $volunteer->delete();

        return redirect()->route('volunteers.index');
    }
}
