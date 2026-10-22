@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="max-w-md mx-auto p-6">

    <h1 class="text-3xl font-bold mb-4">Create an account</h1>

    <form action="{{ route('register.store') }}" method="POST" class="bg-white rounded shadow p-6">
    @csrf

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name') }}"
            class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
            class="w-full border border-gray-300 rounded px-3 py-2">
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password"
            class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm password</label>
        <input type="password" name="password_confirmation"
            class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Register
    </button>
    </form>

</div>

@endsection