@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-2">Dashboard</h1>
    <p class="text-gray-600 mb-6">You have {{ $total }} applications in total.</p>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach(\App\Enums\ApplicationStatus::cases() as $status)
            <a href="{{ route('applications.index', ['status' => $status->value]) }}"
            class="bg-white rounded shadow p-4 hover:shadow-md transition">
            <x-status-badge :status="$status" />
            <p class="text-3xl font-bold mt-3">{{ $counts[$status->value] ?? 0 }}</p>
            </a>
        @endforeach
    </div>

    <h2 class="text-xl font-bold mt-8 mb-4">Upcoming interviews</h2>

    @forelse ($upcomingInterviews as $application)
        <a href="{{ route('applications.show', $application) }}"
            class="block bg-white rounded shadow p-4 mb-2 hover:shadow-md transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold">{{ $application->company }}</p>
                    <p class="text-sm text-gray-600">{{ $application->role }}</p>
                </div>
                <p class="text-sm text-gray-600">{{ $application->interview_at->format('j M Y, g:i A') }}</p>
            </div>
        </a>
    @empty
        <p class="text-gray-600">No upcoming interviews.</p>
    @endforelse
</div>

@endsection
