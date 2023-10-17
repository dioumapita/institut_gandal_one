{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Show-Credit-Enseignant'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Historique Des Crédits D'un Enseignant</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Crédit</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Historique Des Crédits D'un Enseignant</li>
            </ol>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
   <br><br>
    <div id="media_screen" class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <div class="card">
                <div class="card-head card-topline-aqua">
                    <header>Informations De L'enseignant</header>
                </div>
                <div class="card-body no-padding height-9">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nom: {{ $enseignant->nom}}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Prénom: {{ $enseignant->prenom }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Quartier: {{ $enseignant->adresse }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Téléphone: {{ $enseignant->telephone}}</b>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- END BEGIN PROFILE SIDEBAR -->

            <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div>
                        <div class="card">
                            <div class="card-head card-topline-aqua">
                                <header>Historique Des Crédits Et Remboursement D'un Enseignant</header>
                            </div>
                            <div class="white-box">
                                    <div class="table-scrollable mt-5">
                                        <h3 class="text-center"><u>Historique Des Bons D'un Enseignant</u></h3>
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                >
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Montant Crédit </th>
                                                    <th class="text-center"> Motif</th>
                                                    <th class="text-center"> Mois</th>
                                                    <th class="text-center"> Date </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enseignant->creditEnseignants->where('type_de_credit','Bon') as $credit)
                                                    @if($credit->somme_credit != null)
                                                        <tr class="odd gradeX">
                                                            <td class="text-center" style="width: 20%">
                                                                {{ number_format($credit->somme_credit,0,',',' ').' GNF' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $credit->motif }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($credit->mois_remboursement == 1)
                                                                        {{ "Janvier" }}
                                                                    @elseif($credit->mois_remboursement == 2)
                                                                        {{ "Février" }}
                                                                    @elseif($credit->mois_remboursement == 3)
                                                                        {{ "Mars" }}
                                                                    @elseif($credit->mois_remboursement == 4)
                                                                        {{ "Avril" }}
                                                                    @elseif($credit->mois_remboursement == 5)
                                                                        {{ "Mai" }}
                                                                    @elseif($credit->mois_remboursement == 6)
                                                                        {{ "Juin"}}
                                                                    @elseif($credit->mois_remboursement == 7)
                                                                        {{ "Juillet" }}
                                                                    @elseif($credit->mois_remboursement == 8)
                                                                        {{ "Août" }}
                                                                    @elseif($credit->mois_remboursement== 9)
                                                                        {{ "Septembre" }}
                                                                    @elseif($credit->mois_remboursement == 10)
                                                                        {{ "Octobre" }}
                                                                    @elseif($credit->mois_remboursement == 11)
                                                                        {{ "Novembre" }}
                                                                    @else
                                                                        {{ "Décembre" }}
                                                                    @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $credit->date_credit->format('d/m/Y') }}
                                                            </td>
                                                            <td>

                                                                <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $credit->id }}">
                                                                    <i class="fa fa-pencil"></i> Modifier
                                                                </a>
                                                                <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $credit->id }})"
                                                                    class="btn btn-danger">
                                                                    <i class="fa fa-trash"></i> Supprimer
                                                                </a>
                                                                <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                    <div class="mt-5 modal-dialog modal-confirm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header flex-column">
                                                                                <div class="icon-box">
                                                                                    <i class="material-icons">&#xE5CD;</i>
                                                                                </div>
                                                                                <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>
                                                                                    Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-center">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                                <form action="{{ route('Credit.destroy',$credit->id) }}" method="post" id="deleteform">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('DELETE') }}
                                                                                    <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                        Oui Supprimer
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="container">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="myModal{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                    <h4 class="modal-title text-center" id="myModalLabel">Modification Du Bon D'un Enseignant</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="center">
                                                                                        <img src="/images/photos/enseignants/{{ $credit->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                        <h4 class="media-heading">{{ $credit->user->nom.' '.$credit->user->prenom }}
                                                                                            <br>
                                                                                        </h4>
                                                                                    </div>
                                                                                        <form action="{{ route('Credit.update',$credit->id) }}" method="post">
                                                                                            {{ csrf_field() }}
                                                                                            {{ method_field('PUT') }}
                                                                                            <input type="hidden" name="user_id" value="{{ $credit->user->id }}">
                                                                                            {{-- <input type="hidden" name="type_de_credit" value="{{ $credit->type_de_credit }}"> --}}
                                                                                            {{-- <input type="hidden" name="salaire_a_payer" value="{{ $paiement->user->emargements->sum('gains')  }}"> --}}
                                                                                            <div class="form-group">
                                                                                                <label for="montant">Montant Credit *</label>
                                                                                                <input type="number"
                                                                                                class="form-control" name="montant_credit" id="montant_credit" value="{{ $credit->somme_credit }}" aria-describedby="helpId" placeholder="Entrez le montant crédit" required>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="motif">Motif *</label>
                                                                                                <input type="text"
                                                                                                class="form-control" name="motif" id="motif" value="{{ $credit->motif }}"  aria-describedby="helpId" placeholder="Entrez le motif du crédit" required  />
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="mois_remboursement">Selectionner le mois</label>
                                                                                                <select  class="form-control" name="mois_remboursement" id="mois_remboursement">
                                                                                                <option value="">Selectionnez le mois</option>
                                                                                                    <option value="1" @if($credit->mois_remboursement == 1) selected @endif>Janvier</option>
                                                                                                    <option value="2" @if($credit->mois_remboursement == 2) selected @endif>Fevrier</option>
                                                                                                    <option value="3" @if($credit->mois_remboursement == 3) selected @endif>Mars</option>
                                                                                                    <option value="4" @if($credit->mois_remboursement == 4) selected @endif>Avril</option>
                                                                                                    <option value="5" @if($credit->mois_remboursement == 5) selected @endif>Mai</option>
                                                                                                    <option value="6" @if($credit->mois_remboursement == 6) selected @endif>Juin</option>
                                                                                                    <option value="7" @if($credit->mois_remboursement == 7) selected @endif>Juillet</option>
                                                                                                    <option value="8" @if($credit->mois_remboursement == 8) selected @endif>Août</option>
                                                                                                    <option value="9" @if($credit->mois_remboursement == 9) selected @endif>Septembre</option>
                                                                                                    <option value="10" @if($credit->mois_remboursement == 10) selected @endif>Octobre</option>
                                                                                                    <option value="11" @if($credit->mois_remboursement == 11) selected @endif>Novembre</option>
                                                                                                    <option value="12" @if($credit->mois_remboursement == 12) selected @endif>Décembre</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="montant">Date *</label>
                                                                                                <input type="date"
                                                                                                class="form-control" name="date_credit" id="date_credit" value="{{ $credit->date_credit->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
                                                                                            </div>
                                                                                            <br>
                                                                                            <div class="container center">
                                                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                            </div>
                                                                                        </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h3><u>Total Bon:</u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Bon')->sum('somme_credit'),0,',',' ').' GNF' }}</h3>

                                        <h3 class="text-center"><u>Remboursement Des Bons D'un Enseignant</u></h3>
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                >
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Montant Rembourser </th>
                                                    <th class="text-center"> Mois</th>
                                                    <th class="text-center"> Date </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enseignant->creditEnseignants->where('type_de_credit','Bon') as $credit)
                                                    @if($credit->somme_rembourser != null)
                                                        <tr class="odd gradeX">
                                                            <td class="text-center" style="width: 20%">
                                                                {{ number_format($credit->somme_rembourser,0,',',' ').' GNF' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($credit->mois_remboursement == 1)
                                                                    {{ "Janvier" }}
                                                                @elseif($credit->mois_remboursement == 2)
                                                                    {{ "Février" }}
                                                                @elseif($credit->mois_remboursement == 3)
                                                                    {{ "Mars" }}
                                                                @elseif($credit->mois_remboursement == 4)
                                                                    {{ "Avril" }}
                                                                @elseif($credit->mois_remboursement == 5)
                                                                    {{ "Mai" }}
                                                                @elseif($credit->mois_remboursement == 6)
                                                                    {{ "Juin"}}
                                                                @elseif($credit->mois_remboursement == 7)
                                                                    {{ "Juillet" }}
                                                                @elseif($credit->mois_remboursement == 8)
                                                                    {{ "Août" }}
                                                                @elseif($credit->mois_remboursement== 9)
                                                                    {{ "Septembre" }}
                                                                @elseif($credit->mois_remboursement == 10)
                                                                    {{ "Octobre" }}
                                                                @elseif($credit->mois_remboursement == 11)
                                                                    {{ "Novembre" }}
                                                                @else
                                                                    {{ "Décembre" }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $credit->date_credit->format('d/m/Y') }}
                                                            </td>
                                                            <td>

                                                                <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $credit->id }}">
                                                                    <i class="fa fa-pencil"></i> Modifier
                                                                </a>
                                                                <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $credit->id }})"
                                                                    class="btn btn-danger">
                                                                    <i class="fa fa-trash"></i> Supprimer
                                                                </a>
                                                                <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                    <div class="mt-5 modal-dialog modal-confirm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header flex-column">
                                                                                <div class="icon-box">
                                                                                    <i class="material-icons">&#xE5CD;</i>
                                                                                </div>
                                                                                <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>
                                                                                    Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-center">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                                <form action="{{ route('Credit.destroy',$credit->id) }}" method="post" id="deleteform">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('DELETE') }}
                                                                                    <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                        Oui Supprimer
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="container">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="myModal{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                    <h4 class="modal-title text-center" id="myModalLabel">Modification D'un Remboursement De Bon</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="center">
                                                                                        <img src="/images/photos/enseignants/{{ $credit->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                        <h4 class="media-heading">{{ $credit->user->nom.' '.$credit->user->prenom }}
                                                                                            <br>
                                                                                        </h4>
                                                                                    </div>
                                                                                        <form action="{{ route('Credit.update',$credit->id) }}" method="post">
                                                                                            {{ csrf_field() }}
                                                                                            {{ method_field('PUT') }}
                                                                                            <input type="hidden" name="user_id" value="{{ $credit->user->id }}">
                                                                                            {{-- <input type="hidden" name="salaire_a_payer" value="{{ $paiement->user->emargements->sum('gains')  }}"> --}}
                                                                                            <div class="form-group">
                                                                                                <label for="montant">Montant Rembourser *</label>
                                                                                                <input type="number"
                                                                                                class="form-control" name="montant_rembourser" id="montant_rembourser" value="{{ $credit->somme_rembourser }}"  aria-describedby="helpId" placeholder="Entrez le montant rembourser" required>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="mois_remboursement">Mois Remboursement</label>
                                                                                                <select  class="form-control" name="mois_remboursement" id="mois_remboursement" required>
                                                                                                <option value="">Selectionnez le mois</option>
                                                                                                    <option value="1" @if($credit->mois_remboursement == 1) selected @endif>Janvier</option>
                                                                                                    <option value="2" @if($credit->mois_remboursement == 2) selected @endif>Fevrier</option>
                                                                                                    <option value="3" @if($credit->mois_remboursement == 3) selected @endif>Mars</option>
                                                                                                    <option value="4" @if($credit->mois_remboursement == 4) selected @endif>Avril</option>
                                                                                                    <option value="5" @if($credit->mois_remboursement == 5) selected @endif>Mai</option>
                                                                                                    <option value="6" @if($credit->mois_remboursement == 6) selected @endif>Juin</option>
                                                                                                    <option value="7" @if($credit->mois_remboursement == 7) selected @endif>Juillet</option>
                                                                                                    <option value="8" @if($credit->mois_remboursement == 8) selected @endif>Août</option>
                                                                                                    <option value="9" @if($credit->mois_remboursement == 9) selected @endif>Septembre</option>
                                                                                                    <option value="10" @if($credit->mois_remboursement == 10) selected @endif>Octobre</option>
                                                                                                    <option value="11" @if($credit->mois_remboursement == 11) selected @endif>Novembre</option>
                                                                                                    <option value="12" @if($credit->mois_remboursement == 12) selected @endif>Décembre</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="montant">Date *</label>
                                                                                                <input type="date"
                                                                                                class="form-control" name="date_credit" id="date_credit" value="{{ $credit->date_credit->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
                                                                                            </div>
                                                                                            <br>
                                                                                            <div class="container center">
                                                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                            </div>
                                                                                        </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h3><u>Total Bon Rembourser:</u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Bon')->sum('somme_rembourser'),0,',',' ').' GNF' }}</h3>

                                        <h3 class="text-center"><u>Historique Des Prêts D'un Enseignant</u></h3>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"> Montant Crédit </th>
                                                        <th class="text-center"> Motif</th>
                                                        <th class="text-center">Début</th>
                                                        <th class="text-center">Fin</th>
                                                        <th class="text-center">Montant Par Mois</th>
                                                        <th class="text-center"> Date </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($enseignant->creditEnseignants->where('type_de_credit','Prêt') as $credit)
                                                        @if($credit->somme_credit != null)
                                                            <tr class="odd gradeX">
                                                                <td class="text-center" style="width: 20%">
                                                                    {{ number_format($credit->somme_credit,0,',',' ').' GNF' }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $credit->motif }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($credit->debut_remboursement == 1)
                                                                            {{ "Janvier" }}
                                                                        @elseif($credit->debut_remboursement == 2)
                                                                            {{ "Février" }}
                                                                        @elseif($credit->debut_remboursement == 3)
                                                                            {{ "Mars" }}
                                                                        @elseif($credit->debut_remboursement == 4)
                                                                            {{ "Avril" }}
                                                                        @elseif($credit->debut_remboursement == 5)
                                                                            {{ "Mai" }}
                                                                        @elseif($credit->debut_remboursement == 6)
                                                                            {{ "Juin"}}
                                                                        @elseif($credit->debut_remboursement == 7)
                                                                            {{ "Juillet" }}
                                                                        @elseif($credit->debut_remboursement == 8)
                                                                            {{ "Août" }}
                                                                        @elseif($credit->debut_remboursement== 9)
                                                                            {{ "Septembre" }}
                                                                        @elseif($credit->debut_remboursement == 10)
                                                                            {{ "Octobre" }}
                                                                        @elseif($credit->debut_remboursement == 11)
                                                                            {{ "Novembre" }}
                                                                        @else
                                                                            {{ "Décembre" }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($credit->fin_remboursement == 1)
                                                                            {{ "Janvier" }}
                                                                        @elseif($credit->fin_remboursement == 2)
                                                                            {{ "Février" }}
                                                                        @elseif($credit->fin_remboursement == 3)
                                                                            {{ "Mars" }}
                                                                        @elseif($credit->fin_remboursement == 4)
                                                                            {{ "Avril" }}
                                                                        @elseif($credit->fin_remboursement == 5)
                                                                            {{ "Mai" }}
                                                                        @elseif($credit->fin_remboursement == 6)
                                                                            {{ "Juin"}}
                                                                        @elseif($credit->fin_remboursement == 7)
                                                                            {{ "Juillet" }}
                                                                        @elseif($credit->fin_remboursement == 8)
                                                                            {{ "Août" }}
                                                                        @elseif($credit->fin_remboursement== 9)
                                                                            {{ "Septembre" }}
                                                                        @elseif($credit->fin_remboursement == 10)
                                                                            {{ "Octobre" }}
                                                                        @elseif($credit->fin_remboursement == 11)
                                                                            {{ "Novembre" }}
                                                                        @else
                                                                            {{ "Décembre" }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ number_format($credit->montant_par_mois,0,'.',' ') }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $credit->date_credit->format('d/m/Y') }}
                                                                </td>
                                                                <td>

                                                                    <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $credit->id }}">
                                                                        <i class="fa fa-pencil"></i> Modifier
                                                                    </a>
                                                                    <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $credit->id }})"
                                                                        class="btn btn-danger">
                                                                        <i class="fa fa-trash"></i> Supprimer
                                                                    </a>
                                                                    <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                        <div class="mt-5 modal-dialog modal-confirm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header flex-column">
                                                                                    <div class="icon-box">
                                                                                        <i class="material-icons">&#xE5CD;</i>
                                                                                    </div>
                                                                                    <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>
                                                                                        Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-center">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                                    <form action="{{ route('Credit.destroy',$credit->id) }}" method="post" id="deleteform">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('DELETE') }}
                                                                                        <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                            Oui Supprimer
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="container">
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="myModal{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                        {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                        <h4 class="modal-title text-center" id="myModalLabel">Modification Du Crédit D'un Enseignant</h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="center">
                                                                                            <img src="/images/photos/enseignants/{{ $credit->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                            <h4 class="media-heading">{{ $credit->user->nom.' '.$credit->user->prenom }}
                                                                                                <br>
                                                                                            </h4>
                                                                                        </div>
                                                                                            <form action="{{ route('Credit.update',$credit->id) }}" method="post">
                                                                                                {{ csrf_field() }}
                                                                                                {{ method_field('PUT') }}
                                                                                                <input type="hidden" name="user_id" value="{{ $credit->user->id }}">
                                                                                                {{-- <input type="hidden" name="salaire_a_payer" value="{{ $paiement->user->emargements->sum('gains')  }}"> --}}
                                                                                                <div class="form-group">
                                                                                                    <label for="montant">Montant Credit *</label>
                                                                                                    <input type="number"
                                                                                                    class="form-control" name="montant_credit" id="montant_credit" value="{{ $credit->somme_credit }}" aria-describedby="helpId" placeholder="Entrez le montant crédit" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="motif">Motif *</label>
                                                                                                    <input type="text"
                                                                                                    class="form-control" name="motif" id="motif" value="{{ $credit->motif }}"  aria-describedby="helpId" placeholder="Entrez le motif du crédit" required  />
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="debut_remboursement">Début Remboursement</label>
                                                                                                    <select  class="form-control" name="debut_remboursement" id="debut_remboursement">
                                                                                                    <option value="">Selectionnez le mois</option>
                                                                                                        <option value="1" @if($credit->debut_remboursement == 1) selected @endif>Janvier</option>
                                                                                                        <option value="2" @if($credit->debut_remboursement == 2) selected @endif>Fevrier</option>
                                                                                                        <option value="3" @if($credit->debut_remboursement == 3) selected @endif>Mars</option>
                                                                                                        <option value="4" @if($credit->debut_remboursement == 4) selected @endif>Avril</option>
                                                                                                        <option value="5" @if($credit->debut_remboursement == 5) selected @endif>Mai</option>
                                                                                                        <option value="6" @if($credit->debut_remboursement == 6) selected @endif>Juin</option>
                                                                                                        <option value="7" @if($credit->debut_remboursement == 7) selected @endif>Juillet</option>
                                                                                                        <option value="8" @if($credit->debut_remboursement == 8) selected @endif>Août</option>
                                                                                                        <option value="9" @if($credit->debut_remboursement == 9) selected @endif>Septembre</option>
                                                                                                        <option value="10" @if($credit->debut_remboursement == 10) selected @endif>Octobre</option>
                                                                                                        <option value="11" @if($credit->debut_remboursement == 11) selected @endif>Novembre</option>
                                                                                                        <option value="12" @if($credit->debut_remboursement == 12) selected @endif>Décembre</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="fin_remboursement">Fin Remboursement</label>
                                                                                                    <select  class="form-control" name="fin_remboursement" id="fin_remboursement">
                                                                                                    <option value="">Selectionnez le mois</option>
                                                                                                        <option value="1" @if($credit->fin_remboursement == 1) selected @endif>Janvier</option>
                                                                                                        <option value="2" @if($credit->fin_remboursement == 2) selected @endif>Fevrier</option>
                                                                                                        <option value="3" @if($credit->fin_remboursement == 3) selected @endif>Mars</option>
                                                                                                        <option value="4" @if($credit->fin_remboursement == 4) selected @endif>Avril</option>
                                                                                                        <option value="5" @if($credit->fin_remboursement == 5) selected @endif>Mai</option>
                                                                                                        <option value="6" @if($credit->fin_remboursement == 6) selected @endif>Juin</option>
                                                                                                        <option value="7" @if($credit->fin_remboursement == 7) selected @endif>Juillet</option>
                                                                                                        <option value="8" @if($credit->fin_remboursement == 8) selected @endif>Août</option>
                                                                                                        <option value="9" @if($credit->fin_remboursement == 9) selected @endif>Septembre</option>
                                                                                                        <option value="10" @if($credit->fin_remboursement == 10) selected @endif>Octobre</option>
                                                                                                        <option value="11" @if($credit->fin_remboursement == 11) selected @endif>Novembre</option>
                                                                                                        <option value="12" @if($credit->fin_remboursement == 12) selected @endif>Décembre</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="montant">Date *</label>
                                                                                                    <input type="date"
                                                                                                    class="form-control" name="date_credit" id="date_credit" value="{{ $credit->date_credit->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="container center">
                                                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                                </div>
                                                                                            </form>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <h3><u>Total Prêt:</u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Prêt')->sum('somme_credit'),0,'.',' ').' GNF'  }}</h3>
                                            <h3 class="text-center"><u>Remboursement Des Prêts D'un Enseignant</u></h3>
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                >
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Montant Rembourser </th>
                                                    <th class="text-center"> Mois</th>
                                                    <th class="text-center"> Date </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enseignant->creditEnseignants->where('type_de_credit','Prêt') as $credit)
                                                    @if($credit->somme_rembourser != null)
                                                        <tr class="odd gradeX">
                                                            <td class="text-center" style="width: 20%">
                                                                {{ number_format($credit->somme_rembourser,0,',',' ').' GNF' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($credit->mois_remboursement == 1)
                                                                    {{ "Janvier" }}
                                                                @elseif($credit->mois_remboursement == 2)
                                                                    {{ "Février" }}
                                                                @elseif($credit->mois_remboursement == 3)
                                                                    {{ "Mars" }}
                                                                @elseif($credit->mois_remboursement == 4)
                                                                    {{ "Avril" }}
                                                                @elseif($credit->mois_remboursement == 5)
                                                                    {{ "Mai" }}
                                                                @elseif($credit->mois_remboursement == 6)
                                                                    {{ "Juin"}}
                                                                @elseif($credit->mois_remboursement == 7)
                                                                    {{ "Juillet" }}
                                                                @elseif($credit->mois_remboursement == 8)
                                                                    {{ "Août" }}
                                                                @elseif($credit->mois_remboursement== 9)
                                                                    {{ "Septembre" }}
                                                                @elseif($credit->mois_remboursement == 10)
                                                                    {{ "Octobre" }}
                                                                @elseif($credit->mois_remboursement == 11)
                                                                    {{ "Novembre" }}
                                                                @else
                                                                    {{ "Décembre" }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $credit->date_credit->format('d/m/Y') }}
                                                            </td>
                                                            <td>

                                                                <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $credit->id }}">
                                                                    <i class="fa fa-pencil"></i> Modifier
                                                                </a>
                                                                <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $credit->id }})"
                                                                    class="btn btn-danger">
                                                                    <i class="fa fa-trash"></i> Supprimer
                                                                </a>
                                                                <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                    <div class="mt-5 modal-dialog modal-confirm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header flex-column">
                                                                                <div class="icon-box">
                                                                                    <i class="material-icons">&#xE5CD;</i>
                                                                                </div>
                                                                                <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>
                                                                                    Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-center">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                                <form action="{{ route('Credit.destroy',$credit->id) }}" method="post" id="deleteform">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('DELETE') }}
                                                                                    <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                        Oui Supprimer
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="container">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="myModal{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                    <h4 class="modal-title text-center" id="myModalLabel">Modification D'un Remboursement</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="center">
                                                                                        <img src="/images/photos/enseignants/{{ $credit->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                        <h4 class="media-heading">{{ $credit->user->nom.' '.$credit->user->prenom }}
                                                                                            <br>
                                                                                        </h4>
                                                                                    </div>
                                                                                        <form action="{{ route('Credit.update',$credit->id) }}" method="post">
                                                                                            {{ csrf_field() }}
                                                                                            {{ method_field('PUT') }}
                                                                                            <input type="hidden" name="user_id" value="{{ $credit->user->id }}">
                                                                                            {{-- <input type="hidden" name="salaire_a_payer" value="{{ $paiement->user->emargements->sum('gains')  }}"> --}}
                                                                                            <div class="form-group">
                                                                                                <label for="montant">Montant Rembourser *</label>
                                                                                                <input type="number"
                                                                                                class="form-control" name="montant_rembourser" id="montant_rembourser" value="{{ $credit->somme_rembourser }}" max="{{ $credit->sum('somme_credit') - $credit->sum('somme_rembourser') }}" aria-describedby="helpId" placeholder="Entrez le montant rembourser" required>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="mois_remboursement">Mois Remboursement</label>
                                                                                                <select  class="form-control" name="mois_remboursement" id="mois_remboursement" required>
                                                                                                <option value="">Selectionnez le mois</option>
                                                                                                    <option value="1" @if($credit->mois_remboursement == 1) selected @endif>Janvier</option>
                                                                                                    <option value="2" @if($credit->mois_remboursement == 2) selected @endif>Fevrier</option>
                                                                                                    <option value="3" @if($credit->mois_remboursement == 3) selected @endif>Mars</option>
                                                                                                    <option value="4" @if($credit->mois_remboursement == 4) selected @endif>Avril</option>
                                                                                                    <option value="5" @if($credit->mois_remboursement == 5) selected @endif>Mai</option>
                                                                                                    <option value="6" @if($credit->mois_remboursement == 6) selected @endif>Juin</option>
                                                                                                    <option value="7" @if($credit->mois_remboursement == 7) selected @endif>Juillet</option>
                                                                                                    <option value="8" @if($credit->mois_remboursement == 8) selected @endif>Août</option>
                                                                                                    <option value="9" @if($credit->mois_remboursement == 9) selected @endif>Septembre</option>
                                                                                                    <option value="10" @if($credit->mois_remboursement == 10) selected @endif>Octobre</option>
                                                                                                    <option value="11" @if($credit->mois_remboursement == 11) selected @endif>Novembre</option>
                                                                                                    <option value="12" @if($credit->mois_remboursement == 12) selected @endif>Décembre</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="montant">Date *</label>
                                                                                                <input type="date"
                                                                                                class="form-control" name="date_credit" id="date_credit" value="{{ $credit->date_credit->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
                                                                                            </div>
                                                                                            <br>
                                                                                            <div class="container center">
                                                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                            </div>
                                                                                        </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h3><u>Total Remboursement Du Prêt:</u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Prêt')->sum('somme_rembourser'),0,'.',' ').' GNF' }} </h3>
                                    </div>
                                    <hr style="height: 5px; background-color: black; border: none">
                                    <h3>
                                        <u>Total Bon: </u>{{ number_format($enseignant->creditEnseignants->where('type_de_credit','Bon')->sum('somme_credit'),0,'.',' ').' GNF' }}<br>
                                        <u>Total Remboursement Bon: </u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Bon')->sum('somme_rembourser'),0,',',' ').' GNF' }}<br>
                                        <u>Reste Du Bon: </u>{{ number_format($enseignant->creditEnseignants->where('type_de_credit','Bon')->sum('somme_credit') - $enseignant->creditEnseignants->where('type_de_credit','Bon')->sum('somme_rembourser'),0,'.',' ').' GNF' }}<br>
                                        <u>Total Prêt: </u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Prêt')->sum('somme_credit'),0,'.',' ').' GNF' }}<br>
                                        <u>Total Remboursement Du Prêt: </u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Prêt')->sum('somme_rembourser'),0,'.',' ').' GNF' }}<br>
                                        <u>Reste Du Prêt: </u> {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Prêt')->sum('somme_credit') - $enseignant->creditEnseignants->where('type_de_credit','Prêt')->sum('somme_rembourser'),0,'.',' ').' GNF' }}<br>
                                        <u>Total Crédit: </u> {{ number_format($enseignant->creditEnseignants->sum('somme_credit'),0,'.',' ').' GNF' }}<br>
                                        <u>Total Remboursement: </u> {{ number_format($enseignant->creditEnseignants->sum('somme_rembourser'),0,'.',' ').' GNF' }}<br>
                                        <u>Total Reste: </u> {{ number_format($enseignant->creditEnseignants->sum('somme_credit') - $enseignant->creditEnseignants->sum('somme_rembourser'),0,'.',' ').' GNF' }}
                                    </h3>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection
{{-- script utiliser pour la suppression d'un paiement --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("Credit.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
