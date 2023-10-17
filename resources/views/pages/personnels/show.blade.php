{{-- on herite du chemin theme actif --}}
@extends($chemin_theme_actif,['title' => 'Enseigants-Details'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Profil Personnel</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Personnel</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Profil Personnel</li>
            </ol>
        </div>
    </div>
    <a href="{{ route('Personnel.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <div class="card card-topline-aqua">
                    <div class="card-body no-padding height-9">
                        <div class="row">
                            <div class="mx-auto">
                                <img src="/images/photos/enseignants/default.png" width="200" height="200"  alt="profil_enseignant">
                            </div>
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> Image </div>
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
                                            data-toggle="tab">Informations générales du personnel </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab1">
                                    <div id="biography">
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>Nom</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_personnel->nom }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Prénom</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_personnel->prenom }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Poste</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_personnel->poste }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Téléphone</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_personnel->telephone }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 col-6"> <strong>Quartier</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_personnel->quartier }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="font-bold center">Document</h4>
                                            <iframe src="/document/{{ $infos_personnel->document }}" width="600" height="500" alt="pdf">
                                            </iframe>
                                        <br>
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
