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
</div>

@endsection
