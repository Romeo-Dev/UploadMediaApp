@extends('layouts.app')

@section('title', 'Elenco Elementi')

@section('content')
<div class="container">

    {{-- Form di Filtri --}}
    <form method="GET" action="{{ '#' }}" class="row mb-4 align-images-end">
        <div class="col-md-4">
            <label for="search" class="form-label">Cerca</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="Cerca per titolo o descrizione...">
        </div>

        <div class="col-md-3">
            <label for="sort" class="form-label">Ordina per</label>
            <select name="sort" id="sort" class="form-select">
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titolo</option>
                <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Data</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label d-block">Mostra esclusi</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="deleted" name="deleted" value="1" {{ request('deleted') ? 'checked' : '' }}>
                <label class="form-check-label" for="deleted">Soft deleted</label>
            </div>
        </div>

        <div class="col-md-2 text-end">
            <button type="submit" class="btn btn-primary w-100">Filtra</button>
        </div>
    </form>

    <div class="d-flex justify-content-end mb-3">
        <button id="toggleView" class="btn btn-outline-secondary">
            <i class="bi bi-grid-fill"></i> Cambia vista
        </button>
    </div>

    <div id="imagesContainer" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($images as $image)
            @php
                $media = $image->getFirstMedia('images')
            @endphp
            <div class="col image-card">
                <div class="card h-100">
                    <img src="{{ $image->getFirstMediaUrl('images') }}" class="card-img-top" alt="{{ $image->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->title }}</h5>
                        <p class="card-text text-muted">{{ $image->created_at->format('d/m/Y') }}</p>
                        <p class="card-text">file_name : {{ $media->file_name ?? '' }}</p>
                        <p class="card-text">estensione : {{ $media->extension ?? ''}}</p>
                        <p class="card-text">dimensione : {{ $media->size ?? '' }}</p>
                        <a href="{{ '' }}" class="btn btn-danger">Escludi</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@push('scripts')
<script>
    document.getElementById('toggleView').addEventListener('click', function () {
        const container = document.getElementById('imagesContainer');
        container.classList.toggle('row-cols-1');
        container.classList.toggle('row-cols-md-1');
        container.classList.toggle('row-cols-md-2');
        container.classList.toggle('row-cols-lg-3');
    });
</script>
@endpush
@endsection
