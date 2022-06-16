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
