@props([
    'id','name','lable','value'
])
<div class="form-floating mb-3">
    <label for="{{$id}}">{{$lable}}</label>
    <textarea class="form-control" id="{{$id}}" name="{{$name}}" placeholder="{{$lable}}">{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>