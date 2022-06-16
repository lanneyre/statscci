@extends('layout.template')
@section('main')
    <h1>Gestion des centres - Ajout</h1>
    <form method="POST" action="{{ route('Centre.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du centre"
                        value="{{ old('nom') }}">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" id="lieu" value="{{ old('lieu') }}"
                        placeholder="Ville du centre">
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
