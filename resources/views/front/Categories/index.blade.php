<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Categories</h1>
<ul>
    @foreach ($categories as $category)
<li><a href="{{route('show',[$category->id])}}">{{$category->name}}</a></li>
    @endforeach
</ul>
</body>
</html>
