@extends('layout.template')
@section('main')
    <form action="{{ route('search') }}" method="post" class="search">
        @csrf
        <fieldset class="filtre">
            <legend>Filtres principaux</legend>
            <section>
                <div class="form-check">
                    <input name="filtres[]" type="checkbox" value="Formations" id="filtre-f"
                        @if (empty(Request::input('filtres')) || in_array('Formations', Request::input('filtres'))) checked @endif>
                    <label class="form-check-label" for="filtre-f">
                        Formation
                    </label>
                </div>
                <div class="form-check filtresFormations"
                    @if (empty(Request::input('filtres')) || in_array('Formations', Request::input('filtres'))) style="display: flex" @else style="display: none" @endif>
                    <input name="filtresFormations" type="checkbox" value="allFormations" id="filtre-all-f"
                        @if (!empty(Request::input('filtresFormations'))) checked @endif>
                    <label class="form-check-label" for="filtre-all-f">
                        Regrouper les formations
                    </label>
                </div>
                <div class="form-check">
                    <input name="filtres[]" type="checkbox" value="Centres" id="filtre-c"
                        @if (empty(Request::input('filtres')) || in_array('Centres', Request::input('filtres'))) checked @endif>
                    <label class="form-check-label" for="filtre-c">
                        Centre
                    </label>
                </div>
                <div class="form-check">
                    <input name="filtres[]" type="checkbox" value="Lieux" id="filtre-l"
                        @if (empty(Request::input('filtres')) || in_array('Lieux', Request::input('filtres'))) checked @endif>
                    <label class="form-check-label" for="filtre-l">
                        Lieu
                    </label>
                </div>
            </section>
            <section id="filtresAllFormations"
                @if (empty(Request::input('filtresFormations'))) style="display: none" @else style="display: flex" @endif>
                @foreach ($distinctFormations as $df)
                    <div class="form-check">
                        <input name="distinctFormations[]" type="checkbox" value="{{ $df->nom }}"
                            id="form-{{ Str::slug($df->nom) }}" @if (empty(Request::input('distinctFormations')) || in_array($df->nom, Request::input('distinctFormations'))) checked @endif>
                        <label class="form-check-label" for="form-{{ Str::slug($df->nom) }}">
                            {{ $df->nom }}
                        </label>
                    </div>
                @endforeach
            </section>
            <section class="row">
                <label class="form-check-label col-12 text-center" for="datedds">
                    Dates (laissez vide pour tout afficher)
                </label>
                <div class="d-flex justify-content-around row date">
                    <div class="input-group col-5">
                        <span class="input-group-text" id="datedd">Du</span>
                        <input name="datedd" type="date" class="form-control" aria-label="datedd"
                            aria-describedby="datedd" value="{{ Request::input('datedd') }}">
                    </div>
                    <div class="input-group col-5">
                        <span class="input-group-text" id="datedf">Au</span>
                        <input name="datedf" type="date" class="form-control" aria-label="datedf"
                            aria-describedby="datedf" value="{{ Request::input('datedf') }}">
                    </div>
                </div>
            </section>
        </fieldset>
        <fieldset class="colonnes">
            <legend>Colonnes</legend>
            <section>
                @forelse ($allcriteres as $critere)
                    <div class="form-check">
                        <input name="criteres[]" type="checkbox" value="{{ $critere->id }}"
                            id="critere-{{ $critere->id }}" @if (empty(Request::input('criteres')) || in_array($critere->id, Request::input('criteres'))) checked @endif>
                        <label class="form-check-label" for="critere-{{ $critere->id }}">
                            {{ $critere->nom }}
                        </label>
                    </div>
                @empty
                    <p>Pas de critères</p>
                @endforelse
            </section>
        </fieldset>
        <fieldset class="btn">

            <button type="reset" class="btn btn-outline-dark">Reset</button>

            <button type="submit" class="btn btn-success">Afficher</button>
        </fieldset>
    </form>

    <section class="result">
        <table class="table table-striped">
            @for ($i = 0; $i < count($arraySearch); $i++)
                <tr @if (!empty($arraySearch[$i]['total']) && $arraySearch[$i]['total'] == 'Totaux') class="totaux" @endif>
                    @foreach ($arraySearch[$i] as $colonne)
                        <td
                            @if (count($arraySearch[$i]) == 1) class="section" colspan="{{ count($arraySearch[0]) }}" @endif>
                            {{ $colonne }}</td>
                    @endforeach
                </tr>
            @endfor
        </table>
    </section>
@endsection
