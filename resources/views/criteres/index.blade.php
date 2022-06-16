@extends('layout.template')
@section('main')
    <h1>Gestion des Critères</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>&nbsp;</th>
                <th><a href="{{ route('Critere.create') }}" class="btn btn-outline-info"><i
                            class="far fa-plus-square"></i></a></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($criteres as $critere)
                <tr>
                    <td>{{ $critere->nom }}</td>
                    <td><a href="{{ route('Critere.edit', $critere) }}" class="btn btn-outline-warning btn-block"><i
                                class="far fa-edit"></i></a></td>
                    <td>
                        <button class="btn btn-outline-danger btn-block delete" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{ $critere->id }}"><i class="far fa-trash-alt"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalDelete{{ $critere->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form name="DeleteCritere" method="POST"
                                        action="{{ route('Critere.destroy', $critere) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer un critère</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger" role="alert">
                                                Êtes-vous sûre de vouloir supprimer le critère {{ $critere->nom }} ?
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
                    <td colspan="9">Il n'y a pas de critère</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
