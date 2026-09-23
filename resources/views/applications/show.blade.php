<!DOCTYPE html>
<html>
    <head>
        <title>{{ $application->company }}</title>
    </head>
    <body>
        <h1>{{ $application->company }}</h1>
        <h2>{{ $application->role }}</h2>

        <p><strong>Status:</strong> {{ $application->status }}</p>
        <p><strong>Applied Date:</strong> {{ $application->applied_date }}</p>
        <p><strong>Salary Range:</strong> {{ $application->salary_range }}</p>
        <p><strong>Notes:</strong> {{ $application->notes }}</p>

        <p><a href="{{ route('applications.edit', $application->id)}}">Edit</a></p>

        <form action="{{ route('applications.destroy', $application->id) }}" method="POST" 
                    onsubmit="return confirm('Delete this application?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

        <p><a href="{{ route('applications.index') }}">Back to list</a></p>
    </body>
</html>