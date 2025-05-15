@extends('layouts.app')

@section('title', 'Crea Nuovo Elemento')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('components._message_bag')

    <h1 class="mb-4">Carica immagine</h1>

    <form action="{{ route('extra_image.upload') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Carica File</label>
            <input type="file" name="file" id="file" class="form-control" accept="image/*" required>
            <div class="form-text">File deve essere un immagine di massimo 2MB</div>
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>
@endsection
