<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ApplicationRequest;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = $request->user()->applications()->latest('applied_date')->paginate(10);

        return ApplicationResource::collection($applications);
    }

    public function show(Application $application)
    {
        Gate::authorize('view', $application);

        return new ApplicationResource($application);
    }

    public function store(ApplicationRequest $request)
    {
        $application = $request->user()->applications()->create($request->validated());

        return new ApplicationResource($application);
    }

    public function update(ApplicationRequest $request, Application $application)
    {
        Gate::authorize('update', $application);

        $application->update($request->validated());

        return new ApplicationResource($application);
    }

    public function destroy(Application $application)
    {
        Gate::authorize('delete', $application);

        $application->delete();

        return response()->noContent();
    }

}
