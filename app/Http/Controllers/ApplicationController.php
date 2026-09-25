<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applications = Application::query()
            ->when($request->filled('search'), function ($query) use ($request){
                $query->where('company', 'like', '%' . $request->search . '%');
        })

            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
        })
        ->get();

    return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.create', ['application' => new Application()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'company'       => 'required|max:255',
            'role'          => 'required|max:255',
            'status'        => 'required|in:applied,interview,offer,rejected',
            'applied_date'  => 'required|date',
            'salary_range'  => 'nullable|max:255',
            'notes'         => 'nullable',
        ]);

        Application::create($validated);

        return redirect()->route('applications.index')
            ->with('success', 'Application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = Application::findOrFail($id);

        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        return view('applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'company'           => 'required|max:255',
            'role'              => 'required|max:255',
            'status'            => 'required|in:applied,interview,offer,rejected',
            'applied_date'      => 'required|date',
            'salary_range'      => 'nullable|max:255',
            'notes'             => 'nullable',
        ]);

        $application->update($validated);

        return redirect()->route('applications.index')
            ->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
