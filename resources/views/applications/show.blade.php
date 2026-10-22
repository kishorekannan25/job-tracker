@extends('layouts.app')

@section('title', $application->company)

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white rounded shadow p-6">

        <h1 class="text-3xl font-bold">{{ $application->company }}</h1>
        <h2 class="text-xl text-gray-600 mb-4">{{ $application->role }}</h2>

        <dl class="space-y-3">
            <div>
                <dt class="text-sm uppercase tracking-wide text-gray-500">Status</dt>
                <dd><x-status-badge :status="$application->status" /></dd>
            </div>
            <div>
                <dt class="text-sm uppercase tracking-wide text-gray-500">Applied date</dt>
                <dd>{{ $application->applied_date }}</dd>
            </div>
            <div>
                <dt class="text-sm uppercase tracking-wide text-gray-500">Salary range</dt>
                <dd>{{ $application->salary_range ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm uppercase tracking-wide text-gray-500">Notes</dt>
                <dd class="whitespace-pre-line">{{ $application->notes ?: '—' }}</dd>
            </div>
        </dl>

    </div>

    <div class="flex items-center gap-3 mt-6">

        <a href="{{ route('applications.edit', $application->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Edit</a>

        <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
              onsubmit="return confirm('Delete this application?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Delete</button>
        </form>

        <a href="{{ route('applications.index') }}"
           class="text-gray-600 hover:underline ml-auto">Back to list</a>

    </div>

</div>

@endsection
