<!DOCTYPE html>
<html>
<head>
    <title>My Applications</title>
</head>
<body>
    <h1>My Job Applications</h1>

    {{-- counts how many items are in the collection loaded from the controller --}}
    <p>Total: {{ count ($applications) }} applications</p> 

    {{--Link to the create form --}}
    <p>
        <a href="{{ route('applications.create') }}">+ Add New Application</a>
    </p>

    <ul>
        {{-- loops through each application in the collection --}}
        @foreach ($applications as $application)
        <li>
        {{-- object -> property access --}}
        <strong>{{ $application -> company }} </strong> - 
        {{ $application->role }} -
        ({{ $application->status}}) 
        <a href="{{ route('applications.show', $application->id) }}">[View Details]</a>
        </li>
        @endforeach
    </ul>
</body>
</html>
