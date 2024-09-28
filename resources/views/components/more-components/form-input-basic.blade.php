@props([
    'label',  // Label untuk input
    'type' => 'text',  // Default tipe input adalah text
    'name' => '',  // Nama input
    'value' => '',  // Value untuk input
    'readonly' => false,  // Apakah input readonly atau tidak
])

<div class="form-group mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $name }}" value="{{ $value }}"
        @if($readonly) readonly @endif>
</div>
