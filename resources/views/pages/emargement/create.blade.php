{{-- on herite du chemin actif --}}
    @extends($chemin_theme_actif,['title' => 'Emargement'])
        @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Nouveau Emargement</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">Emargement</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Nouveau Emargement</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Nouveau Emargement</header>
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
                        <form method="POST" action="{{ route('emargement.store') }}"  class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <!-- start niveau choisi -->
                                <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                <!-- end niveau choisi -->
                                <!-- start annee scolaire -->
                                 <input type="hidden" name="annee_id" value="{{ $annee_scolaire->id }}">
                                <!-- end annee scolaire -->
                                <!-- Start Enseigant -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Enseignant
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <select name="user_id" class="form-control @error('user_id')is-invalid @enderror">
                                                <option value="">Selectionner un enseignant</option>
                                                @foreach ($all_enseignant as $enseignant)
                                                  <option value="{{ $enseignant->id }}">{{ $enseignant->nom.' '.$enseignant->prenom }}</option>  
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Enseignant -->
                                <!-- Start Matiere -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Matieres
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <select name="matiere_id" class="form-control @error('matiere_id')is-invalid @enderror">
                                                <option value="">Selectionner une matiere</option>
                                                 @foreach ($all_matiere as $matiere)
                                                    <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option> 
                                                 @endforeach
                                            </select>
                                            @error('matiere_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Enseignant -->
                                <!--Start Heure Effectuer -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Heure Effectuer
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="number" name="heure_eff" 
                                                value="{{ old('heure_eff') }}" class="form-control @error('heure_eff')is-invalid @enderror" />
                                            @error('heure_eff')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Heure Effectuer -->
                                <!--Start Date Emargement -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Date Emargement
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="date" name="d_emarg"
                                                value="{{ old('d_emarg') }}" class="form-control @error('d_emarg')is-invalid @enderror" />
                                            @error('d_emarg')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                <!-- End Date Emargement -->
                                <!-- Start Bouton Valider Annuler And Back -->                       
                                    <div class="center form-actions">
                                        <div class="row">
                                            <div class="offset-md-3 col-md-8">
                                                <button type="submit" class="btn btn-success m-r-20">
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