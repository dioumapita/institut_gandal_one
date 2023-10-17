{{-- on herite du chemin du theme --}}
    @extends($chemin_theme_actif,['title' => 'Emargement-Par-Niveau'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Emargement Par Classe</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Emargement</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Emargement Par Classe</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>Classe: {{ $niveau_choisit->nom_niveau.' '.$niveau_choisit->options }}</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh"
                                    href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down"
                                    href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times"
                                    href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6">
                                    <a href="{{ route('emargement.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
                                    <a href="{{ route('detail_emargement',$niveau_id) }}">
                                        <div class="btn-group">
                                            <button id="addRow1" class="btn btn-primary">
                                                Détails Emargement <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </a>
                                    <button class="btn deepPink-bgcolor  btn-outline" data-toggle="modal" data-target="#emargement">Choisir une autre classe pour émarger
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <!-- debut modal -->
                                        <div class="modal fade" data-backdrop="static" id="emargement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div  class="modal-header btn btn-danger text-center text-white">
                                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Gestions Emargements</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" class="white-text">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- start modal body -->
                                                        <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Selectionner une classe</label>
                                                                    <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id">
                                                                    <option value=""></option>
                                                                    @foreach ($all_niveaux as $key => $niveau)
                                                                        <option value="{{ route('emargement_par_niveau',$niveau) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                                {{-- <button type="submit">valider</button> --}}
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button class="btn btn-primary" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                </div>
                                                        </div>
                                                    <!-- end modal body -->
                                                </div>
                                            </div>
                                        </div>
                                    <!-- fin modal -->
                                </div>
                                <div class="pull-right col-md-6 col-sm-6 col-6">
                                    <div class="btn-group pull-right">
                                        <form action="{{ route('emargement_par_niveau',$niveau_id) }}" method="get">
                                            <label for="date_emarg">Date: </label> <input type="date" name="date_emarg" id="date_emarg" value="{{ $date_choisie->format('Y-m-d') }}"  min="{{ date('2020-12-01') }}" max="{{ date('Y-m-d') }}">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> valider</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                        id="eleves">
                                    <thead>
                                        <tr>
                                            <th> Image </th>
                                            <th> Enseignant </th>
                                            <th> Matière</th>
                                            <th>Heure Début</th>
                                            <th>Heure Fin</th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_programmes as $key => $programme)
                                            {{-- si on a pas de matiere ou si c'est égal à null on affiche rien --}}
                                            @if($programme->matiere == null)

                                            @else
                                                {{-- si la matiere n'a pas été attribuer a un enseignant elle ne s'affiche pas --}}
                                                @if (count($programme->matiere->enseigners) < 1)

                                                @else

                                                        <tr>
                                                            <td class="patient-img">
                                                                @foreach ($programme->matiere->enseigners as $enseignant)
                                                                    @if ($enseignant->niveau_id == $niveau_id)
                                                                    <img src="/images/photos/enseignants/{{ $enseignant->user->avatar }}"
                                                                        alt="profil_enseignant">
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach ($programme->matiere->enseigners as $enseignant)
                                                                    @if ($enseignant->niveau_id == $niveau_id)
                                                                        {{ $enseignant->user->nom.' '.$enseignant->user->prenom }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                {{ $programme->matiere->nom_matiere }}
                                                            </td>
                                                            <form action="{{ route('emargement.store') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="date_choisie" value="{{ $date_choisie }}">
                                                                <input type="hidden" name="matiere_id" value="{{ $programme->matiere->id }}">
                                                                <input type="hidden" name="niveau_id" value="{{ $niveau_id }}">
                                                                @foreach ($programme->matiere->enseigners as $enseignant)
                                                                    <input type="hidden" name="user_id" value="{{ $enseignant->user->id }}">
                                                                @endforeach
                                                                <td>
                                                                    <input type="time" name="heure_debut"  value="{{ $programme->heure_debut }}" readonly="readonly">
                                                                </td>
                                                                <td>
                                                                    <input type="time" name="heure_fin" value="{{ $programme->heure_fin }}" readonly="readonly">
                                                                </td>
                                                                <td>
                                                                        <button class="btn btn-danger" type="submit"><i class="fa fa-calendar"></i> Emarger</button>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
