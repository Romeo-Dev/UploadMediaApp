<form method="GET" action="{{ route('extra_image.filter') }}" class="row mb-4 align-images-end">
    @csrf
    <div class="col-md-4">
        <label for="search" class="form-label">Cerca</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="Cerca per titolo o descrizione...">
    </div>

    <div class="col-md-3">
        <label for="sort" class="form-label">Ordina per</label>
        <select name="sort" id="sort" class="form-select">
            <option value="casual" {{ request('sort') == 'casual' ? 'selected' : '' }}>Casuale</option>
            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titolo</option>
            <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Data</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label d-block">Mostra esclusi</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="is_deleted" name="is_deleted" value="1" {{ request('is_deleted') ? 'checked' : '' }}>
            <label class="form-check-label" for="deleted">Soft deleted</label>
        </div>
    </div>

    <div class="col-md-2 text-end">
        <button type="submit" class="btn btn-primary w-100">Filtra</button>
    </div>
</form>

