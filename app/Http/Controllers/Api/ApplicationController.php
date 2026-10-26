<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = $request->user()->applications()->paginate(10);

        return ApplicationResource::collection($applications);
    }

    public function show(Application $application)
    {
        Gate::authorize('view', $application);

        return new ApplicationResource($application);
    }
}
