<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Gate;
use App\Enums\ApplicationStatus;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applications = $request->user()->applications()
            ->when($request->filled('search'), function ($query) use ($request){
                $query->where('company', 'like', '%' . $request->search . '%');
        })

            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
        })
        ->paginate(10)->withQueryString();

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
            'status'        => ['required', Rule::enum(ApplicationStatus::class)],
            'applied_date'  => 'required|date',
            'salary_range'  => 'nullable|max:255',
            'notes'         => 'nullable',
        ]);

        $request->user()->applications()->create($validated);

        return redirect()->route('applications.index')
            ->with('success', 'Application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        Gate::authorize('view', $application);
    
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        Gate::authorize('update', $application);
        return view('applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        Gate::authorize('update', $application);

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
        Gate::authorize('delete', $application);

        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
