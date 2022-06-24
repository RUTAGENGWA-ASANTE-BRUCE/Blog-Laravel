<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    
</body>
</html>

@extends('layouts.app')

@section('content')

<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{route('posts')}}" method="post" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">{{$message}}</div>
                @enderror
            </div>

            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
            </div>
        </form>

        @if($posts->count())
            @foreach($posts as $post)
            <div class="mb-4">
                <a href="{{route('users.posts',$post->user)}}" class="font-bold">
                    {{$post->user->name}}
                </a>
                <span class="text-gray-500 text-sm">{{$post->created_at->diffForHumans()}}</span>
                <p class="mb-1">{{$post->body}}</p>
                @can("delete",$post)
                <div>
                    <form action="{{route('posts.destroy',$post)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="text-blue-500" type="submit">Delete</button>
                    </form>
                </div>
                @endcan
                <div class="flex text-center">
                    @if(!$post->likedBy(auth()->user()))
                    <form action="{{route('posts.likes',$post->id)}}" method="post" class="mr-1">
                        @csrf
                        <button class="text-blue-500">Like</button>
                    </form>
                    @else   
                    <form action="{{route('posts.likes',$post->id)}}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="text-blue-500">Unlike</button>
                </form>
                <span>{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}}</span>
                @endif
            </div>
            </div>
            
            @endforeach
            {{$posts->links()}}
        @else
        <p>There no posts </p>
        @endif
    </div>
</div>
@endsection
