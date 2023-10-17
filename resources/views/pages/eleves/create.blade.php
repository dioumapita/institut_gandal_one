{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'eleves-inscription'])
    @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">@lang('create.Inscription_eleve')</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">@lang('liste_eleve.Elèves')</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">@lang('create.Inscription_eleve')</li>
                </ol>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour') </a>
        <br><br>
        <div class="row">
            <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>@lang('create.Inscription_eleve')</header>
                    </div>
                    <div class="card-body ">
                        <form id="example-advanced-form" method="POST" action="{{ route('eleve.store') }}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{-- l'année d'inscription --}}
                             <input type="hidden" name="annee_id" value="{{ $id_annee }}">
                             <input type="hidden" name="status" value="0">
                            <h3>@lang('create.Etape')1/5</h3>
                            <fieldset>
                                <div class="col-lg-12 p-t-20">
                                    <!-- Start matricule de l'élève -->
                                    {{--  <div class="form-group row">
                                        <label class="control-label col-md-3">Matricule
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" name="matricule" minlength="6" placeholder="Veuillez saisir le matricule de l'élève"
                                                    class="form-control input-height" value="{{ old('matricule') }}" required />
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <!-- End matricule de l'élève -->
                                    <!-- Start nom de l'élève -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('liste_eleve.Nom')
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" name="nom" minlength="2" placeholder="Veuillez saisir le nom de l'élève"
                                                        class="form-control input-height" value="{{ old('nom') }}" required />
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End nom de l'élève -->
                                    <!-- Start prénom de l'élève -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('liste_eleve.Prenom')
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" name="prenom" minlength="4" placeholder="Veuillez saisir le prénom de l'élève"
                                                        class="form-control input-height" value="{{ old('prenom') }}" required />
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End prénom de l'élève -->
                                    <!-- Start civilite -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('create.Sexe')
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <select class="form-control input-height" name="sexe">
                                                        <option value="">Selectionner...</option>
                                                        <option value="Masculin">Masculin</option>
                                                        <option value="Feminin">Feminin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End civilite -->
                                    <!-- Start date de naissance de l'élève -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('create.Date_naiss')
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="date" class="form-control input-height"
                                                        name="date_naissance"  class="floating-label mdl-textfield__input"
                                                        placeholder="Date de naissance de l'élève" value="{{ old('date_naissance') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End date de naissance -->
                                    <!-- Start classe -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('liste_eleve.Classe')
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <select class="form-control input-height" name="classe">
                                                        <option value="">Selectionner...</option>
                                                        @foreach ($all_classes as $classe)
                                                            <option value="{{ $classe->id }}">{{ $classe->nom_niveau.' '.$classe->options }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End classe -->
                                </div>
                            </fieldset>
                            <h3>@lang('create.Etape')2/5</h3>
                            <fieldset>
                                <div class="col-lg-12 p-t-20">
                                    <!-- Start numéro téléphone élève -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('create.Téléphone')
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input name="telephone" type="text" placeholder="Veuillez saisir le numéro de téléphone de l'élève"
                                                        class="form-control input-height" value="{{ old('telephone') }}" required/>
                                                </div>
                                            </div>

                                        </div>
                                    <!-- End numéro téléphone élève -->
                                    <!--Start Quartier -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('create.Quartier')
                                                 <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-home"></i>
                                                    </span>
                                                    <input type="text" class="form-control input-height"
                                                        name="quartier" placeholder="Veuillez saisir une adresse (Quartier)" value="{{ old('quartier') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End Quartier -->
                                </div>
                            </fieldset>
                            <h3>@lang('create.Etape')3/5</h3>
                            <fieldset>
                                <!-- Start photo profil -->
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
                                                        <input class="btn btn-primary btn-block" type="button" value="@lang('create.PrendLaPhone')" onClick="take_snapshot()">
                                                        <input type="hidden" name="images" class="image-tag">
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                    <div id="results">Your captured image will appear here...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Configure a few settings and attach camera -->
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
                                <!-- end webcam js -->
                                <!-- start image upload -->
                                    <br>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">@lang('liste_eleve.Image')
                                            <span class="required">  </span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input name="photo_eleve" type="file" class="form-control input-height"/>
                                            </div>
                                            <span class="help-block">@lang('create.SelectImage')</span>
                                        </div>
                                    </div>
                                <!-- end image upload -->
                                <!-- End photo profil -->
                            </fieldset>
                            <h3>@lang('create.Etape')4/5</h3>
                            <fieldset>
                                <!-- Start nom du parent ou tuteur -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">@lang('create.NomTuteur')
                                            <span class="required">  </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" name="nom_parent"  placeholder="Veuillez saisir le nom du parent ou tuteur"
                                                    class="form-control input-height" value="{{ old('nom_parent') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End nom du parent ou tuteur -->
                                <!-- Start prénom du parent ou tuteur -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">@lang('create.PrenomTuteur')
                                            <span class="required">  </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" name="prenom_parent"  placeholder="Veuillez saisir le prénom du parent ou tuteur"
                                                    class="form-control input-height" value="{{ old('prenom_parent') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End prénom du parent ou tuteur -->
                                <!-- Start profession du parent ou tuteur -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">@lang('create.Profession')
                                            <span class="required">  </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" name="profession" placeholder="Veuillez saisir la profession du parent ou tuteur"
                                                    class="form-control input-height" value="{{ old('profession') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End profession du parent ou tuteur -->
                                <!-- Start numéro téléphone du parent ou tuteur -->
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">@lang('create.TelTuteur')
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input name="telephone_parent" type="text" placeholder="Veuillez saisir le numéro de téléphone du parent ou tuteur"
                                                    class="form-control input-height" value="{{ old('telephone_parent') }}" required/>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End numéro téléphone du parent ou tuteur -->
                            </fieldset>
                            {{-- <h3>@lang('create.Etape')5/5</h3>
                            <fieldset>
                                <div class="col-lg-12 p-t-20">
                                    <!--Start frais d'inscription -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">@lang('create.Frais D\'inscription')
                                                 <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                                    <input type="number" class="form-control input-height"
                                                        name="frais_inscription" placeholder="Veuillez saisir les frais d'inscriptions" value="{{ old('frais_inscription') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- End frais d'inscription -->
                                </div>
                            </fieldset> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

