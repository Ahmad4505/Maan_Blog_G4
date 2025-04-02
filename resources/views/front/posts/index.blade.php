<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Posts</h1>
    <ul>
        @foreach ($posts as $post)
            {{-- <li><a href="{{route('posts.show',[$post->id])}}"></a></li> --}} {{-- laravel 8 --}}
            {{-- <li><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></li> laravel 10 --}}
            <article>
                <h3><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>
                {{-- <p>category:{{ $post->category? $post->category->name:'No Ctegory'}}</p> --}}
                <p>category:{{$post->category->name}}</p>
                {{-- $category=Category::where('id','=',$post->category_id)->first() --}}
                <p>{{ $post->content }}</p>
            </article> {{-- laravel 10 --}}
            <hr>
        @endforeach
    </ul>
</body>

</html>
