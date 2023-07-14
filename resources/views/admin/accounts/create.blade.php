@extends('layouts.admin')

@section('content')
    <form action="<?= route("categories.store")?>" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.categories._form',['btn_submit' => 'create'])

    </form>
@endsection
