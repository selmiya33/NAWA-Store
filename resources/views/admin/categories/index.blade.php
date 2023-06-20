@extends('layouts.admin')
@section('content')

    @if (session()->has('success'))
    <div id="flash-message" class="alert alert-success ">
      {{session('success')}}
    </div>
    @endif

    <h2 class="mb-4 fs-2 ">{{$title}}</h2>
    <a class="btn btn-primary mb-2" href="{{route("categories.create")}}" role="button">add new category</a>

    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>create at</th>
                <th>update at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td><?= $category->id?></td>
                <td><?= $category->name?></td>
                <td>
                  <a href="{{$category->image_url}}">
                      <img src="{{$category->image_url}}" alt="{{$category->name}}" srcset="" high =60 width=60>
                  </a>
               </td>
                <td><?= $category->created_at->format('d F Y ')?></td>
                <td><?= $category->updated_at->format('d F Y ')?></td>
                <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                  <a href="{{route('categories.edit',$category->id)}}" class="btn btn-success">EDIT</a>
                  <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                    @csrf @method("DELETE")
                    <button type="submit"  class="btn btn-danger">DELETE</button>
                </form>
                </div>
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @endsection