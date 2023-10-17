{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Bulletin-Individuel'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('bulletin.Bulletin')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('liste_eleve.Elèves')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('bulletin.Bulletin')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('bulletin.Bulletin') @lang('liste_eleve.De') @lang('liste_eleve.la') {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }} @lang('classement.Pour') @lang('liste_eleve.le'):
                        @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                {{ $trimestre_choisi->nom_trimestre }}
                        @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                {{ "Quarter ".$trimestre_choisi->id }}
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
                            <div class="btn-group">
                                <a href="{{ route('home') }}" id="addRow"
                                    class="btn btn-info">
                                        <i class="fa fa-reply"></i> @lang('liste_eleve.Retour')
                                </a>
                            </div>
                            {{-- <input class="btn btn-primary" type="button" value="Imprimer tous les bulletins des élèves" class="noprint" onclick="$('.printable,#break_page').printThis();"> --}}
                            <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="@lang('bulletin.PrintAll')" />
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <button id="addRow1" class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">
                                    @lang('classement.ChoisirUneClasseOuUneAutreTrimestre')  <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- debut modal -->
                                <div class="modal fade" data-backdrop="static" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('bulletin.Bulletin')</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>
                                            <!-- start modal body -->
                                                <div class="modal-body">
                                                    <form action="{{ route('bulletin_par_niveau') }}" method="GET">
                                                        <div class="form-group">
                                                            <label for="niveau_id">@lang('note.Select_classe')</label>
                                                            <select class="form-control" name="niveau_id" id="niveau_id">
                                                                @foreach ($all_classes as $key => $classe)
                                                                    <option value="{{ $classe->id }}" @if($classe->id == $niveau_choisi->id) selected @endif>{{ $classe->nom_niveau.' '.$classe->options}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="trimestre_id">@lang('note.SelectTrimestre')</label>
                                                            <select class="form-control" name="trimestre_id" id="trimestre_id">
                                                                @foreach ($all_trimestres as $key => $trimestre)
                                                                    <option value="{{ $trimestre->id }}" @if($trimestre->id == $trimestre_choisi->id) selected @endif>
                                                                        @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                                                            {{ $trimestre->nom_trimestre}}
                                                                        @else
                                                                            {{ "Quarter ".$trimestre->id }}
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                                <option value="resultat_annuel">Résultat Annuel</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">@lang('note.Valider') <i class="fa fa-check"></i></button>
                                                            <button class="btn btn-danger" data-dismiss="modal">@lang('note.Annuler') <i class="fa fa-times"></i></button>
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

                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th> @lang('note.Rang') </th>
                                    <th> @lang('liste_eleve.Matricule') </th>
                                    <th> @lang('liste_eleve.Nom') @lang('note.Et') @lang('liste_eleve.Prenom') </th>
                                    <th> @lang('classement.Genre') </th>
                                    <th> @lang('note.Moyenne')</th>
                                    {{-- <th class="text-center" > Action </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $rang = 1;
                                @endphp
                                @foreach ($classements as $classement)
                                    <tr>
                                        <td>{{ $i++}}</td>
                                        <td>{{ $classement->eleve->matricule }}</td>
                                        <td>{{ $classement->eleve->nom.' '.$classement->eleve->prenom }}</td>
                                        <td>
                                            @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                                    {{ $classement->eleve->sexe }}
                                            @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                                @if($classement->eleve->sexe == 'Masculin')
                                                            {{ "Male" }}
                                                @else
                                                            {{ "Feminine" }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ bcdiv($classement->moy,1,2) }}</td>
                                        {{-- <td>
                                            <form action="{{ route('bulletin_par_eleve',$classement->eleve->id) }}" method="get">
                                                <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisi->id }}">
                                                <input type="hidden" name="rang" value="{{ $rang++ }}">
                                                <input type="hidden" name="moyenne_generale" value="{{ number_format($classement->moy,2) }}">
                                                <input type="hidden" name="total_eleves" value="{{ $total_eleves }}">
                                                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-print"></i>Imprimer le bulletin</button>
                                            </form>
                                        </td> --}}
                                    </tr>
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
        @foreach ($classements as $classement)
        <div class="printable">
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
                            /* font-size: 20px; */
                            font-size: x-large;
                        }
                        #bordure_table2
                        {
                            border: 2px solid black !important;
                            line-height: 5px;
                            font-size: x-large;
                        }
                        #bordure_table3
                        {
                            border: 2px solid black !important;
                        }
                        #bordure_tables{
                            width: 5px;
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
                                    margin-top: -60px;
                                }
                        #harounaya
                        {
                            font-family: Arial, Helvetica, sans-serif;
                            font-weight: bolder;
                        }
                        #taille_logo
                        {
                            width: 369px;
                            height: 114px;
                        }

                        #separateur
                        {
                            margin-top: -10px !important;
                            height: 5px !important;
                            background-color: black !important;
                        }
                        #remarque
                        {
                            font-weight: bold;
                            margin-top: -138px;
                        }
                        #paragraphe
                        {
                            font-size: medium;
                        }
                    }
                </style>
            <div id="invisible-screens"  class="col-md-12">
                <div id="taille_page" class="white-box">
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
                            <br>
                            <hr id="separateur" class="center">
                            <div class="row">
                                <div class="col-md-8 pull-left">
                                   <p id="title_bulletin">
                                       @lang('bulletin.Bulletin') :
                                        @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                            {{ $trimestre_choisi->nom_trimestre }}
                                        @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                            {{ "Quarter ".$trimestre_choisi->id }}
                                        @else

                                        @endif
                                </p>
                                    <h4 class="font-bold addr-font-h4">
                                        @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                            @lang('liste_eleve.Nom') @lang('note.Et') @lang('liste_eleve.Prenom'): {{ $classement->eleve->nom.' '.$classement->eleve->prenom }}
                                        @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                            Name: {{ $classement->eleve->nom.' '.$classement->eleve->prenom }}
                                        @else

                                        @endif
                                    <br>
                                    @lang('liste_eleve.Matricule') : {{ $classement->eleve->matricule }}<br>
                                    @lang('liste_eleve.Classe') : {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}<br>
                                    @lang('liste_eleve.Annee_Scolaire2') : {{ $annee_courante->annee_scolaire }}
                                    </h4>
                                </div>
                                <div class=" col-md-4 pull-right">
                                    <table class="col-md-12 table table-bordered">
                                        <thead id="bordure_table3">
                                            <tr>
                                                <th id="bordure_table3">
                                                    <p id="remarque">@lang('bulletin.Remarque')</p>
                                                </th>
                                                <th>
                                                    @if($niveau_choisi->moyennee_admission == 5)
                                                        Seuil de passage  &nbsp;5<br>
                                                        9 à 10  Excellent<br>
                                                        8 à 8,99 Très Bien<br>
                                                        7 à 7,99 Bien<br>
                                                        6 à 6,99 Assez Bien<br>
                                                        5 à 5,99 Passable
                                                    @elseif($niveau_choisi->moyennee_admission == 10)
                                                        Seuil de passage  &nbsp;10<br>
                                                        18 à 20  Excellent<br>
                                                        16 à 17,99 Très Bien<br>
                                                        14 à 15,99 Bien<br>
                                                        12 à 13,99 Assez Bien<br>
                                                        10 à 11,99 Passable
                                                    @elseif($niveau_choisi->moyennee_admission == 50)
                                                        Pass System  &nbsp;50<br>
                                                        90 à 100  @lang('bulletin.Excellent')<br>
                                                        80 à 89   @lang('bulletin.Tres_Bien')<br>
                                                        70 à 79   @lang('bulletin.Assez_Bien')<br>
                                                        50 à 60   @lang('bulletin.Passable')<br><br>
                                                    @else

                                                    @endif
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                                {{-- primaire --}}
                                @if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35)
                                    <div>
                                        <table class="table table-bordered">
                                            <thead id="bordure_table">
                                                <tr id="bordure_table">
                                                    <th rowspan="2" id="bordure_table" class="text-center">Matières</th>
                                                    <th rowspan="2" id="bordure_table" class="text-center">Coef</th>
                                                    <th rowspan="2" id="bordure_table" class="text-center">Moyenne</th>
                                                    @if($niveau_choisi->id <= 44)
                                                        <th rowspan="2" id="bordure_table" class="text-center">Appréciations</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody id="bordure_table">
                                                @foreach ($notes as $note)
                                                    @if ($note->eleve->id ==  $classement->eleve->id)
                                                        <tr id="bordure_table2">
                                                            <td  id="bordure_table2">{{ $note->matiere->nom_matiere }}</td>
                                                            <td class="text-center" id="bordure_table2">{{ $note->coefficient }}</td>
                                                            <td class="text-center" id="bordure_table2">
                                                                @if(is_null($note->moyenne))

                                                                @else
                                                                    {{ bcdiv($note->moyenne,1,2) }}
                                                                @endif
                                                            </td>
                                                            @if($niveau_choisi->id <= 44)
                                                                <td class="text-center" id="bordure_table2">
                                                                    @if ($niveau_choisi->moyennee_admission == 5)
                                                                        @if(0.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 4.99)
                                                                            Insuffisant
                                                                        @elseif(5.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 5.99)
                                                                            Passable
                                                                        @elseif(6.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 6.99)
                                                                        Assez Bien
                                                                        @elseif(7.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 7.99)
                                                                            Bien
                                                                        @elseif (8.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 8.99)
                                                                            Très Bien
                                                                        @elseif( 9.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 10.00)
                                                                            Excellent
                                                                        @endif
                                                                    @elseif($niveau_choisi->moyennee_admission == 10)
                                                                        @if(0.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 9.99)
                                                                            Insuffisant
                                                                        @elseif(10.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 11.99)
                                                                            Passable
                                                                        @elseif(12.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 13.99)
                                                                        Assez Bien
                                                                        @elseif(14.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 15.99)
                                                                            Bien
                                                                        @elseif (16.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 17.99)
                                                                            Très Bien
                                                                        @elseif( 18.00 <= floor((($note->moyenne / $note->coefficient) * 100)/100) AND floor((($note->moyenne / $note->coefficient) * 100)/100) <= 20.00)
                                                                            Excellent
                                                                        @endif
                                                                    @else


                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div>
                                            <div class="pull-left">
                                                <h4 class="font-bold addr-font-h4">&emsp;&emsp;&emsp;@lang('note.Moyenne') {{ floor($classement->moy * 100)/100 }} /
                                                    @if ($niveau_choisi->moyennee_admission == 5)
                                                        10
                                                        <br>Appréciations générales:
                                                        @if(0.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 4.99)
                                                            Insuffisant
                                                        @elseif(5.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 5.99)
                                                            Passable
                                                        @elseif(6.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 6.99)
                                                        Assez Bien
                                                        @elseif(7.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 7.99)
                                                            Bien
                                                        @elseif (8.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 8.99)
                                                            Très Bien
                                                        @elseif( 9.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 10.00)
                                                            Excellent
                                                        @endif
                                                    @elseif($niveau_choisi->moyennee_admission == 10)
                                                        20
                                                        <br>Appréciations générales:
                                                        @if(0.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 9.99)
                                                            Insuffisant
                                                        @elseif(10.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 11.99)
                                                            Passable
                                                        @elseif(12.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 13.99)
                                                        Assez Bien
                                                        @elseif(14.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 15.99)
                                                            Bien
                                                        @elseif (16.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 17.99)
                                                            Très Bien
                                                        @elseif( 18.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 20.00)
                                                            Excellent
                                                        @endif
                                                    @elseif($niveau_choisi->moyennee_admission == 50)
                                                        50
                                                        <br>@lang('bulletin.Appreciation'):
                                                        @if(0 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 49)
                                                            @lang('bulletin.Insuffisant')
                                                        @elseif(50 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 69)
                                                            @lang('bulletin.Passable')
                                                        @elseif(70 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 79)
                                                            @lang('bulletin.Assez_Bien')
                                                        @elseif (80 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 89)
                                                            @lang('bulletin.Tres_Bien')
                                                        @elseif( 90 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 100)
                                                            @lang('bulletin.Excellent')
                                                        @endif
                                                    @else

                                                    @endif
                                                </h4>
                                            </div>
                                            <div class="">
                                                <h4 class=" pull-right font-bold addr-font-h4">@lang('note.Rang')
                                                    @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                                            @if ($b == 1 and $classement->eleve->sexe == 'Masculin')
                                                                    {{ $b++ }}<sup>er</sup> /{{ $total_eleves }}
                                                                @elseif($b == 1 and $classement->eleve->sexe == 'Feminin')
                                                                    {{ $b++ }}<sup>ère</sup> /{{ $total_eleves }}
                                                                @else
                                                                    {{ $b++ }}<sup>ème</sup> /{{ $total_eleves }}
                                                                @endif
                                                            @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                                                @if($b == 1)
                                                                    {{ $b++ }} <sup>st</sup> /{{ $total_eleves }}
                                                                @elseif($b == 2)
                                                                    {{ $b++ }} <sup>nd</sup> /{{ $total_eleves }}
                                                                @elseif($b == 3)
                                                                    {{ $b++ }} <sup>rd</sup> /{{ $total_eleves }}
                                                                @else
                                                                    {{ $b++}} <sup>th</sup> /{{ $total_eleves }}
                                                                @endif
                                                            @else
                                                    @endif
                                                    <br><br>Conakry, @lang('liste_eleve.le') {{ date('d/m/Y') }}<br><br>Directeur du primaire
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- secondaire --}}
                                @if($niveau_choisi->id > 18 AND $niveau_choisi->id <= 34)
                                    <div>
                                        <table class="table table-bordered">
                                            <thead id="bordure_table">
                                                <tr id="bordure_table">
                                                    <th rowspan="2" id="bordure_table"><div class="align-top">@lang('home.Matieres')</div></th>
                                                    <th rowspan="2" id="bordure_table"><div class="align-top">Coef</div></th>
                                                    <th colspan="2" id="bordure_table"><div class="text-center">Moyenne Obtenues</div></th>
                                                    <th rowspan="2" id="bordure_table"><div class="align-top">Moyenne Générale</div></th>
                                                </tr>
                                                <tr id="bordure_table">
                                                    <th class="text-center" id="bordure_table">
                                                        Cours
                                                    </th>
                                                    <th class="text-center" id="bordure_table">
                                                        Composition
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="bordure_table">
                                                @foreach ($notes as $note)
                                                    @if ($note->eleve->id ==  $classement->eleve->id)
                                                        <tr id="bordure_table2">
                                                            <td  id="bordure_table2">{{ $note->matiere->nom_matiere }}</td>
                                                            <td  id="bordure_table2" class="text-center">
                                                                {{ $note->coefficient }}
                                                            </td>
                                                            <td class="text-center" id="bordure_table2">
                                                                @if($note->nbre_notes == 0)

                                                                @else
                                                                    {{ floor((($note->note1 * $note->coefficient) + ($note->note2 * $note->coefficient) + ($note->note3 * $note->coefficient)) / $note->nbre_notes * 100) / 100 }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" id="bordure_table2">
                                                                @if(is_null($note->composition))

                                                                @else
                                                                    @if($note->matiere->nom_matiere == 'Conduite')
                                                                        {{ $note->composition * $note->coefficient }}
                                                                    @else
                                                                        {{ ($note->composition * 2) * $note->coefficient }}
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td class="text-center" id="bordure_table2">
                                                                @if(is_null($note->moyenne))

                                                                @else
                                                                    {{ $note->moyenne }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="">
                                            <div class="col-12">
                                                <table id="bordure_table2" class="table table-bordered">
                                                    <thead>
                                                        <th id="bordure_table2">Total</th>
                                                        <th id="bordure_table2">
                                                            {{ floor($classement->total_moy * 100)/100 }}
                                                        </th>
                                                        <th id="bordure_table2">Avis du conseil de classe</th>
                                                    </thead>
                                                    <tbody id="bordure_table2">
                                                        <tr id="bordure_table2">
                                                            <td id="bordure_table2">Moyenne de l'élève</td>
                                                            <td id="bordure_table2"> {{ floor($classement->moy * 100)/100 }}</td>
                                                            <td id="bordure_table2" rowspan="3">
                                                                @if($niveau_choisi->moyennee_admission == 10)
                                                                    @if(0.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 6.99)
                                                                        Travail intellectuel insuffisant
                                                                    @elseif(7.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 9.99)
                                                                        Travail intellectuel insuffisant,<br><br><br><br> des efforts à fournir
                                                                    @elseif(10.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 11.99)
                                                                        Travail intellectuel passable, <br><br><br><br> peut mieux faire
                                                                    @elseif(12.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 13.99)
                                                                        Assez bien
                                                                    @elseif (14.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 15.99)
                                                                        Bien, élève à encourager
                                                                    @elseif( 16.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 17.99)
                                                                        Très bien, élève à félicité
                                                                    @elseif( 18.00 <= floor(($classement->moy * 100)/100) AND floor(($classement->moy * 100)/100) <= 20.00)
                                                                        Excellent
                                                                    @endif
                                                                @endif

                                                                @foreach ($notes as $note)
                                                                    @if ($note->eleve->id ==  $classement->eleve->id)
                                                                        @if($note->matiere->nom_matiere == 'Conduite')
                                                                            @if(is_null($note->moyenne))

                                                                            @else
                                                                                <br><br><br><br><br><br>
                                                                                @if(0.00 <= floor($note->moyenne * 100)/100 AND floor($note->moyenne * 100)/100 <= 4.99)
                                                                                    Mauvaise conduite, avertissement sévère <br><br><br><br> élève susceptible d'être renvoyé
                                                                                @elseif(5.00 <= floor($note->moyenne * 100)/100 AND floor($note->moyenne * 100)/100 <= 6.99)
                                                                                Conduite passable
                                                                                @elseif(7.00 <= floor($note->moyenne * 100)/100 AND floor($note->moyenne * 100)/100 <= 8.99)
                                                                                Conduite assez bien
                                                                                @elseif(9.00 <= floor($note->moyenne * 100)/100 AND floor($note->moyenne * 100)/100 <= 9.99)
                                                                                Conduite bien
                                                                                @elseif(floor($note->moyenne * 100)/100 == 10)
                                                                                Conduite trés bien
                                                                                @else

                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr id="bordure_table2">
                                                            <td id="bordure_table2">Rang</td>
                                                            <td id="bordure_table2">
                                                                @if ($b == 1 and $classement->eleve->sexe == 'Masculin')
                                                                    {{ $b++ }}<sup>er</sup> /{{ $total_eleves }}
                                                                @elseif($b == 1 and $classement->eleve->sexe == 'Feminin')
                                                                    {{ $b++ }}<sup>ère</sup> /{{ $total_eleves }}
                                                                @else
                                                                    {{ $b++ }}<sup>ème</sup> /{{ $total_eleves }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <div class="pull-left">
                                                <h4 class="font-blod addr-font-h4">DIRECTEUR DES ETUDES</h4>
                                            </div> --}}
                                            <div class="pull-right">
                                                <h4>LE PROVISEUR</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="break_page" style="page-break-after:always; display:block; position:relative;"></div>
        </div>
        @endforeach
    </div>
@endsection
