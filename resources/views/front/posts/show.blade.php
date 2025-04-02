<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>{{$post->title}}</h1>
<h3>categorey:{{$post->category->name}}</h3>
{{-- SELECT * FROM tags WHERE id IN (SELECT tag_id FROM post_ag WHERE post_id =$post->id) --}}
{{-- Tag::whereRaw('id IN (SELECT tag_id FROM post_ag WHERE post_id =$post->id) ')->get() --}}
<p>Tags:
    <ul>
        @foreach ($post->tags as $tag)
        <li>{{$tag->name}}</li>
        @endforeach
    </ul>
</p>
<p>{{$post->content}}</p>
</body>
</html>
