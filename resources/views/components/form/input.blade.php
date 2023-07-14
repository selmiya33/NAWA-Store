@props([
    'type' => 'text',
    'value' => '',
    'id',
    'name',
    'lable',
    'class'=> 'form-floating mb-3'
])

<div class="{{ $class }}">
    <label for="{{ $id }}">{{ $lable }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ $lable }}" value="{{ old("$name", $value) }}" />
    <x-form.error name="{{ $name }}" />
</div>
