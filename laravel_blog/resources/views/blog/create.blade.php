@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="mt-4 p-5 bg-white shadow-sm rounded">
                <h1>Create a Blog</h1>
                <!-- @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger  alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{$error}}
                </div>
                @endforeach
                @endif -->
                <ul class="alert alert-danger  alert-dismissible d-none" id="error_list">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </ul>
                <form id="postForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title">Blog Title</label>
                        <input type="text" name="title" id="blog_title" class="form-control">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="title">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3 mt-3 ">
                        <label for="title">Pick a Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection