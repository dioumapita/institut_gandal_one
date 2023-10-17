{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Absence-Choix-Matiere'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Gestion Des Absences Des Elèves</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Absences</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Gestion Des Absences Des Elèves</li>
                    </ol>
                </div>
            </div>
            <div class="container mt-4 mx-auto col-md-12">
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>Classe: {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</header>
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
                                    <div class="col-xl-6 col-md-6 col-6 ">
                                        <a href="#" id="addRow1" data-toggle="modal" data-target="#ModeMultiple">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="material-icons">keyboard</i>
                                                </div>
                                                <div class="value white">
                                                    <h3>Saisie Des Absences</h3> 
                                                </div>
                                            </div>
                                        </a>  
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-6">
                                        <a href="#" data-toggle="modal" data-target="#ListeNotes">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="material-icons">view_list</i>
                                                </div>
                                                <div class="value white">
                                                    <h3>Liste Des Absences</h3> 
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <a href="{{ route('print_absences_eleves',$niveau_choisi->id) }}">
                                            <div class="overview-panel deepPink-bgcolor">
                                                <div class="symbol">
                                                    <i class="material-icons">print</i>
                                                </div>
                                                <div class="value white">
                                                    <h3>Impressions Des Absences Des Elèves</h3> 
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <!-- fin -->
                        <div class="btn-group">
                            <!-- debut modal saisi de note-->
                                <div class="modal fade" data-backdrop="static" id="ModeMultiple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Saisie Des Absences</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>
                                            <!-- start modal body -->
                                                <div class="modal-body">
                                                    <form action="{{ route('absence_par_niveau',$niveau_choisi->id) }}" method="GET">
                                                        <div class="form-group">
                                                            <label for="matiere_id">Selectionner une matiere</label>
                                                            <select class="form-control" name="matiere_id" id="matiere_id" required>
                                                            @foreach ($all_matieres as $key => $matiere)
                                                                <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Valider <i class="fa fa-check"></i></button>
                                                            <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <!-- end modal body -->
                                        </div>
                                    </div>
                                </div>
                            <!-- fin modal saisie des notes -->
                            <!-- debut moda liste des note -->
                                <div class="modal fade" data-backdrop="static" id="ListeNotes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Liste Des Notes</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>
                                            <!-- start modal body -->
                                                <div class="modal-body">
                                                    <form action="{{ route('detail_absence_eleve',$niveau_choisi->id) }}" method="GET">
                                                        <div class="form-group">
                                                            <label for="matiere_id">Selectionner une matiere</label>
                                                            <select class="form-control" name="matiere_id" id="matiere_id" required>
                                                            @foreach ($all_matieres as $key => $matiere)
                                                                <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Valider <i class="fa fa-check"></i></button>
                                                            <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <!-- end modal body -->
                                        </div>
                                    </div>
                                </div>
                            <!-- fin modal liste des notes -->
                        </div>
                    </div>
                </div>
            </div>
        @endsection