<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $members = Member::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $members = Member::all();
        }

        return view('members.index', compact('members', 'search'));
    }


    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required|unique:members',
            'address' => 'required',
            'contact_information' => 'required',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index');
    }

    /**
     * Display the specified member.
     */
    public function show(Request $request, $id)
    {
        $search = $request->input('search');
        if ($search) {
            $members = Member::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $members = Member::all();
        }

        $selectedMember = Member::with('borrowRecords.book')->findOrFail($id);
        $borrowRecords = $selectedMember->borrowRecords()->paginate(7);

        return view('members.index', compact('members', 'selectedMember', 'borrowRecords', 'search'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required|unique:members,ic_no,' . $member->id,
            'address' => 'required',
            'contact_information' => 'required',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index');
    }
}
