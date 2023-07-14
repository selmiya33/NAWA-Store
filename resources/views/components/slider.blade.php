@foreach ($products as $product)
    <div class="single-slider" style="background-image: url({{ $product->ImageUrl }});">
        <div class="content">
            <h2><span>Discount {{ $product->discount }}</span>
                {{ $product->name_product }}
            </h2>
            <p>{{ $product->description }}</p>
            <h3><span>Now Only</span> {{ $product->price_formatted }}</h3>
            <div class="button">
                <a href="{{ route('shop.products.show',$product->slug) }}" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
@endforeach
