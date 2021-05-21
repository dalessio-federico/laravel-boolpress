@extends('layouts.app')

@section('titolo', $post["title"])


@section('content')

    <style>
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
            text-align: center;
            padding: 50px;
        }

        .title {
            margin-bottom: 25px;
        }
        .title h2 {
            font-size: 42px;
            text-transform: uppercase;
        }
        .title h4 span {
            font-size: 12px;
        }

        .postContent {
            margin-bottom: 50px;
        }

        .timeInfo {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 50%;
        }
    </style>

    <main>
        <div class="content">
            <div class="title">
                <h2>{{ $post["title"] }}</h2>
                <h4><span>Author :</span> {{ $post->user->name }}</h4>
            </div>
            <div class="postContent">
                <p>{{ $post->content }}</p>
            </div>
            <div class="timeInfo">
                <span> Creation : {{ $post["created_at"] }}</span>
                <span>Last Update : {{ $post["updated_at"] }} </span>
            </div>
        </div>
    </main>

@endsection