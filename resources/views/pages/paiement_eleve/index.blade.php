{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Paiement-Eleve'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Paiement Des Frais Scolaire De Tous Les Etudiants</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Paiement Des Frais Scolaire De Tous Les Etudiants</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Paiement Des Frais Scolaire De Tous Les Etudiants</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh"
                            href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down"
                            href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times"
                            href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="btn-group">
                                <a href="{{ route('home') }}" id="addRow"
                                    class="btn btn-info">
                                        <i class="fa fa-reply"></i> Retour
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('etat_paiement_eleve') }}" class="btn btn-primary">
                                    Etat De Paiement Des Etudiants  <i class="fa fa-money"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn deepPink-bgcolor  btn-outline" data-toggle="modal" data-target="#emargement">Paiement Des Frais Scolaire Par Classe
                                    <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal -->
                                    <div class="modal fade" data-backdrop="static" id="emargement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Paiement Des Frais Scolaire Par Classe</h4>
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
                                                                    <option value="{{ route('paiement_eleve_par_classe',$niveau) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
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
                            <a href="{{ route('gestion_recu') }}" class="btn btn-info">Gestion des reçu</a>
                            &nbsp;
                            <a href="{{ route('default_situation_journaliere') }}" class="btn btn-primary">Situation journalière</a>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th> Matricule </th>
                                    <th> Elève </th>
                                    <th> Classe</th>
                                    <th> Scolarite à payer </th>
                                    <th> Scolarite payer </th>
                                    <th> Reste</th>
                                    <th style="width: 20%"> Actions </th>
                                </tr>
                            </thead>
                            @php
                                $scolarite_total = 0;
                                $scolarite_payer = 0;
                                $reste = 0;
                                $total_inscription = 0;
                                $total_reinscription = 0;
                            @endphp
                            <tbody>
                                @foreach ($all_inscriptions as $inscription)
                                    <tr class="odd gradeX">
                                        <td class="left">{{ $inscription->eleve->matricule }}</td>
                                        <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                        <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>
                                        <td>
                                            @if($inscription->status == 1)
                                                {{ number_format((($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }} </td>
                                            @else
                                                {{ number_format((($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }} </td>
                                            @endif
                                        <td>
                                            {{ number_format($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer'),0,',',' ').' GNF' }}
                                        </td>
                                        <td>
                                            @if($inscription->status == 1)
                                                {{ number_format(($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription)  - ($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}
                                            @else
                                                {{ number_format(($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription)  - ($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-block" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $inscription->eleve->id }}">
                                                <i class="fa fa-money"></i> Effectuer Un Paiement
                                            </a>
                                            <a class="btn btn-primary btn-block" href="{{ route('paiement_eleve.show',$inscription->eleve->id) }}"><i class="fa fa-recycle"></i> Historique Des Paiements</a>
                                            <div class="container">
                                                @if($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser') == 0)
                                                <!-- Modal -->
                                                    <div class="modal fade" id="myModal{{ $inscription->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                    <h4 class="modal-title text-center" id="myModalLabel">Paiement Des Frais Scolaire</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="center">
                                                                        <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                        <h4 class="media-heading">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }} <br>
                                                                            Matricule: {{ $inscription->eleve->matricule }} <br>
                                                                            Scolarité à payer:
                                                                            @if($inscription->status == 1)
                                                                                {{ number_format((($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }} <br>
                                                                            @else
                                                                                {{ number_format((($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }} <br>
                                                                            @endif
                                                                            Scolarite payer: {{ number_format($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer'),0,',',' ')." GNF" }}<br>
                                                                            Reste à payer:
                                                                            @if($inscription->status == 1)
                                                                                {{ number_format(($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription)  - ($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}
                                                                            @else
                                                                                {{ number_format(($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription)  - ($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}
                                                                            @endif
                                                                        </h4>
                                                                    </div>
                                                                        {{-- si l'élève a tous solder on empêche le paiement  --}}
                                                                        @if ($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite == ($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')))
                                                                            <br>
                                                                            <h4 class="text-center">Vous ne pouvez pas effectuez de paiement pour cet élève car il a tout payé.</h4>
                                                                            <div class="container center">
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> OK</button>
                                                                            </div>
                                                                        @else
                                                                            <form action="{{ route('paiement_eleve.store') }}" method="post">
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="eleve_id" value="{{ $inscription->eleve->id }}">
                                                                                <input type="hidden" name="niveau_id" value="{{ $inscription->niveau->id }}">
                                                                                <div class="form-group">
                                                                                <label for="montant">Montant Payer *</label>
                                                                                @if($inscription->status == 1)
                                                                                    <input type="number"
                                                                                        class="form-control" name="montant" id="montant" value="{{ old('montant') }}" aria-describedby="helpId" placeholder="" required max="{{ ($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit') - $inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') }}">
                                                                                    </div>
                                                                                @else
                                                                                    <input type="number"
                                                                                        class="form-control" name="montant" id="montant" value="{{ old('montant') }}" aria-describedby="helpId" placeholder="" required max="{{ ($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit') - $inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') }}">
                                                                                    </div>
                                                                                @endif
                                                                                {{-- <div class="form-group">
                                                                                    <label for="mois">Mois</label>
                                                                                    <select  name="mois[]" id="mois" class="form-control select2" multiple required>
                                                                                      <option value="null">Sélectionnez</option>
                                                                                      <option value="Tous les mois">Tous les mois</option>
                                                                                      <option value="Janvier" >Janvier</option>
                                                                                        <option value="Fevrier" >Fevrier</option>
                                                                                        <option value="Mars" >Mars</option>
                                                                                        <option value="Avirl" >Avril</option>
                                                                                        <option value="Mai" >Mai</option>
                                                                                        <option value="Juin" >Juin</option>
                                                                                        <option value="Juillet" >Juillet</option>
                                                                                        <option value="Août" >Août</option>
                                                                                        <option value="Septembre" >Septembre</option>
                                                                                        <option value="Octobre" >Octobre</option>
                                                                                        <option value="Novembre" >Novembre</option>
                                                                                        <option value="Décembre" >Décembre</option>
                                                                                    </select>
                                                                                </div> --}}
                                                                                <div class="form-group">
                                                                                    <label for="tranche">Selectionnez une tranche</label>
                                                                                    <select class="form-control" name="tranche" id="tranche" required>
                                                                                        <option value="tranche1">Tranche 1</option>
                                                                                        <option value="tranche2">Tranche 2</option>
                                                                                        <option value="tranche3">Tranche 3</option>
                                                                                        <option value="Toute l'année">Toute l'année</option>
                                                                                    </select>
                                                                                </div>
                                                                                {{--  <div class="form-group">
                                                                                    <label for="num_recu">Numéro du reçu *</label>
                                                                                    <input type="text"
                                                                                        class="form-control" name="num_recu" id="num_recu" value="{{ old('num_recu') }}" aria-describedby="helpId" placeholder="Entrez le numéro du reçu" required>
                                                                                </div>  --}}
                                                                                <div class="form-group">
                                                                                <label for="type_paiement">Type De Paiement</label>
                                                                                <select class="form-control" name="type_paiement" id="type_paiement" required>
                                                                                    <option value="Espèce">Espèce</option>
                                                                                    <option value="Dépot">Dépôt</option>
                                                                                    <option value="Chèque">Chèque</option>
                                                                                    <option value="Autres">Autres</option>
                                                                                </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="date_paiement">Date *</label>
                                                                                    <input type="date"
                                                                                        class="form-control" name="date_paiement" id="date_paiement" value="{{ old('date_paiement') }}" aria-describedby="helpId" placeholder="" required>
                                                                                </div>
                                                                                <br>
                                                                                <div class="container center">
                                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                </div>
                                                                            </form>
                                                                        @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="modal fade" id="myModal{{ $inscription->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                    <h4 class="modal-title text-center" id="myModalLabel">Paiement Des Frais Scolaire</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="center">
                                                                        <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                        <h4 class="media-heading">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }} <br>
                                                                            Matricule: {{ $inscription->eleve->matricule }} <br>
                                                                            Vous ne pouvez pas effectuez de paiement car cet élève à un arriéré pour plus
                                                                            de détail
                                                                        </h4>
                                                                    </div>
                                                                    <div class="container center">
                                                                        <a href="{{ route('arrierer.show',$inscription->niveau->id) }}" class="btn btn-primary"><i class="fa fa-check"></i> Cliquez ici</a>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        if($inscription->status == 1)
                                        {
                                            $total_reinscription = $total_reinscription + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription;
                                        }
                                        else
                                        {
                                            $total_inscription = $total_inscription + $inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription;
                                        }

                                        $scolarite_total = $scolarite_total + ($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite - $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit'));
                                        $scolarite_payer = $scolarite_payer + $inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer');
                                        $reste = $reste + ($inscription->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite - ($inscription->eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')));
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <h3>
                            <u>Scolarite Total:</u> {{ number_format(($scolarite_total + $total_inscription + $total_reinscription),0,'',' ').' GNF' }}<br>
                            <u>Scolarite Payer:</u> {{ number_format($scolarite_payer,0,'',' ').' GNF' }}<br>
                            <u>Reste:</u> {{ number_format(($reste + $total_inscription + $total_reinscription),0,'',' ').' GNF' }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
