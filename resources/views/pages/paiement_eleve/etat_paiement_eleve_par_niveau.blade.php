{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Etat-Paiement-Eleve-Par-Classe'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Etat De Paiement Des Elèves De La {{ $niveau->nom_niveau.' '.$niveau->options }}</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Etat De Paiement Des Elèves  De La {{ $niveau->nom_niveau.' '.$niveau->options }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>
                        @if($etat == 1)
                            Etat De Paiement Des Elèves De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                        @elseif($etat == 2)
                            Elève En Rétard De Paiement De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                        @elseif($etat == 3)
                            Elève En Régle De Paiement De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                        @elseif($etat == 4)
                            Elève En Rétard De Paiement Du Premier Accompte De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                        @elseif($etat == 5)
                            Elève En Rétard De Paiement Du Deuxième Accompte De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                        @else

                        @endif
                    </header>
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
                        <div class="col-md-6 col-sm-6 col-6">
                            @if($etat > 1)
                                <form action="{{ route('etat_paiement_eleve_par_classe') }}" method="post"  class="inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="niveau_id" id="niveau_id" value="{{ $niveau->id }}">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-reply"></i> Retour</button>
                                </form>
                            @else
                                <a href="{{ route('etat_paiement_eleve') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
                            @endif
                            <div class="btn-group">
                                <button class="btn btn-primary  btn-outline" data-toggle="modal" data-target="#choix">Choisir un status de paiement
                                    <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal -->
                                    <div class="modal fade" data-backdrop="static" id="choix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Etat De Paiement Des Elèves</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                            <form action="{{ route('etat_paiement_eleve_par_classe') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="niveau_id" id="niveau_id" value="{{ $niveau->id }}">
                                                                <div class="form-group">
                                                                    <label for="">Status</label>
                                                                    <select class="form-control" name="status" id="status">
                                                                        <option value="1" @if($etat == 1) selected @endif>Tous les élèves</option>
                                                                        <option value="2" @if($etat == 2) selected @endif>Les élèves en rétard de paiement</option>
                                                                        <option value="3" @if($etat == 3) selected @endif>Les élèves en règle de paiement</option>
                                                                        <option value="4" @if($etat == 4) selected @endif>Accompte 1</option>
                                                                        <option value="5" @if($etat == 5) selected @endif>Accompte 2</option>
                                                                        <option value="6" @if($etat == 6) selected @endif>Accompte 3</option>
                                                                        <option value="7" @if($etat == 7) selected @endif>Accompte 4</option>
                                                                        <option value="8" @if($etat == 8) selected @endif>Accompte 5</option>
                                                                        <option value="9" @if($etat == 9) selected @endif>Accompte 6</option>
                                                                        <option value="10" @if($etat == 10) selected @endif>Accompte 7</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="submit" class="btn btn-primary">Valider<i class="fa fa-check"> </i></button>
                                                                    <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                </div>
                                                            </form>
                                                    </div>
                                                <!-- end modal body -->
                                            </div>
                                        </div>
                                    </div>
                                <!-- fin modal -->
                                &nbsp;
                                <a id="media_screen"  href="#" onclick="printDiv('imprime')" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Imprimer</a>
                                &nbsp;
                                <form action="{{ route('messagerie',$etat) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="niveau" value="{{ $niveau->id }}">
                                    <input type="hidden" name="etat" value="{{ $etat }}">
                                    <button type="submit" class="btn btn-primary">Envoyer un message</button>
                                </form>
                                {{-- <a href="{{ route('messagerie',$etat) }}" class="btn btn-primary"><i class="fa fa-send"></i>Envoyer un message</a> --}}

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <button class="btn deepPink-bgcolor  btn-outline" data-toggle="modal" data-target="#emargement">Choisir une autre classe
                                    <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal -->
                                    <div class="modal fade" data-backdrop="static" id="emargement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Etat De Paiement Des Elèves</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                            <form action="{{ route('etat_paiement_eleve_par_classe') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="">Selectionner une classe</label>
                                                                    <select  class="form-control" name="niveau_id" id="niveau_id" required>
                                                                    <option value=""></option>
                                                                    @foreach ($all_niveaux as $key => $niveaus)
                                                                        <option value="{{ $niveaus->id }}">{{ $niveaus->nom_niveau.' '.$niveaus->options}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Status</label>
                                                                    <select class="form-control" name="status" id="status">
                                                                        <option value="1" @if($etat == 1) selected @endif>Tous les élèves</option>
                                                                        <option value="2" @if($etat == 2) selected @endif>Les élèves en rétard de paiement</option>
                                                                        <option value="3" @if($etat == 3) selected @endif>Les élèves en règle de paiement</option>
                                                                        <option value="4" @if($etat == 4) selected @endif>Accompte 1</option>
                                                                        <option value="5" @if($etat == 5) selected @endif>Accompte 2</option>
                                                                        <option value="6" @if($etat == 6) selected @endif>Accompte 3</option>
                                                                        <option value="7" @if($etat == 7) selected @endif>Accompte 4</option>
                                                                        <option value="8" @if($etat == 8) selected @endif>Accompte 5</option>
                                                                        <option value="9" @if($etat == 9) selected @endif>Accompte 6</option>
                                                                        <option value="10" @if($etat == 10) selected @endif>Accompte 7</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="submit" class="btn btn-primary">Valider<i class="fa fa-check"> </i></button>
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
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    {{-- <th>Image</th> --}}
                                    <th> Matricule </th>
                                    <th> Elève </th>
                                    <th> Scolarite à payer </th>
                                    <th> Scolarite payer </th>
                                    <th> Reste </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_inscriptions as $inscription)
                                    @if ($etat == 1)
                                        <tr class="odd gradeX">
                                            {{-- <td class="patient-img">
                                                <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                    alt="photo_eleve">
                                            </td> --}}
                                            <td class="left">{{ $inscription->eleve->matricule }}</td>
                                            <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                            {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>    --}}
                                            <td>{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                            <td>
                                                {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                            </td>
                                            <td>
                                                {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' '). " GNF" }}
                                            </td>
                                        </tr>
                                    @elseif($etat == 2)
                                        @if($inscription->niveau->scolarite > ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                            <tr class="odd gradeX">
                                                {{-- <td class="patient-img">
                                                    <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                    alt="photo_eleve">
                                                </td> --}}
                                                <td class="left">{{ $inscription->eleve->matricule }}</td>
                                                <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                <td>{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                                <td>
                                                    {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                </td>
                                                <td>
                                                    {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }}
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif($etat == 3)
                                        @if($inscription->niveau->scolarite == ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                            <tr class="odd gradeX">
                                                {{-- <td class="patient-img">
                                                    <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                    alt="photo_eleve">
                                                </td> --}}
                                                <td class="left">{{ $inscription->eleve->matricule }}</td>
                                                <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                <td>{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                                <td>
                                                    {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                </td>
                                                <td>
                                                    {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }}
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif($etat == 4)
                                        {{-- @dd("1"); --}}
                                        @if(($inscription->niveau->mensualite * 3) > ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                            <tr class="odd gradeX">
                                                {{-- <td class="patient-img">
                                                    <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                    alt="photo_eleve">
                                                </td> --}}
                                                <td class="left">{{ $inscription->eleve->matricule }}</td>
                                                <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                <td>{{ number_format(($inscription->niveau->mensualite * 3),0,',',' ')." GNF" }} </td>
                                                <td>
                                                    {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                </td>
                                                <td>
                                                    {{ number_format(($inscription->niveau->mensualite * 3)  - ($inscription->eleve->paiementEleves->sum('somme_payer')),0,',',' ')." GNF" }}
                                                </td>
                                            </tr>
                                        @endif
                                    @elseif($etat == 5)
                                        @if((($inscription->niveau->mensualite * 3) + $inscription->niveau->mensualite) > ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                            <tr class="odd gradeX">
                                                {{-- <td class="patient-img">
                                                    <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                    alt="photo_eleve">
                                                </td> --}}
                                                <td class="left">{{ $inscription->eleve->matricule }}</td>
                                                <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                <td>{{ number_format((($inscription->niveau->mensualite * 3) + ($inscription->niveau->mensualite)),0,',',' ')." GNF" }} </td>
                                                <td>
                                                    {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                </td>
                                                <td>
                                                    {{ number_format((($inscription->niveau->mensualite * 3) + ($inscription->niveau->mensualite))  - ($inscription->eleve->paiementEleves->sum('somme_payer')),0,',',' ')." GNF" }}
                                                </td>
                                            </tr>
                                        @endif
                                    @else

                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div id="imprime" class="row">
        <style>
            @media print{
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
                                        <u class="souligner">MENPU-A</u>
                                        <br>

                                        <u class="souligner">I.R.E: Conakry</u>
                                        <br>

                                        <u class="souligner">D.C.E: Ratoma</u>

                                        <br>

                                        <u class="souligner">D.S.E.E: Kobayah</u>
                                    </h4>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">Groupe Scolaire Elhadj Moussa Balde</u>
                                    </h4>
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">REPLUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                     <br>
                                       <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                    </h4>
                                </address>
                            </div>
                            <div class="center">
                                <img src="/images/photos/logos/logo_emb.jpg" width="200px" heigth="100px" alt="logo_ecole" srcset="">
                            </div>
                        </div>
                        <div class="row col-md-12 col-sm-12 col-lg-12">
                            <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                <div class="cercle">
                                    <div class="text-center">
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">
                                                @if($etat == 1)
                                                    Etat De Paiement Des Elèves De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                @elseif($etat == 2)
                                                    Elève En Rétard De Paiement De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                @elseif($etat == 3)
                                                    Elève En Régle De Paiement De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                @elseif($etat == 4)
                                                    Elève En Rétard De Paiement Du Premier Accompte De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                @elseif($etat == 5)
                                                    Elève En Rétard De Paiement Du Deuxième Accompte De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                @else

                                                @endif
                                            </u>
                                            <br>
                                            <u class="souligner">
                                               De L'anneé Scolaire {{ $annee_courante->annee_scolaire }}
                                             <br>
                                            </u>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <table id="bordure_table" class="table table-bordered">
                                <th class="text-center" id="bordure_table">Matricule </th>
                                <th class="text-center" id="bordure_table">Elève</th>
                                <th class="text-center" id="bordure_table">
                                    @if($etat == 4)
                                        Accompte 1
                                    @elseif($etat == 5)
                                        Accompte 2
                                    @elseif($etat == 6)
                                        Accompte 3
                                    @endif
                                </th>
                                <th class="text-center" id="bordure_table">
                                     Montant Payé
                                </th>
                                <th class="text-center" id="bordure_table">
                                     Reste
                               </th>
                                <tbody id="bordure_table">
                                    @foreach ($all_inscriptions as $inscription)
                                        @if ($etat == 1)
                                            <tr class="text-center" id="bordure_table">
                                                <td class="text-center" id="bordure_table">{{ $inscription->eleve->matricule }}</td>
                                                <td class="text-center" id="bordure_table">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>    --}}
                                                <td class="text-center" id="bordure_table">{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                                <td class="text-center" id="bordure_table">
                                                    {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                </td class="text-center" id="bordure_table">
                                                <td class="text-center" id="bordure_table">
                                                    {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' '). " GNF" }}
                                                </td>
                                            </tr>
                                        @elseif($etat == 2)
                                            @if($inscription->niveau->scolarite > ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                                <tr class="text-center" id="bordure_table">
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->matricule }}</td>
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                    {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                    <td class="text-center" id="bordure_table">{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                    </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @elseif($etat == 3)
                                            @if($inscription->niveau->scolarite == ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                                <tr class="text-center" id="bordure_table">
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->matricule }}</td>
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                    {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                    <td>{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                    </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @elseif($etat == 4)
                                            {{-- @dd("1"); --}}
                                            @if(($inscription->niveau->mensualite * 3) > ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                                <tr class="text-center" id="bordure_table">
                                                    {{-- <td class="patient-img">
                                                        <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                        alt="photo_eleve">
                                                    </td> --}}
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->matricule }}</td>
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                    {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                    <td class="text-center" id="bordure_table">{{ number_format(($inscription->niveau->mensualite * 3),0,',',' ')." GNF" }} </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                    </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format(($inscription->niveau->mensualite * 3)  - ($inscription->eleve->paiementEleves->sum('somme_payer')),0,',',' ')." GNF" }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @elseif($etat == 5)
                                            @if((($inscription->niveau->mensualite * 3) + $inscription->niveau->mensualite) > ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')))
                                                <tr class="text-center" id="bordure_table">
                                                    {{-- <td class="patient-img">
                                                        <img src="/images/photos/eleves/{{$inscription->eleve->photo_profil }}"
                                                        alt="photo_eleve">
                                                    </td> --}}
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->matricule }}</td>
                                                    <td class="text-center" id="bordure_table">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                                    {{-- <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td> --}}
                                                    <td class="text-center" id="bordure_table">{{ number_format((($inscription->niveau->mensualite * 3) + ($inscription->niveau->mensualite)),0,',',' ')." GNF" }} </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                                    </td>
                                                    <td class="text-center" id="bordure_table">
                                                        {{ number_format((($inscription->niveau->mensualite * 3) + ($inscription->niveau->mensualite))  - ($inscription->eleve->paiementEleves->sum('somme_payer')),0,',',' ')." GNF" }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @else

                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="">
                            <h4 class=" pull-right font-bold addr-font-h4">
                             Conakry, le {{ date('d/m/Y') }}<br><br>La Comptabilité
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
