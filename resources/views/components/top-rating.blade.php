<!-- Start Single List -->
@foreach ($topviews as $item)
<div class="single-list">
    <div class="list-image">
        <a href="{{ route('shop.products.show',$item->product->slug) }}"><img src="{{ $item->product->image_url }}" alt="#"></a>
    </div>
    <div class="list-info">
        <h3>
            <a href="{{ route('shop.products.show',$item->product->slug) }}">{{ $item->product->name_product }}</a>
        </h3>
        <span>{{ $item->product->price_formatted }}</span>
    </div>
</div>
@endforeach
<!-- End Single List -->
