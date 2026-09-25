@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
    <input type="text" name="company" value="{{ old('company', $application->company) }}"
           class="w-full border border-gray-300 rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
    <input type="text" name="role" value="{{ old('role', $application->role) }}"
           class="w-full border border-gray-300 rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
    <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
        <option value="applied"   @selected(old('status', $application->status) === 'applied')>Applied</option>
        <option value="interview" @selected(old('status', $application->status) === 'interview')>Interview</option>
        <option value="offer"     @selected(old('status', $application->status) === 'offer')>Offer</option>
        <option value="rejected"  @selected(old('status', $application->status) === 'rejected')>Rejected</option>
    </select>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Applied Date</label>
    <input type="date" name="applied_date" value="{{ old('applied_date', $application->applied_date) }}"
           class="w-full border border-gray-300 rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Salary Range</label>
    <input type="text" name="salary_range" value="{{ old('salary_range', $application->salary_range) }}"
           class="w-full border border-gray-300 rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
    <textarea name="notes" rows="4"
              class="w-full border border-gray-300 rounded px-3 py-2">{{ old('notes', $application->notes) }}</textarea>
</div>
