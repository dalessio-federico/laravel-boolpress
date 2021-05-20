@extends('layouts.app')

@section('titolo', "Nuovo Post")


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
    <form action="{{route('post.store')}}" method="post">
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
        @method('POST')
    
        <label for="title">Titolo</label>
        <input type="text" name="title" placeholder="Inserisci il titolo">
        <label for="content">Contenuto</label>
        <textarea name="content" cols="30" rows="10" placeholder="Metti qui il tuo contenuto"></textarea>
        <input type="submit" onclick="return confirm('Confermare la creazione?')" value="Crea Nuovo Post">
    </form>
</div>
@endsection