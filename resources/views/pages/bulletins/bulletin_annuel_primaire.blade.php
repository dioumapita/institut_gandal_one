{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Bulletin-Individuel'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Bulletin Annuel De Note</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Elèves</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Bulletin Annuel De Note</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Bulletin Annuel De Note De La {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</header>
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
                                <a href="#" id="addRow"
                                    class="btn btn-info">
                                        <i class="fa fa-reply"></i> Retour
                                </a>
                            </div>
                            {{-- <input class="btn btn-primary" type="button" value="Imprimer tous les bulletins des élèves" class="noprint" onclick="$('.printable,#break_page').printThis();"> --}}
                            <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="Imprimer tous les bulletins des élèves" />
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <button id="addRow1" class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">
                                    Choisir une autre classe ou une autre période  <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- debut modal -->
                                <div class="modal fade" data-backdrop="static" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Bulletin Indivuduel De Note</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>
                                            <!-- start modal body -->
                                                <div class="modal-body">
                                                    <form action="{{ route('bulletin_par_niveau') }}" method="GET">
                                                        <div class="form-group">
                                                            <label for="niveau_id">Selectionner une classe</label>
                                                            <select class="form-control" name="niveau_id" id="niveau_id">
                                                                @foreach ($all_classes as $key => $classe)
                                                                    <option value="{{ $classe->id }}" @if($classe->id == $niveau_choisi->id) selected @endif>{{ $classe->nom_niveau.' '.$classe->options}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="trimestre_id">Selectionner une période</label>
                                                            <select class="form-control" name="trimestre_id" id="trimestre_id">
                                                                <option value="resultat_annuel">Résultat Annuel</option>
                                                                @foreach ($all_trimestres as $key => $trimestre)
                                                                    <option value="{{ $trimestre->id }}">{{ $trimestre->nom_trimestre}}</option>
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
                            <!-- fin modal -->
                        </div>
                    </div>

                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th> Rang </th>
                                    <th> Matricule </th>
                                    <th> Prénom et Nom </th>
                                    <th> Genre </th>
                                    <th> Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classements as $classement)
                                    <tr>
                                        <td>{{ $i++}}</td>
                                        <td>{{ $classement->eleve->matricule }}</td>
                                        <td>{{ $classement->eleve->nom.' '.$classement->eleve->prenom }}</td>
                                        <td>{{ $classement->eleve->sexe }}</td>
                                        <td>{{ $classement->moyenne }}</td>
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
                            font-size: medium;
                        }
                        #bordure_table2
                        {
                            border: 2px solid black !important;
                            line-height: 12px;
                            font-size:medium;
                        }
                        #bordure_table3
                        {
                            border: 2px solid black !important;
                            font-size: medium;
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
                                      Bulletin Annuel De Note
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
                            <div>
                                <table class="table table-bordered">
                                    <thead id="bordure_table">
                                        <tr id="bordure_table">
                                            <th rowspan="2" id="bordure_table"><div class="text-center">@lang('home.Matieres')</div></th>
                                            <th rowspan="2" id="bordure_table"><div class="text-center">1er Trimestre</div></th>
                                            <th rowspan="2" id="bordure_table"><div class="text-center">2ème Trimestre</div></th>
                                            <th rowspan="2" id="bordure_table"><div class="text-center">3ème Trimestre</div></th>
                                            <th rowspan="2" id="bordure_table"><div class="text-center">Moyenne Annuelle</div></th>
                                            {{-- <th rowspan="2" id="bordure_table"><div class="text-center">Obs</div></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="bordure_table">
                                        @foreach ($notes as $note)
                                           @foreach($note->groupBy('eleve_id') as $nt)
                                                @if($nt[0]->eleve_id == $classement->eleve->id)
                                                    <tr id="bordure_table2">
                                                        <td class="text-center" style="white-space: normal; word-wrap: break-word;min-width: 160px;max-width: 160px;" id="bordure_table2">
                                                            {{$note->first()->matiere->nom_matiere}}
                                                        </td>
                                                        <td class="text-center" id="bordure_table2">
                                                            @if (isset($nt[0]))
                                                                 @if ($nt[0]->trimestre_id == 13)
                                                                    @if($nt[0]->moyenne == null)

                                                                    @else
                                                                        {{ bcdiv($nt[0]->moyenne,1,2) }}
                                                                    @endif
                                                                 @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-center" id="bordure_table2">
                                                            @if(isset($nt[0]))
                                                                @if($nt[0]->trimestre_id == 14)
                                                                    @if($nt[0]->moyenne == null)

                                                                    @else
                                                                        {{ bcdiv($nt[0]->moyenne,1,2) }}
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            @if(isset($nt[1]))
                                                                @if($nt[1]->trimestre_id == 14)
                                                                    @if($nt[1]->moyenne == null)

                                                                    @else
                                                                        {{ bcdiv($nt[1]->moyenne,1,2) }}
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-center" id="bordure_table2">
                                                            @if(isset($nt[2]))
                                                                @if($nt[2]->trimestre_id == 15)
                                                                    @if($nt[2]->moyenne == null)

                                                                    @else
                                                                        {{ bcdiv($nt[2]->moyenne,1,2) }}
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            @if(isset($nt[1]))
                                                                @if($nt[1]->trimestre_id == 15)
                                                                    @if($nt[1]->moyenne == null)

                                                                    @else
                                                                        {{ bcdiv($nt[1]->moyenne,1,2) }}
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            @if(isset($nt[0]))
                                                                @if($nt[0]->trimestre_id == 15)
                                                                    @if($nt[0]->moyenne == null)

                                                                    @else
                                                                        {{ bcdiv($nt[0]->moyenne,1,2) }}
                                                                    @endif
                                                                @endif
                                                           @endif
                                                        </td>
                                                        <td class="text-center" id="bordure_table2">
                                                            {{ bcdiv($nt->sum('moyenne') / $nt->count(),1,2) }}
                                                        </td>
                                                        {{-- <td class="text-center" id="bordure_table2">
                                                        </td> --}}
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach

                                        <tr id="bordure_table2">
                                            <td class="text-center" id="bordure_table2">
                                                Moyenne
                                            </td>
                                            <td class="text-center" id="bordure_table2">
                                                @foreach ($t1 as $trimestre1)
                                                   @if($classement->eleve->id == $trimestre1->eleve_id)
                                                        {{ bcdiv($trimestre1->moy,1,2) }}
                                                   @endif
                                               @endforeach
                                            </td>
                                            <td class="text-center" id="bordure_table2">
                                                @foreach ($t2 as $trimestre2)
                                                   @if($classement->eleve->id == $trimestre2->eleve_id)
                                                        {{ bcdiv($trimestre2->moy,1,2)}}
                                                   @endif
                                               @endforeach
                                            </td>
                                            <td class="text-center" id="bordure_table2">
                                                @foreach ($t3 as $trimestre3)
                                                    @if($classement->eleve->id == $trimestre3->eleve_id)
                                                        {{ bcdiv($trimestre3->moy,1,2) }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" id="bordure_table2">
                                                {{ $classement->moyenne }}
                                            </td>
                                            {{-- <td class="text-center" id="bordure_table2">
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <div class="pull-left">
                                        <h4 class="font-bold addr-font-h4">&emsp;&emsp;
                                            Appréciations générales:
                                            @if ($niveau_choisi->moyennee_admission == 5)
                                                    @if(0.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 4.99)
                                                            Insuffisant
                                                        @elseif(5.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 5.99)
                                                            Passable
                                                        @elseif(6.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 6.99)
                                                            Assez Bien
                                                        @elseif(7.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 7.99)
                                                            Bien
                                                        @elseif (8.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 8.99)
                                                            Très Bien
                                                        @elseif( 9.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 10.00)
                                                            Excellent
                                                        @endif
                                                    @elseif($niveau_choisi->moyennee_admission == 10)
                                                        @if(0.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 9.99)
                                                            Insuffisant
                                                        @elseif(10.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 11.99)
                                                            Passable
                                                        @elseif(12.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 13.99)
                                                            Assez Bien
                                                        @elseif(14.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 15.99)
                                                            Bien
                                                        @elseif (16.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 17.99)
                                                            Très Bien
                                                        @elseif( 18.00 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 20.00)
                                                            Excellent
                                                        @endif
                                                    @elseif($niveau_choisi->moyennee_admission == 50)
                                                        @if(0 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 49)
                                                            @lang('bulletin.Insuffisant')
                                                        @elseif(50 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 69)
                                                            @lang('bulletin.Passable')
                                                        @elseif(70 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 79)
                                                            @lang('bulletin.Assez_Bien')
                                                        @elseif (80 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 89)
                                                            @lang('bulletin.Tres_Bien')
                                                        @elseif( 90 <= floor(($classement->moyenne * 100)/100) AND floor(($classement->moyenne * 100)/100) <= 100)
                                                            @lang('bulletin.Excellent')
                                                        @endif
                                                    @else

                                                    @endif
                                        </h4>
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead class="text-center" id="bordure_table2">
                                                    <tr class="text-center" id="bordure_table2">
                                                        <th class="text-center" id="bordure_table2" colspan="2">Passe en classe supérieure</th>
                                                        <th class="text-center" id="bordure_table2" rowspan="2">Rédouble</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center" id="bordure_table2">
                                                    <tr class="text-center" id="bordure_table2">
                                                        <td class="text-center" id="bordure_table2" scope="row">Admis(e)</td>
                                                        <td class="text-center" id="bordure_table2">Repêché(e)</td>
                                                        <td class="text-center" id="bordure_table2" rowspan="2"></td>
                                                    </tr>
                                                    <tr class="text-center" id="bordure_table2">
                                                        <td class="text-center" id="bordure_table2" scope="row"></td>
                                                        <td class="text-center" id="bordure_table2"></td>
                                                        {{--  <td></td>  --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="">
                                        <h4 class=" pull-right font-bold addr-font-h4">@lang('note.Rang')
                                            @if ($b == 1 and $classement->eleve->sexe == 'Masculin')
                                                {{ $b++ }}<sup>er</sup> / {{ $total_eleves }}
                                            @elseif($b == 1 and $classement->eleve->sexe == 'Feminin')
                                                {{ $b++ }}<sup>ère</sup> / {{ $total_eleves }}
                                            @else
                                                {{ $b++ }}<sup>ème</sup> / {{ $total_eleves }}
                                            @endif
                                            <br>Conakry , @lang('liste_eleve.le') {{ date('d/m/Y') }}<br>@lang('liste_eleve.Direction')
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="break_page" style="page-break-after:always; display:block; position:relative;"></div>
        </div>
        @endforeach
    </div>
@endsection


