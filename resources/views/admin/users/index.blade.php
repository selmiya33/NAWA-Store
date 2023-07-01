@extends('layouts.admin')
@section('content')

    @if (session()->has('success'))
    <div id="flash-message" class="alert alert-success ">
      {{session('success')}}
    </div>
    @endif

    <h2 class="mb-4 fs-2 ">Users</h2>
    <a class="btn btn-primary mb-2" href="{{route("categories.create")}}" role="button">add new Users</a>


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>status</th>
                <th>type</th>



                {{-- <th>Image</th> --}}
                <th>create at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{  $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->type }}</td>
                {{-- <td>
                  <a href="{{$category->image_url}}">
                      <img src="{{$category->image_url}}" alt="{{$category->name}}" srcset="" high =60 width=60>
                  </a>
               </td> --}}
                <td><?= $user->created_at->format('d F Y ')?></td>
                <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                  <a href="{{ route("users.edit",$user->id) }}" class="btn btn-success">Edit Password</a>
                  <form action="#" method="POST">
                    @csrf @method("DELETE")
                    <button type="submit"  class="btn btn-danger">DELETE</button>
                </form>
                </div>
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination cnter">
        {{$users->links()}}
    </div>
    @endsection
