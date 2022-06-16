@extends('layout.template')
@section('main')
    <h1>Gestion des formations</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Numéro de marché</th>
                <th>Numéro de convention</th>
                <th>Centre</th>
                <th>&nbsp;</th>
                <th><a href="{{ route('Formation.create') }}" class="btn btn-outline-info"><i
                            class="far fa-plus-square"></i></a></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($formations as $formation)
                <tr>
                    <td>{{ $formation->nom }}</td>
                    <td>{{ (new DateTime($formation->dd))->format('d/m/Y') }}</td>
                    <td>{{ (new DateTime($formation->df))->format('d/m/Y') }}</td>
                    <td>{{ $formation->numMarche }}</td>
                    <td>{{ $formation->numConvention }}</td>
                    <td>{{ $formation->centres->nom }}</td>
                    <td><a href="{{ route('Formation.edit', $formation) }}" class="btn btn-outline-warning btn-block"><i
                                class="far fa-edit"></i></a></td>
                    <td>
                        <button class="btn btn-outline-danger btn-block delete" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{ $formation->id }}"><i class="far fa-trash-alt"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalDelete{{ $formation->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form name="DeleteFormaion" method="POST"
                                        action="{{ route('Formation.destroy', $formation) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer une formation</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger" role="alert">
                                                Êtes-vous sûre de vouloir supprimer la formation {{ $formation->nom }} ?
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Supprimer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal -->


                        {{-- <a href="{{ route('Formation.destroy', $formation) }}"
                            class="btn btn-outline-danger btn-block delete" id="delete_{{ $formation->id }}"><i
                                class="far fa-trash-alt"></i></a> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Il n'y a pas de formation</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
