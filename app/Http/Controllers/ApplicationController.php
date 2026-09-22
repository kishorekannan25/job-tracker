<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::all(); //get all applications from db into collection 
        return view('applications.index',compact('applications')); /** render this view 
        * info: compact = pass $applications variable into the view
        */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'company'       => 'required|max:255',
            'role'          => 'required|max:255',
            'status'        => 'required|in:applied,interview,offer,rejected',
            'applied_date'  => 'required|date',
            'salary_range'  => 'nullable|max:255',
            'notes'         => 'nullable',
        ]);

        Application::create([
            'company'        => $request->company,
            'role'           => $request->role,
            'status'         => $request->status,
            'applied_date'   => $request->applied_date,
            'salary_range'   => $request->salary_range,
            'notes'          => $request->notes,
        ]);

        return redirect()->route('applications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "ApplicationController@show - Show application ID:" . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "ApplicationController@edit - Edit application ID:" .$id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "ApplicationController@update - Update application ID:" .$id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "ApplicationController@destroy - Delete application ID:" .$id;
    }
}
