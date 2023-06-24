@props([
    'type' => 'text',
    'value' => '',
    'id',
    'name',
    'lable',
])

<div class="form-floating mb-3">
    <label for="{{ $id }}">{{ $lable }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ $lable }}" value="{{ old("$name", $value) }}" />
    <x-form.error name="{{ $name }}" />
</div>
