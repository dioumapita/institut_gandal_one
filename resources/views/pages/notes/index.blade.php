@extends($chemin_theme_actif,['title' => 'Notes-Listes'])
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
                <li><a class="parent-item" href="#">@lang('note.Notes')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('note.GestionDesNotes')</li>
            </ol>
        </div>
    </div>

    @if(empty($niveau_choisi))
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>@lang('note.GestionDesNotes')</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group pull-left">
                                    <div class="form-group">
                                        <label for="niveau">@lang('note.Select_classe')</label>
                                        <select onchange="window.location.href = this.value" id="niveau" class="form-control" name=niveau>
                                            <option value=""></option>
                                            @foreach ($all_niveaux as $key => $niveau)
                                                <option value="{{ route('note_par_niveau',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour')</a>
    <br>
        <div class="container mt-4 mx-auto col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('liste_eleve.Classe') {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down"
                            href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <!-- debut -->
                        <div class="state-overview">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-12 ">
                                    <a href="#" id="addRow1" data-toggle="modal" data-target="#ModeMultiple">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="material-icons">keyboard</i>
                                            </div>
                                            <div class="value white">
                                                <h3>@lang('note.SaisieDesNotes')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-6 col-md-6 col-12">
                                    <a href="#" data-toggle="modal" data-target="#ListeNotes">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="material-icons">view_list</i>
                                            </div>
                                            <div class="value white">
                                                <h3>@lang('note.ListeDesNotes')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <!-- fin -->
                    <div class="btn-group">
                        <!-- debut modal saisi de note-->
                            <div class="modal fade" data-backdrop="static" id="ModeMultiple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div  class="modal-header btn btn-danger text-center text-white">
                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('note.GestionDesNotes')</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                            </button>
                                        </div>
                                        <!-- start modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('saisie_note_mode_multiple') }}" method="GET">
                                                    <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                                    <div class="form-group">
                                                        <label for="">@lang('note.SelectMatiere')</label>
                                                        <select class="form-control" name="matiere" id="" required>
                                                        @foreach ($all_matieres as $key => $matiere)
                                                            <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Selectionnez un semestre</label>
                                                        <select class="form-control" name="trimestre" id="" required>
                                                        @foreach ($all_trimestre as $key => $trimestre)
                                                            <option value="{{ $trimestre->id }}">
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
                        <!-- fin modal saisie des notes -->
                        <!-- debut moda liste des note -->
                            <div class="modal fade" data-backdrop="static" id="ListeNotes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                                    <div class="form-group">
                                                        <label for="">@lang('note.SelectMatiere')</label>
                                                        <select class="form-control" name="matiere" id="" required>
                                                        @foreach ($all_matieres as $key => $matiere)
                                                            <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Selectionnez un semestre</label>
                                                        <select class="form-control" name="trimestre" id="" required>
                                                        @foreach ($all_trimestre as $key => $trimestre)
                                                            <option value="{{ $trimestre->id }}">
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
                        <!-- fin modal liste des notes -->
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
