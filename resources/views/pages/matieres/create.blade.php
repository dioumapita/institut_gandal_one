{{-- on herite du theme actif --}}
@extends($chemin_theme_actif,['title' => 'matières-ajouts'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('matiere.AjoutMatiere')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('home.Matieres')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('matiere.AjoutMatiere')</li>
            </ol>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-info"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour')</a>
    <a href="{{ route('matiere.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> @lang('matiere.ListeMatiere')</a>
    <br><br>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>@lang('matiere.AjoutMatiere')</header>
                    <button id="panel-button"
                        class="mdl-button mdl-js-button mdl-button--icon pull-right"
                        data-upgraded=",MaterialButton">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="panel-button">
                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                            here</li>
                    </ul>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="POST" action="{{ route('matiere.store') }}"  class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <!--Start Nom Matière -->
                                <div class="form-group row">
                                    <label for="nom_matiere" class="control-label col-md-3">@lang('matiere.NomMatière')
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-5">
                                        <input type="text" name="nom_matiere" id="nom_matiere" placeholder="Entrez une matière (Exemple: Biologie)"
                                            value="{{ old('nom_matiere') }}" class="form-control @error('nom_matiere')is-invalid @enderror" required/>
                                           @error('nom_matiere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                </span>
                                           @enderror
                                    </div>
                                </div>
                            <!-- End Nom Matière -->
                            <!-- Start Bouton Valider Annuler And Back -->
                                <div class="center form-actions">
                                    <div class="row">
                                        <div class="offset-md-3 col-md-8">
                                            <button type="submit" class="btn btn-primary m-r-20">
                                                <i class="fa fa-check"></i> @lang('note.Valider')
                                            </button>
                                            <button type="reset" class="btn btn-danger">
                                                <i class="fa fa-times"></i> @lang('note.Annuler')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <!-- End Bouton Valider Annuler  And Back -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
