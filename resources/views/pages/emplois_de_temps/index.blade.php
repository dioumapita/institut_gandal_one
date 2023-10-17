{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Emplois-Listes'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('emplois_temps.GestionEmplois')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('home.EmploisDeTemps')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('emplois_temps.GestionEmplois')</li>
            </ol>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour')</a>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('emplois_temps.GestionEmplois')</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <!-- debut -->
                        <div class="state-overview">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-12 ">
                                    <a href="#" id="addRow1" data-toggle="modal" data-target="#creation">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="material-icons">keyboard</i>
                                            </div>
                                            <div class="value white">
                                                <h3>@lang('emplois_temps.CreateEmplois')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-6 col-md-6 col-12">
                                    <a href="#" data-toggle="modal" data-target="#listeemplois">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="material-icons">view_list</i>
                                            </div>
                                            <div class="value white">
                                                <h3>@lang('emplois_temps.ListeEmplois')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <!-- fin -->
                    <!-- debut modal creation d'emplois du temps -->
                        <div class="modal fade" data-backdrop="static" id="creation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div  class="modal-header btn btn-danger text-center text-white">
                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('emplois_temps.CreateEmplois')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!-- start modal body -->
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">@lang('emplois_temps.SelectClasse')</label>
                                                    <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id" required>
                                                    <option value=""></option>
                                                    @foreach ($all_niveau as $key => $niveau)
                                                        <option value="{{ route('create_emplois_by_niveau',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button class="btn btn-primary" data-dismiss="modal">@lang('note.Annuler') <i class="fa fa-times"></i></button>
                                                </div>
                                        </div>
                                    <!-- end modal body -->
                                </div>
                            </div>
                        </div>
                    <!-- fin modal de creation d'emplois du temps -->
                    <!-- debut modal liste des emplois du temps -->
                        <div class="modal fade" data-backdrop="static" id="listeemplois" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div  class="modal-header btn btn-danger text-center text-white">
                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('emplois_temps.ListeEmplois')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!-- start modal body -->
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">@lang('emplois_temps.SelectClasse')</label>
                                                    <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id" required>
                                                    <option value=""></option>
                                                    @foreach ($all_niveau as $key => $niveau)
                                                        <option value="{{ route('emploi.show',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button class="btn btn-primary" data-dismiss="modal">@lang('note.Annuler') <i class="fa fa-times"></i></button>
                                                </div>
                                        </div>
                                    <!-- end modal body -->
                                </div>
                            </div>
                        </div>
                    <!-- fin modal liste des emplois du temps -->
                </div>
            </div>
        </div>
    </div>
@endsection
