@extends('layouts.app')

@section('title')

@section('content')
    <ul>
        @foreach ($users as $user)
            <li>
                <a href="{{ route('user.show',['id' => $user['id']]) }}"> {{ $user['name'] }}</a> 
            </li>
        @endforeach
    </ul>    

@endsection