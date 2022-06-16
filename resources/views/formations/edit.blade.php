@extends('layout.template')
@section('main')
    <h1>Gestion des formations</h1>
    <form method="POST" action="{{ route('Formation.update', $formation->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom de la formation"
                        value="{{ $formation->nom }}">
                </div>
                <div class="mb-3">
                    <label for="numMarche" class="form-label">Numéro de marché</label>
                    <input type="text" class="form-control" name="numMarche" id="numMarche" placeholder="Numéro de marché"
                        value="{{ $formation->numMarche }}">
                </div>
                <div class="mb-3">
                    <label for="numConvention" class="form-label">Numéro de convention</label>
                    <input type="text" class="form-control" name="numConvention" id="numConvention"
                        placeholder="Numéro de convention" value="{{ $formation->numConvention }}">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="dd" class="form-label">Date de début</label>
                    <input type="date" name="dd" class="form-control" id="dd" value="{{ $formation->dd }}">
                </div>
                <div class="mb-3">
                    <label for="df" class="form-label">Date de fin</label>
                    <input type="date" name="df" class="form-control" id="df" value="{{ $formation->df }}">
                </div>
                <div class="mb-3">

                    <label for="btn" class="form-label">Centre</label>
                    <select name="centre_id" id="centre_id" class="form-select">
                        @forelse ($centres as $centre)
                            <option value="{{ $centre->id }}" @if ($centre->id == $formation->centres()->first()->id) selected @endif>
                                {{ $centre->nom }}</option>
                        @empty
                            <option value="0" disabled selected>-- Il n'y a aucun centre --</option>
                        @endforelse
                    </select>


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
