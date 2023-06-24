@extends('layouts.admin')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <header class="mb-4 d-flex">

        <h2 class="mb-4 fs-2 ">Trased Products</h2>
        <div class="ml-auto">
            <a class="btn btn-primary m-2" href="{{ route('products.index') }}" role="button">products List</a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                {{-- <th>image</th> --}}
                <th>Deleted at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name_product ?></td>
                    {{-- <td>
                        <a href="{{ $product->image_url }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name_product }}" srcset="" high=60
                                width=60>
                        </a>
                    </td> --}}
                    <td><?= $product->deleted_at ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <form action="{{ route('products.restore', $product->id) }}" method="POST">
                                @csrf 
                                @method('PUT')
                                <button type="submit" class="btn btn-success">restore</button>
                            </form>
                            <form action="{{ route('products.force-delete', $product->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
