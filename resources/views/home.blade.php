@extends('layouts.app')

@section('title', 'Elenco Elementi')

@section('content')
<div class="container">

    @include('components._message_bag')

    @include('components._filter')

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
                        @if(isset($image->deleted_at))
                            <a href="{{ route('extra_image.restore', ['extraImage' => $image->id]) }}" class="btn btn-success">Restore</a>
                        @else
                            <a href="{{ route('extra_image.exclude', ['extraImage' => $image->id]) }}" class="btn btn-danger">Escludi</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(request()->routeIs('home'))
        <div class="d-flex justify-content-center mt-lg-3">
            {{ $images->links() }}
        </div>
    @endif
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
