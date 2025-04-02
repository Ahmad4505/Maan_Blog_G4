</body><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $category->name }}</h1>

    $category->posts=Post::where('category_id','=',$category->id)->get();

        @foreach ($category->posts()->get() as $post)
            <article>
                <h3>{{$post->title }}</h3>
                <p>{{$post->content }}</p>
            </article>
            <hr>
        @endforeach
</body>

</html>
