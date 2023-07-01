@extends('layouts.admin')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <header class="mb-4 d-flex">

        <h2 class="mb-4 fs-2 ">{{ $title }}</h2>
        <div class="ml-auto">
            <a class="btn btn-primary m-2" href="{{ route('products.create') }}" role="button">add new product</a>
            <a class="btn btn-mid btn-danger" href="{{ route('products.trashed') }}">Trash</a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>image</th>
                <th>catagories</th>
                <th>price</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name_product ?></td>
                    <td>
                        <a href="{{ $product->image_url }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name_product }}" srcset="" high=60
                                width=60>
                        </a>
                    </td>
                    <td><?= $product->category_name ?></td>
                    <td><?= $product->price_formatted ?></td>
                    <td><?= $product->status ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-mid btn-success">EDIT</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="h-50 d-flex align-items-center justify-content-center">
        {{ $products->links() }}
    </div>
@endsection
