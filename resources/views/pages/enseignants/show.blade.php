{{-- on herite du chemin theme actif --}}
@extends($chemin_theme_actif,['title' => 'Enseigants-Details'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Profil Enseignant</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Enseignant</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Profil Enseignant</li>
            </ol>
        </div>
    </div>
    <a href="{{ route('enseignant.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <div class="card card-topline-aqua">
                    <div class="card-body no-padding height-9">
                        <div class="row">
                            <div class="mx-auto">
                                <img src="/images/photos/enseignants/{{ $infos_enseignant->avatar }}" width="200" height="200"  alt="profil_enseignant">
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
                                            data-toggle="tab">Informations générales de l'enseignant </a></li>
                                    <li class="nav-item"><a href="#tab2" class="nav-link"
                                            data-toggle="tab">Matières Enseigners</a></li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab1">
                                    <div id="biography">
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r"> <strong>Nom</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_enseignant->nom }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Prénom</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_enseignant->prenom }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Civilité</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_enseignant->civilite }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Téléphone</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_enseignant->telephone }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 col-6"> <strong>Quartier</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_enseignant->adresse }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r"> <strong>Date inscription</strong>
                                                <br>
                                                <p class="text-muted">{{ $infos_enseignant->created_at->format('d/m/Y')}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                       
                                        <br>
                                        <span class="espace"></span>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="table-scrollable">
                                                @if($infos_enseignant->enseigneNiveaux->count() > 0)
                                                    <h3 class="text-center"><u>Classes Enseigners</u></h3>
                                                    <table  class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                        >
                                                        <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Classe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($infos_enseignant->enseigneNiveaux as $key => $enseigne_niveau)
                                                                <tr>
                                                                    <td scope="row">{{ $b++ }}</td>
                                                                    <td>
                                                                            {{ $enseigne_niveau->niveau->nom_niveau }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                                @if($infos_enseignant->enseigners->count() > 0)
                                                    <h3 class="text-center"><u>Matières Enseigners</u></h3>
                                                    <table  class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                        >
                                                        <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Matière</th>
                                                                <th>Classe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($infos_enseignant->enseigners as $key => $enseigner)
                                                                <tr>
                                                                    <td scope="row">{{ $i++ }}</td>
                                                                    <td>
                                                                            {{ $enseigner->matiere->nom_matiere }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $enseigner->niveau->nom_niveau }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
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
