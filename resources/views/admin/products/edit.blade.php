@extends('layouts.admin')

@section('content')
    <form action="<?= route("products.update",$product->id)?>" method='post' enctype="multipart/form-data">
        @csrf
        @method("put"){{--form method spoofing --}}

        @include('admin.products._form',['btn_submit' => 'update'])  


    </form>    
@endsection