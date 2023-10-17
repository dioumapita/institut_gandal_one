{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Enseignants-Edit'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Modification Des Informations D'un Enseignant</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Enseignants</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modification Des Informations D'un Enseignant</li>
                    </ol>
                </div>
            </div>
            <a href="{{ route('enseignant.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
            <br><br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Modification Des Informations D'un Enseignant</header>
                        </div>
                        <div class="card-body ">
                            <form id="inscriptions-enseignants" method="POST" action="{{ route('enseignant.update',$infos_enseignant->id) }}" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Etape1/3</h3>
                                <fieldset>
                                    <div class="col-lg-12 p-t-20">
                                        <!-- Start nom de l'enseignant -->
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Nom
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <input type="text" name="nom" minlength="2" placeholder="Veuillez saisir le nom de l'enseignant"
                                                            class="form-control @error('nom')is-invalid @enderror" value="{{ old('nom')?old('nom'):$infos_enseignant->nom }}" required />
                                                            @error('nom')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End nom de l'enseignant -->
                                        <!-- Start prénom de l'enseignant -->
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Prénom
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <input type="text" name="prenom" minlength="4" placeholder="Veuillez saisir le prénom de l'enseignant"
                                                            class="form-control @error('prenom')is-invalid @enderror" value="{{ old('prenom')?old('prenom'):$infos_enseignant->prenom }}" required />
                                                            @error('prenom')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End prénom de l'enseignant -->
                                        <!-- Start civilite -->
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Civilité
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <select class="form-control input-height" name="civilite">
                                                            <option value="">Selectionner...</option>
                                                            <option value="Monsieur" @if($infos_enseignant->civilite == "Monsieur") selected @endif>Monsieur</option>
                                                            <option value="Madame" @if($infos_enseignant->civilite == "Madame") selected @endif>Madame</option>
                                                            <option value="Mademoiselle" @if($infos_enseignant->civilite == "Mademoiselle") selected @endif >Mademoiselle</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End civilite -->
                                        <!-- Start date de naissance de l'enseignant -->
                                            {{-- <div class="form-group row">
                                                <label class="control-label col-md-3">Date de naissance
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control"
                                                            name="date_naissance" id="date_naissance" class="floating-label mdl-textfield__input"
                                                            placeholder="Date de naissance de l'élève" value="{{ old('date_naissance')?old('date_naissance'):$infos_enseignant->date_naiss }}" required>
                                                            @error('date_naissance')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div> --}}
                                        <!-- End date de naissance  de l'enseignant-->
                                    </div>
                                </fieldset>
                                <h3>Etape2/3</h3>
                                <fieldset>
                                    <div class="col-lg-12 p-t-20">
                                        <!-- Start email de l'enseignant -->
                                            {{-- <div class="form-group row">
                                                <label class="control-label col-md-3">E-mail
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <input type="text" name="email" id="email" placeholder="Veuillez saisir l'adresse e-mail de l'enseignant"
                                                            class="form-control @error('email')is-invalid @enderror" value="{{ old('email')?old('email'):$infos_enseignant->email }}" required />
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div> --}}
                                        <!-- End email de l'enseignant -->
                                        <!-- Start téléphone de l'enseignant -->
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Téléphone
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <input type="text" name="telephone" placeholder="Veuillez saisir le numéro de l'enseignant"
                                                            class="form-control @error('telephone')is-invalid @enderror" value="{{ old('telephone')?old('telephone'):$infos_enseignant->telephone }}" required />
                                                            @error('telephone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End téléphone de l'enseignant -->
                                        <!--Start Quartier -->
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Quartier
                                                </label>
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-home"></i>
                                                        </span>
                                                        <input type="text"
                                                            name="quartier" placeholder="Veuillez saisir une adresse (Quartier)"
                                                            class="form-control @error('quartier') is-invalid @enderror" value="{{ old('quartier')?old('quartier'):$infos_enseignant->adresse }}"
                                                            required>
                                                            @error('quartier')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong id="msg_error_profil">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End Quartier -->
                                    </div>
                                </fieldset>
                                <h3>Etape3/3</h3>
                                <fieldset>
                                    <!-- start file webcam.min.js -->
                                    <script src="/assets/asset_principal/js/webcam.min.js"></script>
                                    <!-- end file webcam.min.js -->
                                    <!-- start webcam js -->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="pull-right">
                                                        <div  id="my_camera"></div>
                                                            <br>
                                                            <input class="btn btn-primary btn-block" type="button" value="Prendre la photo" onClick="take_snapshot()">
                                                            <input type="hidden" name="webcame" class="image-tag">
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-sm-6 col-6">
                                                        <div id="results">Your captured image will appear here...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Configure a few settings and attach camera -->
                                        {{-- 
                                            <script language="JavaScript">
                                                Webcam.set({
                                                    width: 320,
                                                    height: 170,
                                                    image_format: 'jpeg',
                                                    jpeg_quality: 90
                                                });

                                                Webcam.attach( '#my_camera' );

                                                function take_snapshot() {
                                                    Webcam.snap( function(data_uri) {
                                                        $(".image-tag").val(data_uri);
                                                        document.getElementById('results').innerHTML = '<img  src="'+data_uri+'"/>';
                                                    } );
                                                }
                                            </script>
                                        --}}
                                    <!-- end webcam js -->
                                    <!-- Start photo profil -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Photo
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input name="photo_upload" type="file" class="form-control input-height"/>
                                                </div>
                                                <span class="help-block">Selectionner une image de profil</span>
                                            </div>
                                        </div>
                                    <!-- End photo profil -->
                                </fieldset>
                                <h3>Diplômes Obtenus</h3>
                                <fieldset>
                                    <div class="col-lg-12 p-t-20">
                                        <div class="form-group col-md-6 mx-auto">
                                          <label for="diplome_obtenu"></label>
                                          <textarea class="form-control" name="diplome_obtenu" id="diplome_obtenu" cols="5" rows="5">{{ $infos_enseignant->diplome_obtenu }}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
