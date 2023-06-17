@extends('layouts.admin')

@section('content')
    <form action="{{route('categories.update',$category?->id)}}" method="post">
        @csrf
        @method("put")

        @include('admin.categories._form',['btn_submit' => 'update'])

    </form>

@endsection