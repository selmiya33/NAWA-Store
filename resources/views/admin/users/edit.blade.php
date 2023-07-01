@extends('layouts.admin')

@section('content')
    <form action="{{ route('users.update', $user?->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            <x-form.input type="text"  id="password" name="password" lable="user password" />
            <br>
            <button type="submit" class="btn btn-success">save</button>
        </div>


    </form>
@endsection
