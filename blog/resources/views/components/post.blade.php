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
