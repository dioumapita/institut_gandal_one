@extends($chemin_theme_actif,['title' => 'Show-Emprunt'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Détail Des Prêts D'un Adhérent</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Adhérent</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Détail Des Prêts D'un Adhérent</li>
        </ol>
    </div>
</div>
<a href="{{ route('emprunteur.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
<br><br>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
    <div class="profile-sidebar">
        <div class="card">
            <div class="card-head card-topline-aqua">
                <header>Informations De L'adhérent</header>
            </div>
            <div class="card-body no-padding height-9">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Nom:{{ $adherent->nom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Prénom: {{ $adherent->prenom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Quartier:{{ $adherent->quartier }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Contact: {{ $adherent->contact }}</b>
                    </li>
                </ul>
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modifier">Modifier
                    <i class="fa fa-edit"></i>
                </button>
                <!-- debut modal -->
                    <div class="modal fade" data-backdrop="static" id="modifier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div  class="modal-header btn btn-danger text-center text-white">
                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification Des Informations</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="white-text">&times;</span>
                                    </button>
                                </div>
                                <!-- start modal body -->
                                    <div class="modal-body">
                                        <form action="{{ route('emprunteur.update',$adherent->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group">
                                                <label for="nom">Nom</label>
                                                <input type="text" name="nom" id="nom" class="form-control" value="{{ $adherent->nom }}" placeholder="Entrez le nom" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="prenom">Prénom </label>
                                                <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $adherent->prenom }}" placeholder="Entrez le prenom" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="quartier">Quartier</label>
                                                <input type="text" name="quartier" id="quartier" class="form-control" value="{{ $adherent->quartier }}" placeholder="Entrez le quartier">
                                            </div>
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input type="tel" name="contact" id="contact" class="form-control" value="{{ $adherent->contact}}" placeholder="Entrez le contact">
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
        </div>
    </div>
<!-- END BEGIN PROFILE SIDEBAR -->

        <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>Informations sur les prêts</header>
                        </div>
                        <div class="white-box">
                            <div>
                                <div class="row">
                                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#nouveau">Nouveau Prêt</button>
                                    &nbsp;&nbsp;
                                </div>
                                <br>
                                <div class="row">

                                </div>
                            </div>
                                <div class="table-scrollable mt-5">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">N°</th>
                                                <th class="text-center">Isbn</th>
                                                <th class="text-center">Livre</th>
                                                <th class="text-center">Date D'emprunt</th>
                                                <th class="text-center">Date D'expiration</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($adherent->emprunts as $emprunt)
                                                <tr>
                                                    <td class="text-center">{{ $i++ }}</td>
                                                    <td class="text-center">{{ $emprunt->livre->isbn }}</td>
                                                    <td class="text-center">{{ $emprunt->livre->titre }}</td>
                                                    <td class="text-center">{{ $emprunt->date_debut->format('d/m/Y') }}</td>
                                                    <td class="text-center">{{ $emprunt->date_fin->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($emprunt->status == 0)
                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modif_emprunt{{ $emprunt->id }}">Modifier</button>
                                                            <div class="modal fade" data-backdrop="static" id="modif_emprunt{{ $emprunt->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div  class="modal-header btn btn-danger text-center text-white">
                                                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification Des Informations</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true" class="white-text">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- start modal body -->
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('emprunteur.update',$emprunt->id) }}" method="post">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('PUT') }}
                                                                                <div class="form-group">
                                                                                    <label for="livre_id">Livre</label>
                                                                                    <select  name="livre_id" id="livre_id" class="form-control select2" required>
                                                                                    <option value="">Sélectionnez un Livre</option>
                                                                                        @foreach ($all_livres as $livre)
                                                                                            <option value="{{ $livre->id }}" @if($livre->id == $emprunt->livre_id) selected @endif>{{ 'ISBN: '.$livre->isbn.' Titre: '.$livre->titre.' Auteur: '.$livre->auteur->nom.' '.$livre->auteur->prenom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="date_debut">Date D'emprunt</label>
                                                                                    <input id="date_debut" type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $emprunt->date_debut->format('Y-m-d') }}" placeholder="Entrez la date de debut d'abonnement" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="date_fin">Date D'expiration</label>
                                                                                    <input id="date_fin" type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $emprunt->date_fin->format('Y-m-d') }}" placeholder="Entrez la date d'expiration" required>
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
                                                            <form action="{{ route('emprunteur.update',$emprunt->id) }}" method="post" style="display:inline">
                                                                {{ csrf_field() }}
                                                                {{ method_field('PUT') }}
                                                                <input type="hidden" name="status_livre" value="1">
                                                                <button type="submit" class="btn btn-danger">Rendre Le Livre</button>
                                                            </form>
                                                        @else
                                                            <a href="#" class="btn btn-primary">Livre Rendu</a>
                                                            <form action="{{ route('emprunteur.update',$emprunt->id) }}" method="post" style="display:inline">
                                                                {{ csrf_field() }}
                                                                {{ method_field('PUT') }}
                                                                <input type="hidden" name="status_livre" value="0">
                                                                <button type="submit" class="btn btn-danger">Annuler</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h3>
                                         <u>Nbre De Livre Emprunter:</u> {{ $adherent->emprunts->count() }}<br>
                                         <u>Nbre De Livre Rendu:</u> {{ $adherent->emprunts->where('status',1)->count() }}<br>
                                         <u>Reste à Rendre:</u> {{ $adherent->emprunts->where('status',0)->count() }}
                                    </h3>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- code nouveau prêt de livre -->
<!-- debut modal -->
<div class="modal fade" data-backdrop="static" id="nouveau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div  class="modal-header btn btn-danger text-center text-white">
            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Nouveau Prêt</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
            </button>
        </div>
        <!-- start modal body -->
            <div class="modal-body">
                <form action="{{ route('emprunteur.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="emprunteur_id" value="{{ $adherent->id }}">
                    <div class="form-group">
                        <label for="livre_id">Livre</label>
                        <select  name="livre_id" id="livre_id" class="form-control select2" required>
                          <option value="">Sélectionnez un Livre</option>
                            @foreach ($all_livres as $livre)
                                @if($livre->nbre_examplaire > $livre->emprunts->where('status',0)->count())
                                    <option value="{{ $livre->id }}">{{ 'ISBN: '.$livre->isbn.' Titre: '.$livre->titre.' Auteur: '.$livre->auteur->nom.' '.$livre->auteur->prenom }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_debut">Date D'emprunt</label>
                        <input id="date_debut" type="date" name="date_debut" id="date_debut" class="form-control" value="{{ old('date_debut')}}" placeholder="Entrez la date de debut d'abonnement" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date D'expiration</label>
                        <input id="date_fin" type="date" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin')}}" placeholder="Entrez la date d'expiration" required>
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
<script>
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
</script>
@endsection
