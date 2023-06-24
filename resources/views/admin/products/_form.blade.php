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
        <x-form.input type="text" value="{{ $product->name_product }}" id="name_product" name="name_product"
            lable="Product Name" />
        <x-form.input type="text" value="{{ $product->slug }}" id="slug" name="slug" lable="URL Slug" />

        <x-form.textarea value="{{ $product->description }}" id="description" name="description" lable="Description" />

        <div class="form-floating mb-3">
            <label for="status">status Option</label>
            <div>
                @foreach ($status_options as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_{{ $value }}"
                            value="{{ $value }}" @checked($value == old('status', $product->status))>
                        <label class="form-check-lable" for="status_{{ $value }}">{{ $label }}</label>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="mb-3">
            <label for="image">gallery</label>
            <div>
                <input type="file" class="form-control" id="gallery" name="gallery[]" multiple
                    placeholder="gallery">
            </div>
            @if ($gallery ?? false)
                <div class="row">
                    @foreach ($gallery as $image)
                        <div class="col-md-3">
                            <img src="{{ $image->url }}" class="img-fluid" high=100 width=100>

                            <button type="button" class="close position-absolute top-0 end-0" aria-label="Close">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            <x-form.error name="image" />
        </div>

    </div>

    <div class="col-md-6">

        <x-form.textarea value="{{ $product->short_description }}" id="short_description" name="short_description"
            lable="Short Description" />

        <x-form.select :value="$product->category_id" :options="$categories->pluck('name','id')" id="category_name"
            name="category_id" lable="category name" />


        <x-form.input type="number" value="{{ $product->price }}" id="price" name="price"
            lable="Product Price" />
        <x-form.input type="number" value="{{ $product->comper_price }}" id="comper_price" name="comper_price"
            lable="compare price" />

        <div>
            <x-form.input type="file" value="{{ $product->image }}" id="image" name="image"
                lable="product Image" />
            <a href="{{ $product->image_url }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name_product }}" srcset="" high=120
                    width=100>
            </a>
        </div>
        <br>
    </div>

</div>
<button type="submit" class="btn btn-success">{{ $btn_submit ?? 'SAVE' }}</button>
