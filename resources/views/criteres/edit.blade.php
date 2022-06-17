@extends('layout.template')
@section('main')
    <h1>Gestion des critères - Edit</h1>
    <form method="POST" action="{{ route('Critere.update', $critere) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du critere"
                        value="{{ $critere->nom }}">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <h2>Formations</h2>
            {{-- on rajoute les critères --}}

            @forelse ($formations as $formation)
                <div class="col-4">
                    <div class="mb-3">
                        <label for="formation{{ $formation->id }}" class="form-label">{{ $formation->nom }}</label>
                        <input type="number" name="formation[{{ $formation->id }}]" class="form-control"
                            id="formation{{ $formation->id }}"
                            value="{{ isset($formationsCritere[$formation->id]) ? $formationsCritere[$formation->id] : 0 }}"
                            min="0">
                    </div>
                </div>
            @empty
                Il n'y a pas de formation
            @endforelse
        </div>
        <div class="col-3">

            <label for="btn" class="form-label">&nbsp;</label>
            <div class="row">
                <div class="col"><button type="submit" id="btn"
                        class="btn btn-primary form-control">Submit</button></div>
                <div class="col"><button type="reset" id="btn"
                        class="btn btn-secondary form-control">Reset</button></div>
            </div>


        </div>
    </form>
@endsection
