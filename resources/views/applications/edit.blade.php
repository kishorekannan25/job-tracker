<!DOCTYPE html>
<html>
<head>
    <title>Edit Application</title>
</head>
<body>
    <h1>Edit New Application</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Company</label><br>
            <input type="text" name="company" value="{{ old('company', $application->company) }}">
        </p>

        <p>
            <label>Role</label><br>
            <input type="text" name="role" value="{{ old('role', $application->role) }}">
        </p>

        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="applied" @selected(old('status', $application->status) == 'applied')>Applied</option>
                <option value="interview" @selected(old('status', $application->status) == 'interview')>Interview</option>
                <option value="offer" @selected(old('status', $application->status) == 'offer')>Offer</option>
                <option value="rejected" @selected(old('status', $application->status) == 'rejected')>Rejected</option>
            </select>
        </p>

        <p>
            <label>Applied Date</label><br>
            <input type="date" name="applied_date" value="{{ old('applied_date', $application->applied_date) }}">
        </p>

        <p> 
            <label>Salary Range</label><br>
            <input type="text" name="salary_range" value="{{ old('salary_range', $application->salary_range) }}">
        </p>

        <p>
           <label>Notes</label><br>
           <textarea name="notes" rows="4">{{ old('notes', $application->notes) }}</textarea>
        </p>

        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('applications.index') }}">Back to list</a></p>
</body>
</html>