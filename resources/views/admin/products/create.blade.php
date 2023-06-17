@extends('layouts.admin')

@section('content')
    <form action="<?= route("products.store")?>" method="post">
        @csrf
        
        @include('admin.products._form',['btn_submit' => 'create'])    


    </form>    
@endsection