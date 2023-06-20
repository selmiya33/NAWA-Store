@extends('layouts.admin')

@section('content')
    <form action="{{route('categories.update',$category?->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")

        @include('admin.categories._form',['btn_submit' => 'update'])

    </form>

@endsection