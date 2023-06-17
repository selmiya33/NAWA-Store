    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" name="name" value="{{$product->name_product}}" placeholder="ProductName">
    <label for="name">Product Name</label>
    </div>

    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="slug" name="slug" value="{{$product->slug}}" placeholder="URL Slug">
    <label for="slug">URL Slug</label>
    </div>

    <div class="form-floating mb-3">
    <textarea  class="form-control" id="description" name="description" placeholder="Description">{{$product->description}}</textarea>
    <label for="description">Description</label>
    </div>

    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="Short" name="Short" placeholder="Short">
    <label for="Short">Short Description</label>
    </div>

    
    <div class="form-floating mb-3">
      <select class="form-control" name="category_name" id="category_name" placeholder="category">
        @foreach ($categories as $category)
        {{-- @if ($category->id == $product->category_id) selected @endif --}}
        <option @selected ($category->id == $product->category_id) value="<?= $category->id?>">{{$category->name}} </option>
        @endforeach
        
      </select>
    <label for="category_name">category name</label>
    </div>

    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" placeholder="price">
    <label for="price">Product Price</label>
    </div>

    <div class="form-floating mb-3">
    <input type="number" class="form-control" id="compare_price" name="compare_price"  placeholder="compare_price">
    <label for="compare_price">compare price</label>
    </div>

    <div class="form-floating mb-3">
    <input type="file" class="form-control" id="image" name="image" placeholder="image">
    <label for="image">image</label>
    </div>
    <button type="submit" class="btn btn-success">{{ $btn_submit ?? 'SAVE'}}</button>
