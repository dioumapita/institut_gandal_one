{{-- on herite du layout active --}}
@extends($chemin_theme_actif,['title' => 'accueil'])

@section('content')

<!-- Start title -->
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Menu principal</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;
                    <a class="parent-item" href="#">@lang('home.Accueil')</a>&nbsp;
                        <i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Menu principal</li>
            </ol>
        </div>
    </div>
<!-- End title -->
<!-- Start widget -->
    <div class="state-overview">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="overview-panel bg-b-pink">
                    <div class="symbol">
                        <i class="fa fa-users usr-clr"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $total_inscrits }}">0</p><br>
                        <p class="text-size">@lang('home.Eleves')</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="overview-panel bg-b-blue">
                    <div class="symbol">
                        <i class="fa fa-user-md"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $total_enseignants }}">0</p><br>
                        <p class="text-size1">@lang('home.Enseignants')</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="overview-panel bg-b-yellow">
                    <div class="symbol">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $total_matieres }}">0</p>
                        <p class="text-size">@lang('home.Matieres')</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="overview-panel bg-b-pink">
                    <div class="symbol">
                        <i class="fa fa-university"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $total_niveau }}">0</p>
                        <p class="text-size">@lang('home.Classes')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end widget -->
<!-- start Eleves AND Notes-->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>@lang('home.Eleves')</header>
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
                                            @if ($annee_courante->id == $id_derniere_annee)
                                                <a href="{{ route('eleve.create') }}">
                                                    <div class="overview-panel deepPink-bgcolor">
                                                        <div class="symbol">
                                                            <i class="material-icons">person_add</i>
                                                        </div>
                                                        <div class="value white">
                                                            <h3>@lang('home.Inscription')</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="overview-panel desactiver">
                                                    <div class="symbol">
                                                        <i class="material-icons">person_add</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>Inscriptions</h3>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            @if ($annee_courante->id == $id_derniere_annee)
                                                <a href="{{ route('eleve_reinscription') }}">
                                                    <div class="overview-panel deepPink-bgcolor">
                                                        <div class="symbol">
                                                            <i class="material-icons">person_add</i>
                                                        </div>
                                                        <div class="value white">
                                                            <h3>@lang('home.Reinscription')</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="overview-panel desactiver">
                                                    <div class="symbol">
                                                        <i class="material-icons">person_add</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>Réinscriptions</h3>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <a href="{{ route('eleve.index') }}">
                                                <div class="overview-panel deepPink-bgcolor">
                                                    <div class="symbol">
                                                        <i class="material-icons">view_list</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Listes')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        {{-- <div class="col-xl-6 col-md-6 col-12">
                                            <a href="{{ route('absence.index') }}">
                                                <div class="overview-panel deepPink-bgcolor">
                                                    <div class="symbol">
                                                        <i class="material-icons">view_list</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Absences')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            <!-- fin -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-topline-yellow">
                        <div class="card-head">
                            <header>@lang('home.Notes')</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down"
                                    href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="state-overview">
                                <div class="col-xl-12 col-md-12 col-12">
                                    <a href="{{ route('liste_des_notes') }}">
                                        <div class="overview-panel orange">
                                            <div class="symbol">
                                                <i class="material-icons">note_add</i>
                                            </div>
                                            <div class="value white">
                                                <h3>@lang('home.Notes')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-12 col-md-12 col-12">
                                    <a href="{{ route('config_moyenne.index') }}">
                                        <div class="overview-panel orange">
                                            <div class="symbol">
                                                <i class="fa fa-file-text"></i>
                                            </div>
                                            <div class="value white">
                                                <h3>@lang('home.Config_Moyenne')</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Eleves AND Notes -->
    <!-- start Enseignants -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-lightblue">
                            <div class="card-head">
                                <header>@lang('home.Enseignants')</header>
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
                                                <div class="col-xl-6 col-md-6 col-12">
                                                    <a href="{{ route('enseignant.create') }}">
                                                        <div class="overview-panel blue-bgcolor">
                                                            <div class="symbol">
                                                                <i class="material-icons">group_add</i>
                                                            </div>
                                                            <div class="value white">
                                                                <h3>@lang('home.Inscription')</h3>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-xl-6 col-md-12 col-12">
                                                    <a href="{{ route('enseignant.index') }}">
                                                        <div class="overview-panel blue-bgcolor">
                                                            <div class="symbol">
                                                                <i class="material-icons">view_list</i>
                                                            </div>
                                                            <div class="value white">
                                                                <h3>@lang('home.Listes')</h3>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-xl-12 col-md-12 col-12">
                                                    <a href="{{ route('emargement.index') }}">
                                                        <div class="overview-panel blue-bgcolor">
                                                            <div class="symbol">
                                                                <i class="material-icons">work</i>
                                                            </div>
                                                            <div class="value white">
                                                                <h3>@lang('home.Emargements')</h3>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                        </div>
                                    </div>
                                <!-- fin -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Enseignants -->
<!-- start Matières And Emplois -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-topline-yellow">
                        <div class="card-head">
                            <header>@lang('home.Matieres')</header>
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
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <a class="text-white" href="{{ route('matiere.create') }}">
                                                <div class="overview-panel bg-b-yellow">
                                                    <div class="symbol">
                                                        <i class="material-icons">library_books</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Ajout')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <a class="text-white" href="{{ route('config_matiere') }}">
                                                <div class="overview-panel bg-b-yellow">
                                                    <div class="symbol">
                                                        <i class="material-icons">settings</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Configurations')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <a class="text-white" href="{{ route('matiere.index') }}">
                                                <div class="overview-panel bg-b-yellow">
                                                    <div class="symbol">
                                                        <i class="material-icons">view_list</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Listes')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <!-- fin -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-topline-aqua">
                        <div class="card-head">
                            <header>Emplois du temps</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down"
                                    href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="state-overview">
                                <div class="col-xl-12 col-md-12 col-12">
                                    <a class="text-white" href="{{ route('emploi.index') }}">
                                        <div class="overview-panel bg-b-green">
                                            <div class="symbol">
                                                <i class="material-icons">event</i>
                                            </div>
                                            <div class="value white">
                                                <h3>Planning</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-12 col-md-12 col-12">
                                    <a class="text-white" href="{{ route('attribution.index') }}">
                                        <div class="overview-panel bg-b-green">
                                            <div class="symbol">
                                                <i class="fa fa-users usr-clr"></i>
                                            </div>
                                            <div class="value white">
                                                <h4>@lang('home.AttributionMatiere')</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Matières AND Emplois -->
<!-- Start Comptable -->
    @can('Comptabilité')
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-purple">
                            <div class="card-head">
                                <header>@lang('home.Comptabilite')</header>
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
                                            {{-- <div class="col-xl-6 col-md-6 col-12">
                                                <a href="{{ route('paiement_frais_inscription.index') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>@lang('home.PaiementDesInscription')</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12">
                                                <a href="{{ route('paiement_frais_reinscription.index') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>@lang('home.PaiementDesReinscription')</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div> --}}
                                            <div class="col-xl-6 col-md-6 col-6">
                                                <a href="{{ route('paiement_eleve.index') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>@lang('home.PaiementDesFraisScolaire')</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-6">
                                                <a href="{{ route('etat_paiement_eleve') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>Etat De Paiement Des Frais Scolaires</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-6">
                                                <a href="{{ route('paiement_des_enseignants_par_mois',10) }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>@lang('home.PaiementDesEnseignant')</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12">
                                                <a href="{{ route('credit_enseignant_par_mois',10) }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>Avance De Salaire Des Enseignants</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-12 col-12">
                                                <a href="#">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>Paiement Du Personnel</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-12 col-12">
                                                <a href="#">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>Avance De Salaire Du Personnel</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-6">
                                                <a href="{{ route('arrierer.index') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>Gestion Des Arriérés</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-6">
                                                <a href="{{ route('depense.index') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>@lang('home.GestionDesDepenses')</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-12 col-md-12 col-12">
                                                <a href="{{ route('remise_paiement_eleve.index') }}">
                                                    <div class="overview-panel comptabilite">
                                                        <div class="symbol">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h4>Gestion Des Remises</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @can('Comptabilité Générale')
                                                <div class="col-xl-12 col-md-12 col-12">
                                                    <a href="{{ route('comptabilite') }}">
                                                        <div class="overview-panel comptabilite">
                                                            <div class="symbol">
                                                                <i class="fa fa-credit-card-alt"></i>
                                                            </div>
                                                            <div class="value white">
                                                                <h4>@lang('home.ComptabiliteGenerale')</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                <!-- fin -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
<!-- End Comptable -->
<!-- Start Impression -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-topline-lightblue">
                        <div class="card-head">
                            <header>@lang('home.Impressions')</header>
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
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <a href="{{ route('bulletins_des_eleves_par_defaut') }}">
                                                <div class="overview-panel blue-bgcolor">
                                                    <div class="symbol">
                                                        <i class="fa fa-file-word-o"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h4>@lang('home.BuilletinsDeNotes')</h4>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <a href="{{ route('classement_des_eleves') }}">
                                                <div class="overview-panel blue-bgcolor">
                                                    <div class="symbol">
                                                        <i class="fa fa-file"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Classement')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <!-- fin -->
                        </div>
                    </div>
                </div>
                <!-- start module ajouter -->

                <div class="col-md-6">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>@lang('home.Classes')</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down"
                                    href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="state-overview">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-6">
                                        <a href="{{ route('niveaux.create') }}">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="material-icons">add_box</i>
                                                </div>
                                                <div class="value white">
                                                    <h3>@lang('home.Ajout')</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-6">
                                        <a href="{{ route('niveaux.index') }}">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="material-icons">list</i>
                                                </div>
                                                <div class="value white">
                                                    <h3>@lang('home.Listes')</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <a href="{{ route('config_niveau') }}">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="material-icons">settings</i>
                                                </div>
                                                <div class="value white">
                                                    <h3>@lang('home.Configurations')</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end module ajouter -->
            </div>
        </div>
    </div>
    <!-- start Enseignants -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-yellow">
                        <div class="card-head">
                            <header>Impressions</header>
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
                                            <div class="col-xl-6 col-md-6 col-12">
                                                <a href="{{ route('fiche_modulaire') }}">
                                                    <div class="overview-panel blue-bgcolor">
                                                        <div class="symbol">
                                                            <i class="fa fa-file"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h3>Fiche Modulaire</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12">
                                                <a href="#">
                                                    <div class="overview-panel blue-bgcolor">
                                                        <div class="symbol">
                                                            <i class="fa fa-file"></i>
                                                        </div>
                                                        <div class="value white">
                                                            <h3>Fiche De Composition</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            <!-- fin -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-yellow">
                        <div class="card-head">
                            <header>@lang('home.Personnels')</header>
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
                                            <div class="col-xl-6 col-md-6 col-12">
                                                <a href="{{ route('Personnel.create') }}">
                                                    <div class="overview-panel orange">
                                                        <div class="symbol">
                                                            <i class="material-icons">group_add</i>
                                                        </div>
                                                        <div class="value white">
                                                            <h3>@lang('home.Ajout')</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12">
                                                <a href="{{ route('Personnel.index') }}">
                                                    <div class="overview-panel orange">
                                                        <div class="symbol">
                                                            <i class="material-icons">view_list</i>
                                                        </div>
                                                        <div class="value white">
                                                            <h3>@lang('home.Listes')</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            <!-- fin -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Impression -->
<!-- Start Statistique,Messagerie,Corbeille -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>@lang('home.Bibliotheque')</header>
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
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <a href="{{ route('auteur.index') }}">
                                                <div class="overview-panel deepPink-bgcolor">
                                                    <div class="symbol">
                                                        <i class="fa fa-users"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Auteurs')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <a href="{{ route('livre.index') }}">
                                                <div class="overview-panel deepPink-bgcolor">
                                                    <div class="symbol">
                                                        <i class="fa fa-book"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Livres')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-6">
                                            <a href="{{ route('category.index') }}">
                                                <div class="overview-panel deepPink-bgcolor">
                                                    <div class="symbol">
                                                        <i class="fa fa-bar-chart"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.Categories')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-6">
                                            <a href="{{ route('emprunteur.index') }}">
                                                <div class="overview-panel deepPink-bgcolor">
                                                    <div class="symbol">
                                                        <i class="fa fa-users"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>@lang('home.EmprunterUnLivre')</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <!-- fin -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Statistique,Messagerie,Corbeille -->
<!-- Start Statistique,Messagerie,Corbeille -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>Carte / Badge</header>
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
                                    <div class="col-xl-12 col-md-6 col-12">
                                        <a href="{{ route('carte') }}">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="fa fa-address-card"></i>
                                                </div>
                                                <div class="value white">
                                                    <h4>Carte De Retrait</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="fa fa-address-card"></i>
                                            </div>
                                            <div class="value white">
                                                <h4>Badge Scolaire</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="overview-panel deepPink-bgcolor">
                                            <div class="symbol">
                                                <i class="fa fa-address-card"></i>
                                            </div>
                                            <div class="value white">
                                                <h4>Carte Professionnelle</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- fin -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-topline-yellow">
                    <div class="card-head">
                        <header>Messagerie</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down"
                                href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="state-overview">
                            <div class="col-xl-12 col-md-12 col-12">
                                <a href="#">
                                    <div class="overview-panel orange">
                                        <div class="symbol">
                                            <i class="material-icons">email</i>
                                        </div>
                                        <div class="value white">
                                            <h4>Elève / Parent</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-12 col-md-12 col-12">
                                <a href="{{ route('msg_professionnel') }}">
                                    <div class="overview-panel orange">
                                        <div class="symbol">
                                            <i class="material-icons">email</i>
                                        </div>
                                        <div class="value white">
                                            <h4>Enseignant / Personnel</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Statistique,Messagerie,Corbeille -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-yellow">
                    <div class="card-head">
                        <header>Mise à jour et maintenance</header>
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
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <a href="#">
                                                <div class="overview-panel orange">
                                                    <div class="symbol">
                                                        <i class="fa fa-recycle"></i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>Mise à jour</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <a href="#">
                                                <div class="overview-panel orange">
                                                    <div class="symbol">
                                                        <i class="material-icons">view_list</i>
                                                    </div>
                                                    <div class="value white">
                                                        <h3>Maintenance</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                </div>
                            </div>
                        <!-- fin -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
</script>
