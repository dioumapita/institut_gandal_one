{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Notes-Listes'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('note.ListeDesNotes')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('note.Notes')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('note.ListeDesNotes')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('note.ListeDesNotes') @lang('note.En') {{ $matiere_choisie->nom_matiere }}</header>

                    <div class="tools">
                        <!-- start bouton saisie des notes -->
                            <form action="{{ route('saisie_note_mode_multiple') }}" method="GET">
                                <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                <input type="hidden" name="matiere" value="{{ $matiere_choisie->id }}">
                                <input type="hidden" name="trimestre" value="{{ $trimestre_choisit->id }}">
                                <input type="hidden" name="annee" value="{{ $annee_choisie->id }}">
                                <button type="submit" class="btn-lg btn-primary">@lang('note.SaisieDesNotes')</button>
                            </form>
                        <!-- end bouton saisie des notes -->
                    </div>
                </div>
                <div class="card-body ">
                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-reply"></i>@lang('liste_eleve.Retour')</a>
                    <button id="addRow1" class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">
                        @lang('note.ChoixMatière')  <i class="fa fa-plus"></i>
                    </button>
                    <!-- debut modal choix matiere -->
                    <div class="modal fade" data-backdrop="static" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div  class="modal-header btn btn-danger text-center text-white">
                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('note.ListeDesNotes')</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                    </button>
                                </div>
                                <!-- start modal body -->
                                    <div class="modal-body">
                                        <form action="{{ route('note_filtrer') }}" method="GET">
                                            <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                            <input type="hidden" name="annee" id="annee" value="{{ $annee_choisie->id }}">
                                            <div class="form-group">
                                                <label for="">@lang('note.SelectMatiere')</label>
                                                <select class="form-control" name="matiere" id="">
                                                @foreach ($niveau_choisi->matieres as $key => $matiere)
                                                    <option value="{{ $matiere->id }}" @if($matiere->id == $matiere_choisie->id) selected @endif>{{ $matiere->nom_matiere}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Selectionnez Un Semestre</label>
                                                <select class="form-control" name="trimestre" id="">
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
                                                <button class="btn btn-dark" data-dismiss="modal">@lang('note.Annuler') <i class="fa fa-times"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                <!-- end modal body -->
                            </div>
                        </div>
                    </div>
                    <!-- fin modal choix matiere -->
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
                                                    <select onchange="window.location.href = this.value" id="niveau" class="form-control" name=niveau>
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
                    {{-- <a id="imprimer" href="#" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer La Liste Des Notes Elèves</a> --}}
                    {{-- <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="@lang('liste_eleve.Imprimer')" /> --}}
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
                                <h5 class="text-bold full-width">@lang('note.Barème') {{$bareme}}</h5>
                            </div>
                        </div>
                    </div>
                        <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                    style="width: 100%" id="liste_notes">
                                    <thead>
                                        <tr>
                                            <th style="width:8%;"> @lang('liste_eleve.Matricule') </th>
                                            <th style="width:8%;"> @lang('liste_eleve.Nom') </th>
                                            <th style="width:18%;"> @lang('liste_eleve.Prenom') </th>
                                            @if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35)
                                                <th class="text-center">Note</th>
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
                                                <th class="text-center">Composition</th>
                                            @endif
                                            <th class="text-center"> @lang('note.Moy') </th>
                                            <th class="text-center"> @lang('note.Rang')</th>
                                            <th> @lang('liste_eleve.Actions') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notes as $note)
                                            <tr class="odd gradeX">
                                                <td id="matricule">
                                                    {{ $note->eleve->matricule}}
                                                </td>
                                                <td>
                                                    {{ $note->eleve->nom}}
                                                </td>
                                                <td>
                                                    {{ $note->eleve->prenom }}
                                                </td>
                                                    @if($niveau_choisi->id > 18 AND $niveau_choisi->id <= 34)
                                                        @if($trimestre_choisit->mois1 != null)
                                                            <td class="text-center">
                                                                @if(is_null($note->note1))

                                                                @else
                                                                    {{ $note->note1 }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                        @if($trimestre_choisit->mois2 != null)
                                                            <td class="text-center">
                                                                @if(is_null($note->note2))

                                                                @else
                                                                    {{ $note->note2 }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                        @if($trimestre_choisit->mois3 != null)
                                                            <td class="text-center">
                                                                @if(is_null($note->note3))

                                                                @else
                                                                    {{ $note->note3 }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td class="text-center">
                                                            @if(is_null($note->composition))

                                                            @else
                                                                {{ $note->composition }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35)
                                                    <td class="text-center">
                                                        {{ $note->note3 }}
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    @if(is_null($note->moyenne))

                                                    @else
                                                        {{ $note->moyenne }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if(LaravelLocalization::getCurrentLocale() == 'fr')
                                                        @if ($rang == 1 and $note->eleve->sexe == 'Masculin')
                                                            {{ $rang++.' er' }}
                                                        @elseif($rang == 1 and$note->eleve->sexe == 'Feminin')
                                                                {{ $rang++.' ère' }}
                                                        @else
                                                                {{ $rang++.' ème' }}
                                                        @endif
                                                    @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                                        @if($rang == 1)
                                                            {{ $rang++.' st' }}
                                                        @elseif($rang == 2)
                                                            {{ $rang++.' nd' }}
                                                        @elseif($rang == 3)
                                                            {{ $rang++.' rd' }}
                                                        @else
                                                            {{ $rang++.' th' }}
                                                        @endif
                                                    @else

                                                    @endif
                                                </td>
                                                <td>
                                                    <a  href="#modif_note" data-toggle="modal" data-target="#modif_note{{ $note->eleve->id }}"
                                                        class=" btn btn-primary">
                                                        <i class="fa fa-pencil"></i> @lang('liste_eleve.Modifier')
                                                    </a>
                                                    <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $note->eleve->id }})"
                                                        class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> @lang('liste_eleve.Supprimer')
                                                    </a>
                                                    <!-- Start modal -->
                                                        <div class="container">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modif_note{{ $note->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                            <h4 class="modal-title text-center" id="myModalLabel">@lang('note.ModifNotes')</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="center">
                                                                                <img src="/images/photos/eleves/{{ $note->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                <h4 class="media-heading">{{ $note->eleve->nom.' '.$note->eleve->prenom }} <br>
                                                                                    @lang('liste_eleve.Matricule') {{ $note->eleve->matricule }}
                                                                                </h4>
                                                                            </div>
                                                                            <form action="{{ route('modification_note',$note->eleve->id) }}" method="post">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('PUT') }}
                                                                                <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                                                <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                                                <input type="hidden" name="coefficient" value="{{ $coefficient }}">
                                                                                <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisit->id }}">
                                                                                @if($niveau_choisi->id > 18 AND $niveau_choisi->id <= 34)
                                                                                    <!-- start note1 -->
                                                                                        @if($trimestre_choisit->mois1 != null)
                                                                                            <div class="form-group">
                                                                                                <label for="note1" class="control-label col-md-3 text-center">&nbsp;
                                                                                                    @if($trimestre_choisit->mois1 != null)
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
                                                                                                    @endif
                                                                                                </label>
                                                                                                <div class="input-group spinner">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-info" data-dir="dwn"
                                                                                                            type="button">
                                                                                                            <span class="fa fa-minus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                    <input type="number" id="note1" name="note1"
                                                                                                        class="form-control text-center"
                                                                                                        value="{{ $note->note1 }}" min="0" max="{{ $bareme }}" step="0.01">
                                                                                                        &nbsp;
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                            <span class="fa fa-plus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    <!-- end note1 -->
                                                                                    <!-- start note2 -->
                                                                                        @if($trimestre_choisit->mois2 != null)
                                                                                            <div class="form-group">
                                                                                                <label for="note2" class="control-label col-md-3 text-center">
                                                                                                    @if($trimestre_choisit->mois2 != null)
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
                                                                                                    @endif
                                                                                                </label>
                                                                                                <div class="input-group spinner">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-info" data-dir="dwn"
                                                                                                            type="button">
                                                                                                            <span class="fa fa-minus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                    <input type="number" id="note2" name="note2"
                                                                                                        class="form-control text-center"
                                                                                                        value="{{ $note->note2 }}" min="0" max="{{ $bareme }}" step="0.01">
                                                                                                        &nbsp;
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                            <span class="fa fa-plus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    <!-- end note2 -->
                                                                                    <!-- start note3 -->
                                                                                        @if($trimestre_choisit->mois3 != null)
                                                                                            <div class="form-group">
                                                                                                <label for="composition" class="control-label col-md-3 text-center">
                                                                                                    @if($trimestre_choisit->mois3 != null)
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
                                                                                                    @endif
                                                                                                </label>
                                                                                                <div class="input-group spinner">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-info" data-dir="dwn"
                                                                                                            type="button">
                                                                                                            <span class="fa fa-minus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                    <input type="number" id="note3" name="note3"
                                                                                                        class="form-control text-center"
                                                                                                        value="{{ $note->note3 }}" min="0" max="{{ $bareme }}" step="0.01">
                                                                                                        &nbsp;
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                            <span class="fa fa-plus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    <!-- end note3 -->
                                                                                    <!-- start composition -->
                                                                                        <div class="form-group">
                                                                                            <label for="composition" class="control-label col-md-4 text-center">
                                                                                                Composition
                                                                                            </label>
                                                                                            <div class="input-group spinner">
                                                                                                <span class="input-group-btn">
                                                                                                    <button class="btn btn-info" data-dir="dwn"
                                                                                                        type="button">
                                                                                                        <span class="fa fa-minus"></span>
                                                                                                    </button>
                                                                                                </span>
                                                                                                <input type="number" id="composition" name="composition"
                                                                                                    class="form-control text-center"
                                                                                                    value="{{ $note->composition }}" min="0" max="{{ $bareme }}" step="0.01">
                                                                                                    &nbsp;
                                                                                                <span class="input-group-btn">
                                                                                                    <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                        <span class="fa fa-plus"></span>
                                                                                                    </button>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    <!-- end composition -->
                                                                                @endif
                                                                                @if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35)
                                                                                    <!-- start composition toto -->
                                                                                        <div class="form-group">
                                                                                            <label for="note3" class="control-label col-md-4 text-center">
                                                                                                Note
                                                                                            </label>
                                                                                            <div class="input-group spinner">
                                                                                                <span class="input-group-btn">
                                                                                                    <button class="btn btn-info" data-dir="dwn"
                                                                                                        type="button">
                                                                                                        <span class="fa fa-minus"></span>
                                                                                                    </button>
                                                                                                </span>
                                                                                                <input type="number" id="note3" name="note3"
                                                                                                    class="form-control text-center"
                                                                                                    value="{{ $note->note3 }}" min="0" max="{{ $bareme }}" step="0.01">
                                                                                                    &nbsp;
                                                                                                <span class="input-group-btn">
                                                                                                    <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                        <span class="fa fa-plus"></span>
                                                                                                    </button>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    <!-- end composition -->
                                                                                @endif
                                                                                <div class="modal-footer d-flex justify-content-center">
                                                                                    <button type="submit" class="btn btn-primary" >@lang('note.Valider') <i class="fa fa-check"></i></button>
                                                                                    &nbsp;&nbsp;
                                                                                    <button class="btn btn-danger" data-dismiss="modal">@lang('note.Annuler') <i class="fa fa-times"></i></button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- End Modal -->
                                                    <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                        <div class="mt-5 modal-dialog modal-confirm">
                                                            <div class="modal-content">
                                                                <div class="modal-header flex-column">
                                                                    <div class="icon-box">
                                                                        <i class="material-icons">&#xE5CD;</i>
                                                                    </div>
                                                                    <h4 class="modal-title w-100">@lang('note.Confirmation')?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- <p>
                                                                        Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                    </p> --}}
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('note.Annuler')</button>
                                                                    <form action="{{ route('suppression_note',$note->eleve->id) }}" method="post" id="deleteform">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                         <input type="hidden" name="matiere_choisie" value="{{ $matiere_choisie->id }}">
                                                                         <input type="hidden" name="trimestre_choisit" value="{{ $trimestre_choisit->id }}">
                                                                        <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                            @lang('note.OuiSupprimer')
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
             var url = '{{ route("suppression_note", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
