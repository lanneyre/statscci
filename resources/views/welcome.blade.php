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
                {{-- <div class="form-check">
                    <input name="filtres[]" type="checkbox" value="critere" id="filtre-cri">
                    <label class="form-check-label mr-2" for="filtre-cri">
                        Critère
                    </label>
                </div>
                <div class="form-check">
                    <input name="filtres[]" type="checkbox" value="date" id="filtre-d">
                    <label class="form-check-label" for="filtre-d">
                        Date
                    </label>
                </div> --}}
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
