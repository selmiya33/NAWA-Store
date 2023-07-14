@foreach ($categories as $category)
    <div class="col-lg-4 col-md-6 col-12" >
        <!-- Start Single Category -->
        <div class="single-category" >
            <h3 class="heading">{{ $category->name }}</h3>
            <ul style="width: 90px; height: 150px;">
            @foreach ($category->products()->active()->get() as $product)
                <li ><a href="product-grids.html">{{ $product->name_product }}</a></li>
            @endforeach
        </ul>
            <div class="images">
                <img src="{{ $category->image_url }}"  width="180" height="180">
            </div>
        </div>
        <!-- End Single Category -->
    </div>
@endforeach
