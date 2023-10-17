@extends($chemin_theme_actif,['title' => 'Personnel-Create'])
    @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Ajout Du Personnel</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">Personnel</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Ajout Du Personnel</li>
                </ol>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
        <a href="{{ route('Personnel.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Liste Du Personnel</a>
        <br><br>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Ajout Du Personnel</header>
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
                        <form method="POST" action="{{ route('Personnel.store') }}"  class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <!--Start Nom -->
                                    <div class="form-group row">
                                        <label for="nom" class="control-label col-md-3">Nom
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="nom" id="nom" placeholder="Entrez le nom"
                                                value="{{ old('nom') }}" class="form-control @error('nom')is-invalid @enderror" required/>
                                               @error('nom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                               @enderror
                                        </div>
                                    </div>
                                <!-- End Nom -->
                                <!--Start Prénom -->
                                    <div class="form-group row">
                                        <label for="prenom" class="control-label col-md-3">Prénom
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="prenom" id="prenom" placeholder="Entrez le prénom"
                                                value="{{ old('prenom') }}" class="form-control @error('prenom')is-invalid @enderror" required/>
                                            @error('prenom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Prénom -->
                                <!--Start Poste de travail -->
                                    <div class="form-group row">
                                        <label for="poste" class="control-label col-md-3">Poste De Travail
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="poste" id="poste" placeholder="Entrez le poste de travail"
                                                value="{{ old('poste') }}" class="form-control @error('poste')is-invalid @enderror" required/>
                                            @error('poste')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Poste de travail -->
                                <!--Start Telephone -->
                                    <div class="form-group row">
                                        <label for="telephone" class="control-label col-md-3">Télephone
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="telephone" id="telephone" placeholder="Entrez le numéro de télephone"
                                                value="{{ old('telephone') }}" class="form-control @error('telephone')is-invalid @enderror" required/>
                                            @error('telephone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Télephone -->
                                <!--Start Quartier -->
                                    <div class="form-group row">
                                        <label for="quartier" class="control-label col-md-3">Quartier
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="quartier" id="quartier" placeholder="Entrez le quartier"
                                                value="{{ old('quartier') }}" class="form-control @error('quartier')is-invalid @enderror" required/>
                                            @error('quartier')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Quartier -->
                                <!-- Start Bouton Valider Annuler And Back -->                       
                                    <div class="center form-actions">
                                        <div class="row">
                                            <div class="offset-md-3 col-md-8">
                                                <button type="submit" class="btn btn-primary m-r-20">
                                                    <i class="fa fa-check"></i> Valider
                                                </button>
                                                <button type="reset" class="btn btn-danger">
                                                    <i class="fa fa-times"></i> Annuler
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