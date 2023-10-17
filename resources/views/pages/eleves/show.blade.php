{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'eleve-detail'])
    @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">@lang('create.Profil_Eleve')</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">@lang('liste_eleve.Elèves')</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">@lang('create.Profil_Eleve')</li>
                </ol>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour') </a>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card card-topline-aqua">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                <div class="mx-auto">
                                    <img src="/images/photos/eleves/{{ $eleve->photo_profil }}" alt="photo_eleve" width="200" height="200">
                                </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> @lang('liste_eleve.Image') </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="card">
                            <div class="card-topline-aqua">
                                <header></header>
                            </div>
                            <div class="white-box">
                                <!-- Nav tabs -->
                                <div class="p-rl-20">
                                    <ul class="nav customtab nav-tabs" role="tablist">
                                        <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                data-toggle="tab">@lang('create.Info_general_eleve') </a></li>
                                        <li class="nav-item"><a href="#tab2" class="nav-link"
                                                data-toggle="tab">@lang('create.info_familliale')</a></li>
                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                        <div id="biography">
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('liste_eleve.Matricule')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->matricule }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('liste_eleve.Nom')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->nom }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('liste_eleve.Prenom')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->prenom }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>@lang('create.Sexe')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->sexe }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('liste_eleve.Classe')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->inscrits()->first()->niveau->nom_niveau.' '.$eleve->inscrits()->first()->niveau->options }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('create.Date_naiss')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->date_naissance->format('d/m/Y') }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('liste_eleve.Date_inscription')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->inscrits()->first()->date_inscription->format('d/m/Y') }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>@lang('create.Quartier')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->quartier }}</p>
                                                </div>
                                            </div>
                                            <span class="espace"></span>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('create.NomTuteur')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->nom_parent }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('create.PrenomTuteur')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->prenom_parent }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('create.Profession')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->profession }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>@lang('create.TelTuteur')</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $eleve->telephone_parent }}</p>
                                                </div>
                                            </div>
                                            <span class="espace"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    @endsection
