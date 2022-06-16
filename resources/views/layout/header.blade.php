<div data-component="sidebar">
    <div class="sidebar">
        <ul class="list-group flex-column d-inline-block first-menu">
            <li class="list-group-item pl-3 py-2 @if ($menuActif == '') active @endif">
                <a href="{{ route('home') }}"><i class="fas fa-home" aria-hidden="true"><span
                            class="ml-2 align-left">Accueil </span></i></a>
            </li> <!-- /.list-group-item -->

            <li class="list-group-item pl-3 py-2 @if ($menuActif == 'Centre') active @endif">
                <a href="{{ route('Centre.index') }}"><i class="fa fa-university" aria-hidden="true"><span
                            class="ml-2 align-left">Centres</span></i></a>
            </li> <!-- /.list-group-item -->

            <li class="list-group-item pl-3 py-2 @if ($menuActif == 'Formation') active @endif">
                <a href="{{ route('Formation.index') }}"><i class="fa fa-graduation-cap" aria-hidden="true"><span
                            class="ml-2 align-left">Formations</span></i></a>
            </li> <!-- /.list-group-item -->

            {{-- <li class="list-group-item pl-3 py-2">
                <a href="#">
                    <i class="fa fa-check-square-o" aria-hidden="true"><span
                            class="ml-2 align-left">Critères</span></i>
                </a>
            </li> <!-- /.list-group-item --> --}}

            <li class="list-group-item pl-3 py-2">
                <a href="{{ route('export') }}"><i class="fa fa-file-excel" aria-hidden="true"><span
                            class="ml-2 align-left">Modele
                            Xlsx</span></i></a>
            </li>

            <li class="list-group-item pl-3 py-2 @if ($menuActif == 'import') active @endif">
                <a href="{{ route('import') }}"><i class="fa fa-upload" aria-hidden="true"><span
                            class="ml-2 align-left">Import</span></i></a>
            </li>

            {{-- <li class="list-group-item pl-3 py-2">
                <a href="#"><i class="fa fa-user-o" aria-hidden="true"><span
                            class="ml-2 align-left">Users</span></i></a>
                <ul class="list-group flex-column d-inline-block submenu">
                    <li class="list-group-item pl-4">
                        <a href="#" class="">Training</a>

                        <ul class="list-group flex-column d-inline-block sub-submenu">
                            <span class="arrow"></span>
                            <li class="list-group-item pl-4">
                                <a href="#">Video Tutorials</a>
                            </li>
                        </ul>

                    </li>
                    <li class="list-group-item pl-4">
                        <a href="#" class="">Tutorials</a>

                        <ul class="list-group flex-column d-inline-block sub-submenu">
                            <span class="arrow" style="top:114px;"></span>
                            <li class="list-group-item pl-4">
                                <a href="#">Help Desk</a>
                            </li>
                        </ul>

                    </li>
                    <li class="list-group-item pl-4">
                        <a href="#" class="">Ask a Question</a>

                        <ul class="list-group flex-column d-inline-block sub-submenu">
                            <span class="arrow" style="top:166px;"></span>
                            <li class="list-group-item pl-4">
                                <a href="#">Send Support Request</a>
                            </li>
                        </ul>

                    </li>
                </ul>

            </li> --}}

        </ul> <!-- /.first-menu -->
    </div> <!-- /.sidebar -->
</div>
