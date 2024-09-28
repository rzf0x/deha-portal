@props(['type' => 'success', 'message'])

@if (session()->has('message') || $message)
    <div class="d-flex justify-content-end">
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)"
            class="alert alert-{{ $type }} w-25">
            {{ session('message') ?? $message }}
        </div>
    </div>
@endif
