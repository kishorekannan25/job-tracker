@extends('layouts.app')

@section('title', 'Add application')

@section('content')

<div class="max-w-xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Add new application</h1>

    <form action="{{ route('applications.store') }}" method="POST"
          class="bg-white rounded shadow p-6">
        @csrf

        @include('applications.partials.form-fields')

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>

    <p class="mt-4"><a href="{{ route('applications.index') }}" class="text-gray-600 hover:underline">Back to list</a></p>
</div>

@endsection
