@extends('layout.template')
@section('main')
    <h1>Gestion des Centres</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Lieu</th>
                <th>&nbsp;</th>
                <th><a href="{{ route('Centre.create') }}" class="btn btn-outline-info"><i
                            class="far fa-plus-square"></i></a></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($centres as $centre)
                <tr>
                    <td>{{ $centre->nom }}</td>
                    <td>{{ $centre->lieu }}</td>
                    <td><a href="{{ route('Centre.edit', $centre) }}" class="btn btn-outline-warning btn-block"><i
                                class="far fa-edit"></i></a></td>
                    <td>
                        <button class="btn btn-outline-danger btn-block delete" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{ $centre->id }}"><i class="far fa-trash-alt"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalDelete{{ $centre->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form name="DeleteCentre" method="POST"
                                        action="{{ route('Centre.destroy', $centre) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer un centre</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger" role="alert">
                                                Êtes-vous sûre de vouloir supprimer le centre {{ $centre->nom }} ?
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
                    <td colspan="9">Il n'y a pas de centre</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
