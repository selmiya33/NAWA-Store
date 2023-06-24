@props([
    'id','name','lable','value','options'
])
<div class="form-floating mb-3">
    <label for="{{$id}}">{{$lable}}</label>
    <select class="form-control" name="{{$name}}" id="{{$id}}" placeholder="{{$lable}}">
        @foreach ($options as $option_value => $option_text)
            {{-- @if ($category->id == $product->category_id) selected @endif --}}
            <option @selected($option_value == old($name, $value)) value="{{$option_value}}">{{ $option_text }} </option>
        @endforeach

    </select>
    <x-form.error name="{{ $name }}" />
</div>