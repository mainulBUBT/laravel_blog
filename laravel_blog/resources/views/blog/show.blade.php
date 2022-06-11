@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="mt-4 p-5 bg-white shadow-sm rounded">
                <h1 class="text-center">{{$post->title}}</h1>
                <span style="display:block; text-align: center;">Posted By: {{$post->user->name}} ,
                    <span>Published On: {{ date('jS M Y', strtotime($post->created_at)) }}</span>
                    <hr>
                </span>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{url('blog_images', $post->image_path)}}" alt="" style="width: 300px;">
                        <div class="d-grid gap-2">
                        @if(isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                        <a href="{{route('blogs.edit', $post->slug)}}" class="btn btn-primary mt-5">Edit Blog</a>
                        <a href="{{route('blogs.destroy', $post->slug)}}" class="btn btn-danger">Delete Blog</a>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="text-left">{{$post->description}}</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection