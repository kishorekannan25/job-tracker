@props(['status'])

<span class="text-xs px-2 py-1 rounded {{ $status->color() }}">
    {{ $status->label() }}
</span>