@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="mt-4 p-5 bg-white shadow-sm  rounded">
                <h1>Blog Posts</h1>
            </div>
        </div>
    </div>
    <div class="row">
    @foreach($posts as $post)
    <div class="col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        <img src="https://st.depositphotos.com/1034986/4006/i/600/depositphotos_40063631-stock-photo-beautiful-woman-at-home-writing.jpg" alt="" style="width: 200px;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h4>{{$post->title}}</h4>
                            <h6><span class="text-secondary">Posted By</span> {{$post->user->name}}</h6>
                            <p>{{$post->description}}</p>
                            <a href="" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    </div>
</div>


@endsection