{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Bulletin-Par-Eleve'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Impression Du Bulletin Par Elève</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Elèves</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Impression Du Bulletin Par Elève</li>
                    </ol>
                </div>
            </div>
            <a  href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour </a>
            {{-- <a id="imprimer" href="#" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer le bulletin de l' élève</a> --}}
            {{-- <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="Imprimer le bulletin de l'élève" /> --}}
            <br><br>
            <div id="imprime" class="row">
                {{-- utiliser pour l'impression (rendu css) --}}
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
                <div id="invisible-screen"  class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <div class="pull-left">
                                        <address>
                                            <h4 class="font-bold addr-font-h4">
                                                <u class="souligner">MEN-A</u>
                                                <br>

                                                <u class="souligner">I.R.E: CONAKRY</u>
                                                <br>

                                                <u class="souligner">D.C.E: MATOTO</u>

                                                <br>

                                                <u class="souligner">D.S.C.E: TOMBOLIA</u>
                                            </h4>
                                            <h4 class="font-bold addr-font-h4">
                                                <u class="souligner">GROUPE SCOLAIRE BILLY ECOLE (G.S.B.E) </u>
                                                <br> &emsp;&emsp;&emsp;&emsp;<u class="souligner">"NOUVELLE VISION"</u>
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
                                        <br><br>
                                        <img src="/images/photos/logos/billy_ecole.png" width="250px" heigth="250px" alt="logo_ecole" srcset="">
                                        <br><br>
                                    </div>
                                </div>
                                <div class="row col-md-12 col-sm-12 col-lg-12">
                                    <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                        <div class="cercle">
                                            <div class="text-center">
                                                <h4 class="font-bold addr-font-h4">
                                                    <u class="souligner"> BULLETIN INDIVIDUEL DE NOTES</u><br>
                                                    <u class="souligner"> Pour La Période {{ $trimestre_choisi->nom_trimestre }}
                                                        <br> De L'année Scolaire {{ $annee_courante->annee_scolaire }}</u>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pull-left">
                                    <h4 class="font-bold addr-font-h4">&emsp;&emsp;
                                    Nom Et Prénom(s) de l'élève: {{ $infos_eleve->nom.' '.$infos_eleve->prenom }}
                                    <br>
                                    &emsp;&emsp; Matricule: {{ $infos_eleve->matricule }}<br>
                                    &emsp;&emsp; Classe: {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}<br>
                                    </h4>
                                </div>
                                <div class="pull-right">
                                    <img src="/images/photos/eleves/{{ $infos_eleve->photo_profil }}" class="img-thumbnail" width="150px" height="120px" alt="" srcset="">&emsp;&emsp;&emsp;
                                </div>
                                <div>
                                    <table class="table table-bordered">
                                        <thead id="bordure_table">
                                            <tr id="bordure_table">
                                                <th rowspan="2" id="bordure_table"><div class="align-top">Matière</div></th>
                                                <th colspan="3" id="bordure_table"><div class="text-center"> Notes Obtenues</div></th>
                                                <th rowspan="2" id="bordure_table"><div class="align-top">Coefficient</div></th>
                                                <th rowspan="2" id="bordure_table"><div class="align-top">Observation</div></th>
                                            </tr>
                                            <tr id="bordure_table">
                                                <td class="text-center" id="bordure_table">Cours</td>
                                                <td class="text-center" id="bordure_table">Composition</td>
                                                <td class="text-center" id="bordure_table">Moy-générales</td>
                                            </tr>
                                        </thead>
                                        <tbody id="bordure_table">
                                            @foreach ($notes_eleve as $note)
                                                <tr id="bordure_table">
                                                    <td class="text-center" id="bordure_table">{{ $note->matiere->nom_matiere }}</td>
                                                    <td class="text-center" id="bordure_table">
                                                        @if ($note->nbre_notes == null)

                                                        @else
                                                            {{ number_format(($note->note1 + $note->note2 + $note->note3 + $note->note4)/$note->nbre_notes,2) }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center" id="bordure_table">{{ $note->composition }}</td>
                                                    <td class="text-center" id="bordure_table">
                                                        @if(is_null($note->composition) and $note->nbre_notes != null)
                                                            {{ number_format(($note->note1 + $note->note2)/$note->nbre_notes,2) }}
                                                        @elseif($note->composition == 0 and $note->nbre_notes != null)
                                                            {{ number_format(((($note->note1 + $note->note2)/$note->nbre_notes) + ($note->composition * 2))/3,2)  }}
                                                        @elseif($note->composition != null and $note->note1 == null and $note->note2 == null)
                                                                {{ $note->composition }}
                                                        @elseif($note->composition == null and $note->nbre_notes == null)

                                                        @else
                                                                {{ number_format(((($note->note1 + $note->note2)/$note->nbre_notes) + ($note->composition * 2))/3,2)  }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center" id="bordure_table">{{ $note->coefficient }}</td>
                                                    <td class="text-center" id="bordure_table"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        <div class="pull-left">
                                            <h4 class="font-bold addr-font-h4">&emsp;&emsp;&emsp;Moyenne: {{ $moyenne_generale }} /
                                                @if ($niveau_choisi->moyennee_admission <= 5)
                                                        10
                                                    @else
                                                        20
                                                    @endif
                                                <br>Appréciations générales: ...................................
                                                ......................................................................
                                                <br>......................................................................
                                                ......................................................................
                                                ........
                                                <br>
                                            </h4>
                                        </div>
                                        <div class="">
                                            <h4 class=" pull-right font-bold addr-font-h4">Rang:

                                                {{ $rang }} /{{ $total_eleves }}

                                                <br><br><br>Conakry, le {{ date('d/m/Y') }}<br><br>La Direction
                                            </h4>
                                        </div>
                                        <div id="espace_bulletin">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
