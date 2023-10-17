@extends($chemin_theme_actif,['title' => 'Paiement-Inscription-Groupe-Eleve'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Paiement des frais d'inscription ou de réinscription de plusieurs élèves</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Paiement des frais d'inscription ou de réinscription de plusieurs élèves</li>
        </ol>
    </div>
</div>
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
                            <header>Paiement des frais d'inscription ou de réinscription de plusieurs élèves</header>
                        </div>
                        <div class="white-box">
                            <a id="media_screen"  href="#" onclick="printDiv('imprime')" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Imprimer le reçu</a>
                            <a class="btn btn-danger btn-lg" href="#aboutModal" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-money"></i> Payer pour un autre élève
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                            <h4 class="modal-title text-center" id="myModalLabel">Paiement Inscription ou Réinscription</h4>
                                        </div>
                                        <div class="modal-body">
                                                    <form action="{{ route('paiement_frais_inscription.store') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="mois">Selectionnez un élève</label>
                                                            <div class="form-group">
                                                              <label for="eleve_id"></label>
                                                              <select class="form-control" name="eleve_id" id="eleve_id" required>
                                                                @foreach ($all_eleves as $eleve)
                                                                    @if($eleve->inscrits()->count() > 0)
                                                                        @if($eleve->inscrits->last()->frais_inscription > 0 OR $eleve->inscrits->last()->frais_reinscription > 0)

                                                                        @else
                                                                            <option value="{{ $eleve->id }}">{{ $eleve->prenom.' '.$eleve->nom }}
                                                                                @if($eleve->inscrits->last()->status == 0)
                                                                                    Inscrit en {{ $eleve->inscrits->last()->niveau->nom_niveau }}
                                                                                @else
                                                                                    Réinscrit en {{ $eleve->inscrits->last()->niveau->nom_niveau }}
                                                                                @endif
                                                                            </option>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="montant">Montant Payer *</label>
                                                        <input type="number"
                                                            class="form-control" name="montant" id="montant" value="{{ old('montant') }}" aria-describedby="helpId" placeholder="" required>
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
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <br>
                                <div class="table-scrollable mt-5">
                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                            >
                                        <thead>
                                            <tr>
                                                <th>Matricule</th>
                                                <th>Elève</th>
                                                <th>Classe</th>
                                                <th>Inscription</th>
                                                <th>Réinscription</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_eleves as $eleve)
                                                @if($eleve->inscrits()->count() > 0)
                                                    @if($eleve->inscrits->last()->frais_inscription > 0)
                                                        <tr>
                                                            <td>{{ $eleve->matricule  }}</td>
                                                            <td>{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                            <td>{{ $eleve->inscrits->last()->niveau->nom_niveau }}</td>
                                                            <td>
                                                                @if($eleve->inscrits->last()->status == 0)
                                                                    Oui
                                                                @else
                                                                    Non
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($eleve->inscrits->last()->status == 1)
                                                                    Oui
                                                                @else
                                                                    Non
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($eleve->inscrits->last()->status == 0)
                                                                    {{ $eleve->inscrits->last()->frais_inscription }}
                                                                @else
                                                                    {{ $eleve->inscrits->last()->frais_reinscription }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $eleve->inscrits->last()->date_inscription->format('d/m/Y') }}</td>
                                                            <td>
                                                                <a class="btn btn-primary btn-block" href="#aboutModal" data-toggle="modal" data-target="#edit_versement{{ $eleve->id }}">
                                                                    <i class="fa fa-edit"></i> Modifier
                                                                </a>
                                                                <div class="container">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="edit_versement{{ $eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                    <h4 class="modal-title text-center" id="myModalLabel">Modification Des Frais D'inscription Ou De Réinscription</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="center">
                                                                                        <img src="/images/photos/eleves/{{ $eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                        <h4 class="media-heading">{{ $eleve->nom.' '.$eleve->prenom }} <br>
                                                                                            Matricule: {{ $eleve->matricule }} <br>
                                                                                            Frais D'inscription:  {{ $eleve->inscrits->last()->niveau->frais_inscription }}<br>
                                                                                            Montant Payer:  {{ $eleve->inscrits->last()->frais_inscription }}<br>
                                                                                            Reste: {{ $eleve->inscrits->last()->niveau->frais_inscription - $eleve->inscrits->last()->frais_inscription }}
                                                                                        </h4>
                                                                                    </div>
                                                                                    <form action="{{ route('paiement_frais_inscription.update',$eleve->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                        <label for="montant">Montant Payer *</label>
                                                                                        <input type="number"
                                                                                            class="form-control" name="montant" id="montant" value="{{ $eleve->inscrits->last()->frais_inscription }}" max="{{ $eleve->inscrits->last()->niveau->frais_inscription }}" aria-describedby="helpId" placeholder="" required>
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
                                                    @elseif($eleve->inscrits->last()->frais_reinscription > 0)
                                                        <tr>
                                                            <td>{{ $eleve->matricule  }}</td>
                                                            <td>{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                            <td>{{ $eleve->inscrits->last()->niveau->nom_niveau }}</td>
                                                            <td>
                                                                @if($eleve->inscrits->last()->status == 0)
                                                                    Oui
                                                                @else
                                                                    Non
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($eleve->inscrits->last()->status == 1)
                                                                    Oui
                                                                @else
                                                                    Non
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($eleve->inscrits->last()->status == 0)
                                                                    {{ $eleve->inscrits->last()->frais_inscription }}
                                                                @else
                                                                    {{ $eleve->inscrits->last()->frais_reinscription }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $eleve->inscrits->last()->date_inscription->format('d/m/Y') }}</td>
                                                            <td>
                                                                <a class="btn btn-primary btn-block" href="#aboutModal" data-toggle="modal" data-target="#edit_versement{{ $eleve->id }}">
                                                                    <i class="fa fa-edit"></i> Modifier
                                                                </a>
                                                                <div class="container">
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="edit_versement{{ $eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                    <h4 class="modal-title text-center" id="myModalLabel">Modification Des Frais D'inscription Ou De Réinscription</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="center">
                                                                                        <img src="/images/photos/eleves/{{ $eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                        <h4 class="media-heading">{{ $eleve->nom.' '.$eleve->prenom }} <br>
                                                                                            Matricule: {{ $eleve->matricule }} <br>
                                                                                            Frais De Réinscription:  {{ $eleve->inscrits->last()->niveau->frais_reinscription }}<br>
                                                                                            Montant Payer:  {{ $eleve->inscrits->last()->frais_reinscription }}<br>
                                                                                            Reste: {{ $eleve->inscrits->last()->niveau->frais_reinscription - $eleve->inscrits->last()->frais_reinscription }}
                                                                                        </h4>
                                                                                    </div>
                                                                                    <form action="{{ route('paiement_frais_inscription.update',$eleve->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                        <label for="montant">Montant Payer *</label>
                                                                                        <input type="number"
                                                                                            class="form-control" name="montant" id="montant" value="{{ $eleve->inscrits->last()->frais_reinscription }}" max="{{ $eleve->inscrits->last()->niveau->frais_reinscription }}" aria-describedby="helpId" placeholder="" required>
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
        @media print{
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
                            <img src="/images/photos/logos/logo_emb.jpg" width="200px" heigth="150px" alt="logo_ecole" srcset="">
                        </div>
                    </div>
                    <div class="row col-md-12 col-sm-12 col-lg-12">
                        <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                            <div class="cercles">
                                <div class="text-center">
                                    <h4 class="font-bold">
                                        <i class="souligner">Reçu De Paiement N°  &nbsp; Date: {{ date('d/m/Y') }}
                                        </i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cadres">
                        <p>Cher client,<br> Nous avons bien reçu votre paiement et nous vous en remercions</p>
                        <table class="table table-bordered">
                            <thead>
                                <th id="bordure_table">Matricule</th>
                                <th id="bordure_table">Eleve</th>
                                <th id="bordure_table">Classe</th>
                                <th id="bordure_table">Inscription</th>
                                <th id="bordure_table">Réinscription</th>
                                <th id="bordure_table">Montant</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($all_eleves as $eleve)
                                    @if($eleve->inscrits()->count() > 0)
                                        @if($eleve->inscrits->last()->frais_inscription > 0)
                                            <tr id="bordure_table">
                                                <td id="bordure_table">{{ $eleve->matricule  }}</td>
                                                <td id="bordure_table">{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                <td id="bordure_table">{{ $eleve->inscrits->last()->niveau->nom_niveau }}</td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 1)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        {{ $eleve->inscrits->last()->frais_inscription }}
                                                    @else
                                                        {{ $eleve->inscrits->last()->frais_reinscription }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                 $i++;
                                            @endphp
                                        @elseif($eleve->inscrits->last()->frais_reinscription > 0)
                                            <tr id="bordure_table">
                                                <td id="bordure_table">{{ $eleve->matricule  }}</td>
                                                <td id="bordure_table">{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                <td id="bordure_table">{{ $eleve->inscrits->last()->niveau->nom_niveau }}</td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 1)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        {{ $eleve->inscrits->last()->frais_inscription }}
                                                    @else
                                                        {{ $eleve->inscrits->last()->frais_reinscription }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                 $i++;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <p>Recevez, cher client, nos sincères salutations</p>
                    </div>
                    <div id="ecriture">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 pull-left">
                                    <h4 class="font-bold text-left">Parent / Tuteur</h4>
                                </div>
                                <div id="vendeur" class="col-md-6 pull-right">
                                    <h4 class="font-bold text-right">
                                        Comptable<br>
                                        621698987 / 620383971
                                    </h4>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
            {{-- @dd($i); --}}
            @if($i > 3)
                <div id="break_page" style="page-break-after:always; display:block; position:relative;"></div>
            @else
                <br><br>
                    <div id="separateur2">
                    </div>
                <br><br>
            @endif
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
                            <img src="/images/photos/logos/logo_emb.jpg" width="200px" heigth="150px" alt="logo_ecole" srcset="">
                        </div>
                    </div>
                    <div class="row col-md-12 col-sm-12 col-lg-12">
                        <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                            <div class="cercles">
                                <div class="text-center">
                                    <h4 class="font-bold">
                                        <i class="souligner">Reçu De Paiement N°  &nbsp; Date: date('d/m/Y')
                                        </i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cadres">
                        <p>Cher client,<br> Nous avons bien reçu votre paiement et nous vous en remercions</p>
                        <table class="table table-bordered">
                            <thead>
                                <th id="bordure_table">Matricule</th>
                                <th id="bordure_table">Eleve</th>
                                <th id="bordure_table">Classe</th>
                                <th id="bordure_table">Inscription</th>
                                <th id="bordure_table">Réinscription</th>
                                <th id="bordure_table">Montant</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($all_eleves as $eleve)
                                    @if($eleve->inscrits()->count() > 0)
                                        @if($eleve->inscrits->last()->frais_inscription > 0)
                                            <tr id="bordure_table">
                                                <td id="bordure_table">{{ $eleve->matricule  }}</td>
                                                <td id="bordure_table">{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                <td id="bordure_table">{{ $eleve->inscrits->last()->niveau->nom_niveau }}</td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 1)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        {{ $eleve->inscrits->last()->frais_inscription }}
                                                    @else
                                                        {{ $eleve->inscrits->last()->frais_reinscription }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @elseif($eleve->inscrits->last()->frais_reinscription > 0)
                                            <tr id="bordure_table">
                                                <td id="bordure_table">{{ $eleve->matricule  }}</td>
                                                <td id="bordure_table">{{ $eleve->prenom.' '.$eleve->nom }}</td>
                                                <td id="bordure_table">{{ $eleve->inscrits->last()->niveau->nom_niveau }}</td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 1)
                                                        Oui
                                                    @else
                                                        Non
                                                    @endif
                                                </td>
                                                <td id="bordure_table">
                                                    @if($eleve->inscrits->last()->status == 0)
                                                        {{ $eleve->inscrits->last()->frais_inscription }}
                                                    @else
                                                        {{ $eleve->inscrits->last()->frais_reinscription }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <p>Recevez, cher client, nos sincères salutations</p>
                    </div>
                    <div id="ecriture">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 pull-left">
                                    <h4 class="font-bold text-left">Parent / Tuteur</h4>
                                </div>
                                <div id="vendeur" class="col-md-6 pull-right">
                                    <h4 class="font-bold text-right">
                                        Comptable <br>
                                        621698987 / 620383971
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
