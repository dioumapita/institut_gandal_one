{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Classement-Eleve'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('classement.ClassementDesEleve')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('classement.Classement')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('classement.ClassementDesEleve')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('classement.ClassementDesEleve') @lang('liste_eleve.De') @lang('liste_eleve.la') {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }} @lang('classement.Pour') @lang('liste_eleve.le')
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
                            <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="@lang('liste_eleve.Imprimer') @lang('liste_eleve.le') @lang('classement.Classement')"/>
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
                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('classement.Classement')</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>
                                            <!-- start modal body -->
                                                <div class="modal-body">
                                                    <form action="{{ route('classements_des_eleves_par_niveau') }}" method="GET">
                                                        <div class="form-group">
                                                            <label for="niveau_id">@lang('note.ChoixClasse')</label>
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
                                                                <option value="final">Classement Final</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">@lang('liste_eleve.Modifier') <i class="fa fa-check"></i></button>
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
                                    <th> Prénom Et Nom </th>
                                    <th> @lang('classement.Genre') </th>
                                    <th>@lang('note.Moyenne')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classements as $classement)
                                    @if ($classement->moy >= $niveau_choisi->moyennee_admission)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $classement->eleve->id }}</td>
                                            <td>{{ $classement->eleve->prenom.' '.$classement->eleve->nom }}</td>
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
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $classement->eleve->id }}</td>
                                            <td>{{ $classement->eleve->prenom.' '.$classement->eleve->nom }}</td>
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
                                            <td class="moyenne_faible">{{ bcdiv($classement->moy,1,2) }}</td>
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
                                        <h4 class="text-center font-bold addr-font-h4">
                                            <u class="souligner">@lang('classement.ClassementDesEleve') @lang('liste_eleve.De') @lang('liste_eleve.la') {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</u><br>
                                            <u class="souligner">
                                            @lang('classement.Pour') @lang('liste_eleve.le')
                                                @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                                    {{ $trimestre_choisi->nom_trimestre }}
                                                @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                                    {{ "Quarter ".$trimestre_choisi->id }}
                                                @else

                                                @endif
                                            @lang('liste_eleve.De') @lang('liste_eleve.Annee_Scolaire') <br> {{ $annee_courante->annee_scolaire }}
                                            </u>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <p class="text-center font-bold addr-font-h4"><u>@lang('liste_eleve.Table_Statistique')</u></p>
                            <div>
                                <table class="table table-bordered">
                                    <thead id="bordure_table">
                                        <tr id="bordure_table">
                                            <th colspan="3" class="text-center" id="bordure_table"> @lang('liste_eleve.Inscrit') </th>
                                            <th colspan="3" class="text-center" id="bordure_table"> @lang('classement.Evaluer')</th>
                                            <th colspan="3" class="text-center" id="bordure_table"> @lang('classement.Admis') </th>
                                            <th colspan="3" class="text-center" id="bordure_table"> @lang('classement.Taux')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Total2')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Garçon')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Fille')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Total2')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Garçon')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Fille')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Total2')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Garçon')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Fille')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Total2')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Garçon')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Fille')</td>
                                        </tr>
                                        <tr>

                                            <td class="text-center" id="bordure_table">{{ $total_inscrit->count() }}</td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_garçon_inscrit = 0;
                                                @endphp
                                                @foreach ($total_inscrit as $inscrit)
                                                    @if ($inscrit->eleve->sexe == 'Masculin')
                                                        @php
                                                            $nbre_garçon_inscrit++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_garçon_inscrit }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_fille_inscrit = 0;
                                                @endphp
                                                @foreach ($total_inscrit as $inscrit)
                                                    @if ($inscrit->eleve->sexe == 'Feminin')
                                                        @php
                                                            $nbre_fille_inscrit++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_fille_inscrit }}
                                            </td>

                                            <td class="text-center" id="bordure_table">{{ $classements->count() }}</td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_garçon_evaluer = 0;
                                                @endphp
                                                @foreach ($classements as $classement)
                                                    @if ($classement->eleve->sexe == 'Masculin')
                                                        @php
                                                            $nbre_garçon_evaluer++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_garçon_evaluer }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_fille_evaluer = 0;
                                                @endphp
                                                @foreach ($classements as $classement)
                                                    @if ($classement->eleve->sexe == 'Feminin')
                                                        @php
                                                            $nbre_fille_evaluer++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_fille_evaluer }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_eleve_admis = 0;
                                                @endphp
                                                @foreach ($classements as $classement)
                                                    @if ($classement->moy >= $niveau_choisi->moyennee_admission)
                                                        @php
                                                            $nbre_eleve_admis++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_eleve_admis }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_garçon_admis = 0;
                                                @endphp
                                                @foreach ($classements as $classement)
                                                    @if ($classement->eleve->sexe == 'Masculin' and $classement->moy >= $niveau_choisi->moyennee_admission)
                                                            @php
                                                                $nbre_garçon_admis++;
                                                            @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_garçon_admis }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_fille_admis = 0;
                                                @endphp
                                                @foreach ($classements as $classement)
                                                    @if ($classement->eleve->sexe == 'Feminin' and $classement->moy >= $niveau_choisi->moyennee_admission)
                                                            @php
                                                                $nbre_fille_admis++;
                                                            @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_fille_admis }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @if ($nbre_eleve_admis == 0)
                                                    {{ $nbre_eleve_admis.'%' }}
                                                @else
                                                @php
                                                $taux_reussite = ($nbre_eleve_admis * 100)/$classements->count();
                                                    @endphp

                                                    @if(is_float($taux_reussite))
                                                    {{ number_format($taux_reussite,2).'%' }}
                                                    @else
                                                    {{ $taux_reussite.'%' }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @if ($nbre_garçon_evaluer == 0)
                                                    {{ $nbre_garçon_evaluer.'%' }}
                                                @else
                                                    @php
                                                    $taux_reussite_garçon = ($nbre_garçon_admis * 100)/$nbre_garçon_evaluer;
                                                    @endphp
                                                    @if (is_float($taux_reussite_garçon))
                                                        {{ number_format($taux_reussite_garçon,2).'%' }}
                                                    @else
                                                        {{ $taux_reussite_garçon.'%' }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @if ($nbre_fille_evaluer == 0)
                                                    {{ $nbre_fille_evaluer.'%' }}
                                                @else
                                                    @php
                                                    $taux_reussite_fille = ($nbre_fille_admis * 100)/$nbre_fille_evaluer;
                                                    @endphp
                                                    @if (is_float($taux_reussite_fille))
                                                        {{ number_format($taux_reussite_fille,2).'%' }}
                                                    @else
                                                        {{ $taux_reussite_fille.'%' }}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div>
                            <p class="text-center font-bold addr-font-h4"><u>@lang('classement.Classement')</u></p>
                            <table class="table table-bordered">
                                <th class="text-center" id="bordure_table">@lang('note.Rang')</th>
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Matricule')</th>
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Nom') @lang('note.Et') @lang('liste_eleve.Prenom')</th>
                                <th class="text-center" id="bordure_table">@lang('classement.Genre')</th>
                                <th class="text-center" id="bordure_table">@lang('note.Moyenne')</th>
                                <tbody id="bordure_table">
                                    @foreach ($classements as $classement)
                                        <tr class="odd gradeX" id="bordure_table">
                                            <td class="text-center" id="bordure_table">{{ $b++ }}</td>
                                            <td class="text-center" id="bordure_table">{{ $classement->eleve->id }}</td>
                                            <td id="bordure_table">{{ $classement->eleve->prenom.' '.$classement->eleve->nom }}</td>
                                            <td class="text-center" id="bordure_table">
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
                                            <td class="text-center" id="bordure_table">{{ floor($classement->moy * 100)/100 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            <br>
                            <h4 class=" pull-right font-bold addr-font-h4">
                                Conakry , @lang('liste_eleve.le') {{ date('d/m/Y') }}
                                    <br><br>
                                    @lang('liste_eleve.Direction')
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
