<div>
<div class="form-floating mb-3">
    <label for="name">category Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="ProductName">
    @error('name')
    <p class="text-danger">{{$message}}</p>
    @enderror
</div>

<button type="submit" class="btn btn-success">{{$btn_submit ?? 'SAVE'}}</button>
</div>