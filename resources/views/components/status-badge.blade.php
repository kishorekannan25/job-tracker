@props(['status'])

<span class="text-xs px-2 py-1 rounded
@if ($status === 'offer') bg-green-100 text-green-800
@elseif ($status === 'interview') bg-yellow-100 text-yellow-800
@elseif ($status === 'rejected') bg-red-100 text-red-800
@else bg-gray-100 text-gray-800
@endif">
{{ ucfirst($status) }}
</span>