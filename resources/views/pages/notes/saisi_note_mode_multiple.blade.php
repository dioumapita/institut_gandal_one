@extends($chemin_theme_actif,['title' => 'Notes-Saisi'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('note.GestionDesNotes')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Notes</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('note.GestionDesNotes')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{-- <div class="">
                <ul class="nav customtab nav-tabs">
                    <li class="nav-item">
                        <a href="#" class="nav-link active ">
                            Mode de saisie multiple
                        </a>
                    </li>
                </ul>
            </div> --}}
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('note.GestionDesNotes')</header>
                    <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="@lang('liste_eleve.Imprimer')" />
                    <div class="tools">
                        <!-- start liste des notes -->
                            <form action="{{ route('note_filtrer') }}" method="GET">
                                <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                <input type="hidden" name="matiere" value="{{ $matiere_choisie->id }}">
                                <input type="hidden" name="trimestre" value="{{ $trimestre_choisit->id }}">
                                <input type="hidden" name="annee" value="{{ $annee_choisie->id }}">
                                <button type="submit" class="btn-lg btn-primary">@lang('note.ListeDesNotes')</button>
                            </form>
                        <!-- end liste des notes -->
                    </div>
                </div>
                <div class="card-body ">
                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour')</a>
                    <button id="addRow1" class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">
                        @lang('note.ChoixMatière')  <i class="fa fa-plus"></i>
                    </button>
                    <!-- debut modal choix de matière -->
                        <div class="modal fade" data-backdrop="static" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div  class="modal-header btn btn-danger text-center text-white">
                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('note.ChoixMatière')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!-- start modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('saisie_note_mode_multiple') }}" method="GET">
                                                <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                                <input type="hidden" name="annee" id="annee" value="{{ $annee_choisie->id }}">
                                                <div class="form-group">
                                                    <label for="">@lang('note.SelectMatiere')</label>
                                                    <select class="form-control" name="matiere" id="" required>
                                                    @foreach ($niveau_choisi->matieres as $key => $matiere)
                                                        <option value="{{ $matiere->id }}" @if($matiere->id == $matiere_choisie->id) selected @endif>{{ $matiere->nom_matiere}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">@lang('note.SelectTrimestre')</label>
                                                    <select class="form-control" name="trimestre" id="" required>
                                                    @foreach ($all_trimestres as $key => $trimestre)
                                                        <option value="{{ $trimestre->id }}" @if($trimestre->id == $trimestre_choisit->id) selected @endif>
                                                            @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                                                {{ $trimestre->nom_trimestre}}
                                                            @else
                                                                {{ "Quarter ".$trimestre->id }}
                                                            @endif
                                                        </option>
                                                    @endforeach
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
                    <!-- fin modal choix de matière -->
                    <button id="addRow1" class="btn btn-primary" data-toggle="modal" data-target="#modalchangeclasse">
                        @lang('note.ChoixClasse')  <i class="fa fa-plus"></i>
                    </button>
                    <!-- debut modal choix de classe -->
                        <div class="modal fade" data-backdrop="static" id="modalchangeclasse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div  class="modal-header btn btn-danger text-center text-white">
                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('note.ChoixClasse')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!-- start modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('saisie_note_mode_multiple') }}" method="GET">
                                                <div class="form-group">
                                                    <label for="niveau">@lang('note.Select_classe')</label>
                                                    <select onchange="window.location.href = this.value" id="niveau" class="form-control" name=niveau required>
                                                        <option value=""></option>
                                                        @foreach ($all_niveaux as $key => $niveau)
                                                            <option value="{{ route('note_par_niveau',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options }}</option>
                                                        @endforeach
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
                    <!-- fin modal choix de classe -->
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-7">
                            <div class="col-md-7 col-sm-7 col-7">
                                <h4 class="text-bold full-width">@lang('liste_eleve.Classe') : {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</h4>
                                <h5 class="text-bold full-width">@lang('home.Matieres') : {{ $matiere_choisie->nom_matiere }}</h5>
                                <h5 class="text-bold full-width">@lang('note.Coefficient') : {{ $coefficient }}</h5>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-5">
                            <div class="pull-right col-md-5 col-sm-5 col-5">
                            <br>
                                <h5 class="text-bold full-width">
                                    @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                        {{ $trimestre_choisit->nom_trimestre }}
                                    @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                            {{ "Quarter ".$trimestre_choisit->id }}
                                    @else

                                    @endif
                                </h5>
                                <h5 class="text-bold full-width">@lang('note.Barème') {{ $bareme }}</h5>
                            </div>
                        </div>
                    </div>
                        <div class="table-scrollable">
                            <form action="{{ route('enregistre_multiple_note')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> Matricule </th>
                                            <th> Prénom et Nom </th>
                                            @if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35)
                                                <th class="text-center">{{ $matiere_choisie->nom_matiere  }}</th>
                                            @endif
                                            @if($niveau_choisi->id > 18 AND $niveau_choisi->id <= 34)
                                                @if($trimestre_choisit->mois1 != null)
                                                    <th class="text-center">
                                                        @if($trimestre_choisit->mois1 == 1)
                                                            @lang('mois.Janvier')
                                                        @elseif($trimestre_choisit->mois1 == 2)
                                                            @lang('mois.Fevrier')
                                                        @elseif($trimestre_choisit->mois1 == 3)
                                                            @lang('mois.Mars')
                                                        @elseif($trimestre_choisit->mois1 == 4)
                                                            @lang('mois.Avril')
                                                        @elseif($trimestre_choisit->mois1 == 5)
                                                            @lang('mois.Mai')
                                                        @elseif($trimestre_choisit->mois1 == 6)
                                                            @lang('mois.Juin')
                                                        @elseif($trimestre_choisit->mois1 == 7)
                                                            @lang('mois.Juillet')
                                                        @elseif($trimestre_choisit->mois1 == 8)
                                                            @lang('mois.Août')
                                                        @elseif($trimestre_choisit->mois1 == 9)
                                                            @lang('mois.Septembre')
                                                        @elseif($trimestre_choisit->mois1 == 10)
                                                            @lang('mois.Octobre')
                                                        @elseif($trimestre_choisit->mois1 == 11)
                                                            @lang('mois.Novembre')
                                                        @elseif($trimestre_choisit->mois1 == 12)
                                                            @lang('mois.Décembre')
                                                        @else

                                                        @endif
                                                    </th>
                                                @endif
                                                @if($trimestre_choisit->mois2 != null)
                                                    <th class="text-center">
                                                        @if($trimestre_choisit->mois2 == 1)
                                                            @lang('mois.Janvier')
                                                        @elseif($trimestre_choisit->mois2 == 2)
                                                            @lang('mois.Fevrier')
                                                        @elseif($trimestre_choisit->mois2 == 3)
                                                            @lang('mois.Mars')
                                                        @elseif($trimestre_choisit->mois2 == 4)
                                                            @lang('mois.Avril')
                                                        @elseif($trimestre_choisit->mois2 == 5)
                                                            @lang('mois.Mai')
                                                        @elseif($trimestre_choisit->mois2 == 6)
                                                            @lang('mois.Juin')
                                                        @elseif($trimestre_choisit->mois2 == 7)
                                                            @lang('mois.Juillet')
                                                        @elseif($trimestre_choisit->mois2 == 8)
                                                            @lang('mois.Août')
                                                        @elseif($trimestre_choisit->mois2 == 9)
                                                            @lang('mois.Septembre')
                                                        @elseif($trimestre_choisit->mois2 == 10)
                                                            @lang('mois.Octobre')
                                                        @elseif($trimestre_choisit->mois2 == 11)
                                                            @lang('mois.Novembre')
                                                        @elseif($trimestre_choisit->mois2 == 12)
                                                            @lang('mois.Décembre')
                                                        @else

                                                        @endif
                                                    </th>
                                                @endif
                                                @if($trimestre_choisit->mois3 != null)
                                                    <th class="text-center">
                                                        @if($trimestre_choisit->mois3 == 1)
                                                            @lang('mois.Janvier')
                                                        @elseif($trimestre_choisit->mois3 == 2)
                                                            @lang('mois.Fevrier')
                                                        @elseif($trimestre_choisit->mois3 == 3)
                                                            @lang('mois.Mars')
                                                        @elseif($trimestre_choisit->mois3 == 4)
                                                            @lang('mois.Avril')
                                                        @elseif($trimestre_choisit->mois3 == 5)
                                                            @lang('mois.Mai')
                                                        @elseif($trimestre_choisit->mois3 == 6)
                                                            @lang('mois.Juin')
                                                        @elseif($trimestre_choisit->mois3 == 7)
                                                            @lang('mois.Juillet')
                                                        @elseif($trimestre_choisit->mois3 == 8)
                                                            @lang('mois.Août')
                                                        @elseif($trimestre_choisit->mois3 == 9)
                                                            @lang('mois.Septembre')
                                                        @elseif($trimestre_choisit->mois3 == 10)
                                                            @lang('mois.Octobre')
                                                        @elseif($trimestre_choisit->mois3 == 11)
                                                            @lang('mois.Novembre')
                                                        @elseif($trimestre_choisit->mois3 == 12)
                                                            @lang('mois.Décembre')
                                                        @else

                                                        @endif
                                                    </th>
                                                @endif
                                                    <th class="text-center">
                                                        Composition
                                                    </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eleves_inscrits as $inscrits)
                                            <tr class="odd gradeX">
                                                <td>
                                                    {{ $inscrits->eleve->matricule}}
                                                </td>
                                                <td>
                                                    {{ $inscrits->eleve->prenom.' '.$inscrits->eleve->nom }}
                                                </td>
                                                @if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35 )
                                                    <td class="text-center">
                                                        <input type="hidden" name="eleve_id[]" value="{{ $inscrits->eleve->id }}">
                                                        <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                        <input type="hidden" name="matiere_id[]" value="{{ $matiere_choisie->id }}">
                                                        <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisit->id }}">
                                                        <input type="hidden" name="annee_id" value="{{ $annee_choisie->id }}">
                                                        <input type="hidden" name="coefficient" value="{{ $coefficient }}">
                                                        <input type="number" name="note3[]" id="note3" min="0" max="{{ $bareme }}" step="0.01"
                                                            value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note3')->first() }}"
                                                            style="width: 9em">
                                                    </td>
                                                @endif
                                                @if($niveau_choisi->id > 18 AND $niveau_choisi->id <= 34)
                                                    @if($trimestre_choisit->mois1 != null)
                                                        <td class="text-center"  width="15%">

                                                            <input type="hidden" name="eleve_id[]" value="{{ $inscrits->eleve->id }}">
                                                            <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                            <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                            <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisit->id }}">
                                                            <input type="hidden" name="annee_id" value="{{ $annee_choisie->id }}">
                                                            <input type="hidden" name="coefficient" value="{{ $coefficient }}">
                                                            <input type="hidden" name="nom_matiere" value="{{ $matiere_choisie->nom_matiere }}">
                                                            <input type="number" name="note1[]" id="note1" min="0" max="{{ $bareme }}" step="0.01"
                                                                    value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note1')->first()}}"
                                                                    class="col-md-5">
                                                        </td>
                                                    @endif
                                                    @if($trimestre_choisit->mois2 != null)
                                                        <td  class="text-center" width="15%">
                                                            <input type="number" name="note2[]" id="" min="0" max="{{ $bareme }}" step="0.01"
                                                                    value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note2')->first()}}"
                                                                    class="col-md-5"
                                                            >
                                                        </td>
                                                    @endif
                                                    @if($trimestre_choisit->mois3 != null)
                                                        <td  class="text-center" width="15%">
                                                            <input type="number" name="note3[]" id="" min="0" max="{{ $bareme }}" step="0.01"
                                                                    value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note3')->first()}}"
                                                                    class="col-md-5"
                                                            >
                                                        </td>
                                                    @endif
                                                        <td class="text-center" width="15%">
                                                            <input type="number" name="composition[]" id="" min="0" max="{{ $bareme }}" step="0.01"
                                                                value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('composition')->first()}}"
                                                                class="col-md-5"
                                                            >
                                                        </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group col-4">
                                    <label for="niveau">Selectionnez le fichier</label>
                                    <div class="form-group">
                                        <input type="file" name="photo_note" id="photo_note" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>@lang('note.Valider')</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div id="imprime" class="row">
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
                        <br>
                        <div class="row col-md-12 col-sm-12 col-lg-12">
                            <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                <div class="cercle">
                                    <div class="text-center">
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">Fiche De Note</u><br>
                                            <u class="souligner">
                                                @lang('liste_eleve.Classe') {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }} <br>
                                                @lang('liste_eleve.Annee_Scolaire2') {{ $annee_choisie->annee_scolaire }}
                                            </u>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pull-left">
                            <h4 class="font-bold addr-font-h4">&emsp;
                             @lang('home.Matieres') : {{ $matiere_choisie->nom_matiere }}
                            <br>
                             &emsp; @lang('note.Coefficient') : {{ $coefficient }}
                            <br>
                            &emsp;&nbsp;
                            @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                            {{ $trimestre_choisit->nom_trimestre }}
                            @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                                {{ "Quarter ".$trimestre_choisit->id }}
                            @else

                            @endif
                            </h4>
                            <br>
                        </div>

                        <div>
                                <table class="table table-bordered">
                                    <thead id="bordure_table">
                                        <th class="text-center" id="bordure_table">@lang('liste_eleve.Matricule')</th>
                                        <th class="text-center" id="bordure_table">Elève</th>
                                        <th class="text-center" id="bordure_table">{{ $matiere_choisie->nom_matiere  }}</th>
                                    </thead>
                                    <tbody id="bordure_table">
                                        @foreach ($eleves_inscrits as $inscrits)
                                            <tr>
                                                <td  id="bordure_table"> {{ $inscrits->eleve->matricule }} </td>
                                                <td  id="bordure_table"> {{ $inscrits->eleve->prenom.' '.$inscrits->eleve->nom }} </td>
                                                <td  id="bordure_table"> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="">
                            <h4 class=" pull-right font-bold addr-font-h4">
                              Conakry, @lang('liste_eleve.le') {{ date('d/m/Y') }}<br><br>@lang('liste_eleve.Direction')
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
