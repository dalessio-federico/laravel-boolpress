@extends('layouts.app')

@section('title',)

@section('content')

        <ul>
        @foreach ($user->posts as $post)
            <li> {{$post['title']}} </li>            
        @endforeach
        </ul>    

@endsection