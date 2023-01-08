@extends('layout')
@section('content')
<style>
    .container {
        max-width: 450px;
    }

    .push-top {
        margin-top: 50px;
    }
</style>
<div class="card push-top">
    <div class="card-header">
        Add Blog
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
            <div class="form-group">
                @csrf
                <label for="name">Title</label>
                <input type="text" class="form-control" name="title" />
            </div>
            <!-- <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" name="slug" />
            </div> -->
            <div class="form-group">
                <label for="phone">Description</label>
                <input type="text" class="form-control" name="description" />
            </div>
            <label for="validationCustom04">Category</label>
            <select class="custom-select color-dark" id="validationCustom04" name="category_id">
                <option  disabled >Choose...</option>
                @foreach($category as $categories)
                <option value="{{$categories->id}}">{{ $categories->name }}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label for="password">Image</label>
                <input type="file" class="form-control" name="image" />
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio"  name="status" id="exampleRadios1" value="1" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Active
                </label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio"  name="status" id="exampleRadios2" value="0">
                <label class="form-check-label" for="exampleRadios2">
                    Inactive
                </label>
            </div>
            <button type="submit" class="btn btn-block btn-danger">Create Blog</button>
        </form>
    </div>
</div>
@endsection