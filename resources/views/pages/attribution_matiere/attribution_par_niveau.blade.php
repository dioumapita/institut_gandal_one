{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Attribution-Matiere-Par-Classe'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Attribution de matière aux enseignants par classe</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Attribution De Matière</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Attribution de matière aux enseignants par classe</li>
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
                            <div class="col-md-12 col-sm-12 col-12">
                                <a href="{{ route('attribution.index') }}" class="btn btn-info">
                                    <i class="fa fa-reply"></i> Retour
                                </a>
                                &nbsp;
                                <a href="{{ route('enseignant_matiere_niveau',$niveau_id) }}">
                                    <div class="btn-group">
                                        <button id="addRow1" class="btn btn-primary">
                                            <i class="fa fa-list"></i> Détails Attribution Matière
                                        </button>
                                    </div>
                                </a>
                                &nbsp;
                                <a href="{{ route('enseigne_niveau.show',$niveau_id) }}" class="btn btn-primary">
                                    <i class="fa fa-list"></i> Détails Attribution Classe
                                </a>
                                &nbsp;
                                <button id="addRow1" class="btn btn-primary" data-toggle="modal" data-target="#modalchangeclasse">
                                    Choisir une autre classe  <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal choix de classe -->
                                    <div class="modal fade" data-backdrop="static" id="modalchangeclasse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Choisir Une Autre Classe</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                        <form action="{{ route('saisie_note_mode_multiple') }}" method="GET">
                                                            <div class="form-group">
                                                                <label for="niveau">Selectionnez une classe</label>
                                                                <select onchange="window.location.href = this.value" id="niveau" class="form-control" name=niveau>
                                                                    <option value=""></option>
                                                                    @foreach ($all_niveaux as $key => $niveau)
                                                                        <option value="{{ route('attribution_de_matiere_par_niveau',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="submit" class="btn btn-primary">Valider <i class="fa fa-check"></i></button>
                                                                <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <!-- end modal body -->
                                            </div>
                                        </div>
                                    </div>
                                <!-- fin modal choix de classe -->
                            </div>
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                        id="eleves">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> Image </th>
                                            <th> Enseignant </th>
                                            <th class="text-center"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_enseignant as $key => $enseignant)
                                            <tr>
                                                <td class="patient-img">
                                                    <img src="/images/photos/enseignants/{{ $enseignant->avatar }}"
                                                        alt="profil_enseignant">
                                                </td>
                                                <td>
                                                    {{ $enseignant->nom.' '.$enseignant->prenom }}
                                                </td>
                                                <td>

                                                    <div class="">
                                                        <button class="btn deepPink-bgcolor" data-toggle="modal" data-target="#classes{{ $enseignant->id }}">Attribuer Une Ou Plusieurs Matières
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                        <!-- debut modal -->
                                                            <div class="modal fade" data-backdrop="static" id="classes{{ $enseignant->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Attributions De Matières</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <!-- start modal body -->
                                                                            <div class="modal-body">
                                                                                <div class="center">
                                                                                    <img src="/images/photos/enseignants/{{ $enseignant->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>

                                                                                <h4 class="media-heading">
                                                                                    {{ $enseignant->nom.' '.$enseignant->prenom }}
                                                                                </h4>
                                                                            </div>
                                                                                <form action="{{ route('attribution.store') }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="user_id" value="{{ $enseignant->id }}">
                                                                                    <input type="hidden" name="niveau_id" value="{{ $niveau_id }}">
                                                                                    <div class="form-group">
                                                                                        <label for="">Selectionnez une matière</label>
                                                                                        <select id="matiere" name="matiere[]" class="form-control select2-multiple @error('matiere')is-invalid @enderror" multiple>
                                                                                            <option value="">Selectionner...</option>
                                                                                            @foreach ($all_matiere as $matiere)
                                                                                                <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @error('matiere')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="prix_heure">Prix Par Heure</label>
                                                                                        <input type="number" name="prix_heure" id="prix_heure" class="form-control" placeholder="prix par heure" required>
                                                                                    </div>
                                                                                    <div class="modal-footer d-flex justify-content-center">
                                                                                        <button type="submit" class="btn btn-primary" >Valider <i class="fa fa-check"></i></button>
                                                                                        &nbsp;&nbsp;
                                                                                        <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        <!-- end modal body -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- fin modal -->
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#attribution_classe{{ $enseignant->id }}">Attribuer la classe à l'enseignant
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                        <!-- debut modal -->
                                                            <div class="modal fade" data-backdrop="static" id="attribution_classe{{ $enseignant->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div  class="modal-header btn btn-primary text-center text-white">
                                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Attributions De Classe</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <!-- start modal body -->
                                                                            <div class="modal-body">
                                                                                <div class="center">
                                                                                    <img src="/images/photos/enseignants/{{ $enseignant->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>

                                                                                <h4 class="media-heading">
                                                                                    {{ $enseignant->nom.' '.$enseignant->prenom }}<br>
                                                                                    {{-- Voulez-vous attribuer cette classe à l'enseignant ??? --}}
                                                                                </h4>
                                                                            </div>
                                                                                <form action="{{ route('enseigne_niveau.store') }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="user_id" value="{{ $enseignant->id }}">
                                                                                    <input type="hidden" name="niveau_id" value="{{ $niveau_id }}">
                                                                                    <div class="form-group">
                                                                                        <label for="salaire">Salaire</label>
                                                                                        <input type="number" name="salaire" id="salaire" class="form-control" placeholder="salaire de l'enseignant" required>
                                                                                    </div>
                                                                                    <div class="modal-footer d-flex justify-content-center">
                                                                                        <button type="submit" class="btn btn-primary" >Valider <i class="fa fa-check"></i></button>
                                                                                        &nbsp;&nbsp;
                                                                                        <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        <!-- end modal body -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- fin modal -->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
