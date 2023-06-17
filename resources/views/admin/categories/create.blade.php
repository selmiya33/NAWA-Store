@extends('layouts.admin')

@section('content')
    <form action="<?= route("categories.store")?>" method="post">
        @csrf
        @include('admin.categories._form',['btn_submit' => 'create'])

    </form>
@endsection
