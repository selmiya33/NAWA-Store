{{--  
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif --}}

<div class="row">
  <div class="col-md-6">

<div class="form-floating mb-3">
  <label for="name_product">Product Name</label>
  <input type="text" class="form-control" id="name_product" name="name_product" value="{{old('name_product',$product->name_product)}}" placeholder="ProductName">
  @error('name_product')
    <p class="text-danger">{{$message}}</p>
  @enderror
</div>

<div class="form-floating mb-3">
  <label for="slug">URL Slug</label>
  <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug',$product->slug)}}" placeholder="URL Slug">
  @error('slug')
  <p class="text-danger">{{$message}}</p>
  @enderror
</div>

<div class="form-floating mb-3">
  <label for="description">Description</label>
<textarea  class="form-control" id="description" name="description" placeholder="Description">{{old('description',$product->description)}}</textarea>
@error('description')
<p class="text-danger">{{$message}}</p>
@enderror

<div class="form-floating mb-3">
  <label for="status">status Option</label>
  <div>
    @foreach($status_options as $value => $label)
  <div class="form-check">
    <input class="form-check-input" type="radio"  name="status" id="status_{{$value}}" value="{{$value}}" @checked($value ==old('status',$product->status))>
          <label class="form-check-lable" for="status_{{$value}}" >{{ $label }}</label>    
  </div>
  @endforeach

</div>
</div>

</div>
</div>
<div class="col-md-6">


<div class="form-floating mb-3">
  <label for="Short">Short Description</label>
  <input type="text" class="form-control" id="Short" name="short_description" value="{{old('short_description',$product->short_description)}}" placeholder="Short">
  @error('short_description')
  <p class="text-danger">{{$message}}</p>
  @enderror
</div>


<div class="form-floating mb-3">
  <label for="category_name">category name</label>
  <select class="form-control" name="category_id" id="category_name" placeholder="category">
    @foreach ($categories as $category)
    {{-- @if ($category->id == $product->category_id) selected @endif --}}
    <option @selected ($category->id ==old('category_name',$product->category_id)) value="<?= $category->id?>">{{$category->name}} </option>
    @endforeach
    
  </select>
</div>

<div class="form-floating mb-3">
  <label for="price">Product Price</label>

<input type="number" step="0.1" min="0" class="form-control" id="price" name="price" value="{{old('price',$product->price)}}" placeholder="price">
@error('price')
<p class="text-danger">{{$message}}</p>
@enderror
</div>

<div class="form-floating mb-3">
  <label for="comper_price">compare price</label>
  <input type="number" step="0.1" class="form-control" id="comper_price" name="comper_price" value="{{old('comper_price',$product->comper_price)}}"  placeholder="comper_price">
</div>

<div class="form-floating mb-3">
  <label for="image">image</label>

<input type="file" class="form-control" id="image" name="image" placeholder="image">
</div>
</div>

</div>
<button type="submit" class="btn btn-success">{{ $btn_submit ?? 'SAVE'}}</button>
