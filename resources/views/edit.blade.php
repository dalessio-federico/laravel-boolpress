@extends('layouts.app')

@section('titolo', "modifaca".$post["title"] )


@section('content')
<style>
    .container {
        width: 70%;
        margin: 0 auto;
    }
    .container form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container">
    <form action="{{route('post.update',['post' => $post->id])}}" method="post">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        @method('PUT')
    
        <label for="title">Titolo</label>
        <input type="text" name="title" value="{{ $post["title"] }}">
        <label for="content">Contenuto</label>
        <textarea name="content" cols="30" rows="10"> {{ $post["content"] }} </textarea>
        <input type="submit" onclick="return confirm('Sicuro di voler modificare il Post?')" value="modifica">
    </form>
</div>
@endsection