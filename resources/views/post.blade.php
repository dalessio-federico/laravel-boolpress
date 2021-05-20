@extends('layouts.app')

@section('links')
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('titolo', "Posts List")

@section('content')
    <style>
        .example {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin-top: 110px;
        }

        .styled-table {
            height: 70%;
            width: 60%;
            margin-top: 240px;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        .styled-table a {
            color: #636b6f;
            text-decoration: none;
        }

        .styled-table i:hover {
            cursor: pointer;
        }
        
        
        .editButton,
        .deleteButton {
            display: inline-block;
        }

        .editButton {
            margin-right: 10px;
        }

        .deleteButton button {
            background-color: #00000000;
            border: none;
        }
    </style>
        <div class="example">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Post send by</th>
                        <th>Post Update</th>
                        <th>Post Creation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td> 
                            <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                {{ $post["title"] }}
                            </a>
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post["updated_at"] }}</td>
                        <td>{{ $post["created_at"] }}</td>
                        <td>
                            <div class="editButton">
                                <a href="{{ route('post.edit', ['post' => $post->id]) }}">
                                    <button>Edit</button>
                                </a>
                            </div>
                            <div class="deleteButton">
                                <form action="{{route('post.destroy',['post' => $post->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Sei sicuro di Cancellare il Post?')"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection