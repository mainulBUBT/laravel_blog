@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="mt-4 p-5 bg-white shadow-sm rounded">
                <h1>Edit Blog</h1>
 
                <form action="{{route('blogs.update' , $post->slug)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 mt-3">
                        <label for="title">Blog Title</label>
                        <input type="text" name="title" id="" class="form-control" value="{{$post->title}}">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="title">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description">{{$post->description}}</textarea>
                    </div>
                    <div class="mb-3 mt-3 ">
                    <img src="{{url('blog_images', $post->image_path)}}" alt="" width="200px"><br>
                        <label for="title">Pick a Image</label>
                        <input type="file" name="new_image" id="" class="form-control">
                        <input type="hidden" name="image" value="{{$post->image_path}}">
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