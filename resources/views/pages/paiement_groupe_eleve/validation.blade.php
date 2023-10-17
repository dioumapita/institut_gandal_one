@extends($chemin_theme_actif,['title' => 'Paiement-Groupe-Eleve'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Paiement des frais scolaire de plusieurs étudiants</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Paiement des frais scolaire de plusieurs étudiants</li>
        </ol>
    </div>
</div>
<a href="{{ route('paiement_eleve.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
    <div class="profile-sidebar">
        <div class="card">
            <div class="card-head card-topline-aqua">
                <header>Informations Du Tuteur</header>
            </div>
            <div class="card-body no-padding height-9">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Nom: {{ $eleve->nom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Prénom: {{ $eleve->prenom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Contact: {{ $eleve->telephone_parent }}</b>
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
                            <header>Paiement des frais scolaires de plusieurs étudiants</header>
                        </div>
                        <div class="white-box">
                            <a id="media_screen"  href="#" onclick="printDiv('imprime')" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Imprimer le reçu</a>
                                <br>
                                <div class="table-scrollable mt-5">
                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                            >
                                        <thead>
                                            <tr>
                                                <th> Etudiant </th>
                                                <th>Classe</th>
                                                {{-- <th>Mois</th> --}}
                                                <th> Tranche</th>
                                                <th>Montat Payer</th>
                                                <th> Reste</th>
                                                <th> Date </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_eleves as $eleve)
                                                @if($eleve->paiementEleves->where('status',1)->count() >= 1)
                                                    <tr>
                                                        <td>{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                        <td>{{ $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->nom_niveau }}</td>
                                                        {{-- <td>{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->mois }}</td> --}}
                                                        <td>{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->where('num_recu',$num_recu)->first()->tranche }}</td>
                                                        <td>{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->where('num_recu',$num_recu)->first()->somme_payer }}</td>
                                                        <td>
                                                            @if($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->status == 1)
                                                                {{ ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')) }}
                                                            @else
                                                                {{ ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')) }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->date_paiement->format('d/m/Y') }}</td>
                                                        <td>
                                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->id }}">
                                                                <i class="fa fa-pencil"></i> Modifier
                                                            </a>
                                                            <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->id }})"
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
                                                                            <form action="{{ route('paiement_eleve.destroy',$eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->id) }}" method="post" id="deleteform">
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
                                                                <div class="modal fade" id="myModal{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                <h4 class="modal-title text-center" id="myModalLabel">Modification Du Paiement D'un Frais Scolaire</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="center">
                                                                                    <img src="/images/photos/eleves/{{ $eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                    <h4 class="media-heading">{{ $eleve->nom.' '.$eleve->prenom }} <br>
                                                                                        Matricule: {{ $eleve->matricule }} <br>
                                                                                        Scolarité à payer:
                                                                                        @if($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->status == 1)
                                                                                            {{ number_format((($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ')." GNF" }} <br>
                                                                                        @else
                                                                                            {{ number_format((($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ')." GNF" }} <br>
                                                                                        @endif
                                                                                        Scolarite payer: {{ number_format($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer'),0,',',' ')." GNF" }}<br>
                                                                                        Reste à payer: {{ number_format($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ')." GNF" }}
                                                                                    </h4>
                                                                                </div>
                                                                                <form action="{{ route('paiement_eleve.update',$eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->id) }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('PUT') }}
                                                                                    <div class="form-group">
                                                                                        <label for="montant">Montant Payer *</label>
                                                                                        <input type="number"
                                                                                        class="form-control" name="montant" id="montant" value="{{ $eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->somme_payer }}" aria-describedby="helpId" placeholder="" required max="">
                                                                                    </div>
                                                                                    {{-- <div class="form-group">
                                                                                        <label for="mois">Mois</label>
                                                                                        <select  name="mois[]" id="mois" class="form-control select2" multiple required>
                                                                                          <option value="null">Sélectionnez</option>
                                                                                          <option value="Tous les mois">Tous les mois</option>
                                                                                          <option value="Janvier">Janvier</option>
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
                                                                                            <option value="tranche1" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->tranche == 'tranche1') selected @endif>Tranche 1</option>
                                                                                            <option value="tranche2" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->tranche == 'tranche2') selected @endif>Tranche 2</option>
                                                                                            <option value="tranche3" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->tranche == 'tranche3') selected @endif>Tranche 3</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="type_paiement">Type De Paiement</label>
                                                                                        <select class="form-control" name="type_paiement" id="type_paiement" required>
                                                                                        <option value="Espèce" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->type_paiement == "Espèce") selected @endif>Espèce</option>
                                                                                        <option value="Dépot" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->type_paiement == "Dépot") selected @endif>Dépôt</option>
                                                                                        <option value="Chèque" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->type_paiement == "Chèque") selected @endif>Chèque</option>
                                                                                        <option value="Autres" @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->type_paiement == "Autres") selected @endif>Autres</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="date_paiement">Date *</label>
                                                                                        <input type="date"
                                                                                            class="form-control" name="date_paiement" id="date_paiement" value="{{$eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->date_paiement->format('Y-m-d') }}" aria-describedby="helpId" placeholder="" required>
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

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<div id="imprime" class="row">
    {{-- utiliser pour l'impression (rendu css) --}}
    <style>
        table {
            table-layout: auto;
            width: 100%;
        }

        table td {
            word-wrap: break-word;         /* All browsers since IE 5.5+ */
            overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
        }
        @media print{
            table {
            table-layout: auto;
            width: 100%;
        }

        table td {
            word-wrap: break-word;         /* All browsers since IE 5.5+ */
            overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
        }
            /* @page {size: landscape} */
            .font-bold {
                font-weight: bold;
            }

            .rouge{
                color: rgb(255, 0, 0) !important;
                font-style: italic !important;
            }
            .jaune{
                color: yellow !important;
                font-style: italic !important;
            }
            .vert{
                color: rgb(6, 168, 6) !important;
                font-style: italic !important;
            }
            #bordure_table{
                border: 2px solid black !important;
                font-size: 20px;
            }
            #bordure_tables{
                width: 50px;
                border: 2px solid black !important;
                font-size: medium;
                word-break: normal;
            }
            .cercle{
                        border: 5px solid;
                        border-radius: 20px;
                        padding: 0px;
                        margin-right: -33px;
                    }
            .align-top{
                        text-align: center;
                        margin-top: -68px;
                    }
            #harounaya{
                font-weight: bolder;
            }
            #paragraphe
            {
                font-size: medium;
            }
            #cadre{
            border-width:5px 5px;
            border-style:double;
            border-color:black;
            padding:0 10px;
            }
            #separateur2{
                border-width:5px;
                border-style:dashed;
                border-color:black;
            }
        }
    </style>
    <div id="invisible-screens" class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">METFP</u>
                                    <br>
                                    <u class="souligner">I.R.E: Conakry</u>
                                </h4>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">I.S.S.D GANDAL PLUS</u>
                                </h4>
                            </address>
                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">REPUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                 <br>
                                   <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                </h4>
                            </address>
                        </div>
                        <div class="center">
                             <img src="/images/photos/logos/logo_gandal2.jpg" width="250px" heigth="200px" alt="logo_ecole" srcset="">
                        </div>
                    </div>
                    <br>
                    <div class="row col-md-12 col-sm-12 col-lg-12">
                        <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                            <div class="cercles">
                                <div class="text-center">
                                    <h4 class="font-bold">
                                        <i class="souligner">Reçu De Paiement N° {{ $num_recu }} &nbsp; Date: {{ $date_paiement }}
                                        </i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cadres">
                        <p>Cher parent/tuteur,<br> Nous avons bien reçu votre paiement et nous vous en remercions</p>
                        <table class="table table-bordered">
                            <thead>
                                <th id="bordure_table">Matricule</th>
                                <th id="bordure_table">Etudiant(e)</th>
                                <th id="bordure_table">Classe</th>
                                {{-- <th id="bordure_table">Mois</th> --}}
                                <th id="bordure_table">Tranche</th>
                                <th id="bordure_table">Montant</th>
                                <th id="bordure_table">Reste</th>
                                {{-- <th id="bordure_table">Date</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    $montant_payer = 0;
                                    $reste = 0;
                                    $reste_inscription = 0;
                                    $reste_reinscription = 0;
                                @endphp
                                @foreach ($all_eleves as $eleve)
                                    @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->count() >= 1)
                                        <tr id="bordure_table">
                                            <td>{{ $eleve->matricule }}</td>
                                            <td id="bordure_table">{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                            <td id="bordure_table">{{ $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->nom_niveau }}</td>
                                            {{-- <td id="bordure_table">{{ $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->last()->mois}}</td> --}}
                                            <td id="bordure_table">{{ $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->where('num_recu',$num_recu)->first()->tranche }}</td>
                                            <td id="bordure_table" style="width: 11%">{{ $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->where('num_recu',$num_recu)->first()->somme_payer }}</td>
                                            <td id="bordure_table" style="width: 11%">
                                                @if($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->status == 1)
                                                    {{ ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')) }}
                                                @else
                                                    {{ ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')) }}
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- @php
                                            $i++;
                                            $montant_payer = $montant_payer + $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->last()->somme_payer;
                                                if($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->status == 1)
                                                {
                                                    $reste_reinscription = $reste_reinscription + ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')));
                                                }
                                                else {
                                                    $reste_inscription = $reste_inscription + ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')));
                                                }

                                            $reste = $reste + ($reste_inscription + $reste_reinscription);
                                        @endphp --}}
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach
                                {{-- <tr>
                                    <td id="bordure_table" colspan="4"></td>
                                    <td id="bordure_table">Total</td>
                                    <td id="bordure_table">{{ number_format($montant_payer,0,'.',' ') }}</td>
                                    <td id="bordure_table">{{ number_format($reste,0,'.',' ') }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <p>Recevez, cher parent/tuteur, nos sincères salutations</p>
                    </div>
                    <div id="ecriture">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 pull-left">
                                    <h4 class="font-bold text-left">Etudiant(e) / Tuteur</h4>
                                </div>
                                <div id="vendeur" class="col-md-6 pull-right">
                                    <h4 class="font-bold text-right">
                                        Comptable<br>
                                        626-00-91-91
                                    </h4>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
            {{-- @dd($i) --}}
            @if($i > 2)
                <div id="break_page" style="page-break-after:always; display:block; position:relative;"></div>
            @else
                <br><
                    <div id="separateur2">
                    </div>
                <br>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">METFP</u>
                                    <br>
                                    <u class="souligner">I.R.E: Conakry</u>
                                </h4>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">I.S.S.D GANDAL PLUS</u>
                                </h4>
                            </address>
                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">REPUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                 <br>
                                   <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                </h4>
                            </address>
                        </div>
                        <div class="center">
                             <img src="/images/photos/logos/logo_gandal2.jpg" width="250px" heigth="200px" alt="logo_ecole" srcset="">
                        </div>
                    </div>
                    <div class="row col-md-12 col-sm-12 col-lg-12">
                        <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                            <div class="cercles">
                                <div class="text-center">
                                    <h4 class="font-bold">
                                        <i class="souligner">Reçu De Paiement N° {{ $num_recu }} &nbsp; Date: {{ $date_paiement }}
                                        </i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cadres">
                        <p>Cher parent/tuteur,<br> Nous avons bien reçu votre paiement et nous vous en remercions</p>
                        <table class="table table-bordered">
                            <thead>
                                <th id="bordure_table">Matricule</th>
                                <th id="bordure_table">Etudiant(e)</th>
                                <th id="bordure_table">Classe</th>
                                {{-- <th id="bordure_table">Mois</th> --}}
                                <th id="bordure_table">Tranche</th>
                                <th id="bordure_table">Montant</th>
                                <th id="bordure_table">Reste</th>
                            </thead>
                            <tbody>
                                @foreach ($all_eleves as $eleve)
                                    @if($eleve->paiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->count() >= 1)
                                        <tr id="bordure_table">
                                            <td>{{ $eleve->matricule }}</td>
                                            <td id="bordure_table">{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                            <td id="bordure_table">{{ $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->nom_niveau }}</td>
                                            {{-- <td id="bordure_table">{{ $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->last()->mois}}</td> --}}
                                            <td id="bordure_table">{{ $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->where('num_recu',$num_recu)->first()->tranche }}</td>
                                            <td id="bordure_table" style="width: 11%">{{ $eleve->PaiementEleves->where('annee_id',$annee_courante->id)->where('status',1)->where('num_recu',$num_recu)->first()->somme_payer }}</td>
                                            <td id="bordure_table" style="width: 11%">
                                                @if($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->status == 1)
                                                    {{ ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')) }}
                                                @else
                                                    {{ ($eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - ($eleve->paiementEleves->where('annee_id',$annee_courante->id)->sum('somme_payer') + $eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                {{-- <tr>
                                    <td id="bordure_table" colspan="4"></td>
                                    <td id="bordure_table">Total</td>
                                    <td id="bordure_table">{{ number_format($montant_payer,0,'.',' ') }}</td>
                                    <td id="bordure_table">{{ number_format($reste,0,'.',' ') }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <p>Recevez, cher parent/tuteur, nos sincères salutations</p>
                    </div>
                    <div id="ecriture">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 pull-left">
                                    <h4 class="font-bold text-left">Etudiant(e) / Tuteur</h4>
                                </div>
                                <div id="vendeur" class="col-md-6 pull-right">
                                    <h4 class="font-bold text-right">
                                        Comptable <br> 626-00-91-91
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- script utiliser pour la suppression d'un eleve --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("paiement_eleve.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
