@extends('layouts.app')

@section('title', 'My Applications')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-4">My Job Applications</h1>

    @if (session('success'))
        <p class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </p>
    @endif

    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600">Total: {{ count($applications) }} applications</p>
        <a href="{{ route('applications.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add New Application
        </a>
    </div>

    <ul class="space-y-2">
        @foreach ($applications as $application)
            <li class="bg-white p-4 rounded shadow">
                <strong>{{ $application->company }}</strong> —
                {{ $application->role }}
                <span class="text-xs px-2 py-1 rounded
                    @if ($application->status === 'offer') bg-green-100 text-green-800
                    @elseif ($application->status === 'interview') bg-yellow-100 text-yellow-800
                    @elseif ($application->status === 'rejected') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ $application->status }}
                </span>
                <a href="{{ route('applications.show', $application->id) }}"
                   class="text-blue-600 ml-2">View Details</a>
            </li>
        @endforeach
    </ul>

</div>

@endsection
