@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<div class="push-top">
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div><br />
  @endif
  <span class="float-right"><a href="{{ route('blog.create') }}" class="btn btn-info mb-2">Add</a></span>
  <table class="table">
    <thead>
      <tr class="table-warning">
        <td>ID</td>
        <td>Title</td>
        <td>Slug</td>
        <td>Description</td>
        <td>Category</td>
        <td>Image</td>
        <td>Status</td>
        <td class="text-center">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach($blog as $blogs)
      <tr>
        <td>{{$blogs->id}}</td>
        <td>{{$blogs->title}}</td>
        <td>{{$blogs->slug}}</td>
        <td>{{$blogs->description}}</td>
        <td>{{$blogs->category->name}}</td>
        <td>
          <img src="storage/{{$blogs->image}}" alt="" width="90px">

        </td>
        <td>
          @if($blogs->status == '1')
          <span class="badge badge-success">Active</span>
          @else
          <span class="badge badge-danger">Inactive</span>
          @endif
        </td>
        <td class="text-center">
          <a href="{{ route('blog.edit', $blogs->id)}}" class="btn btn-primary btn-sm">Edit</a>
          <form action=" {{ route('blog.destroy', $blogs->id)}}" method="post" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" type=" submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
   
  </table>

  <div>
    @endsection