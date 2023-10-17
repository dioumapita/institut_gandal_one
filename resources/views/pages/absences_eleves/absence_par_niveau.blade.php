{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Absence-Par-Niveau'])
        @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Saisi Des Absences Des Elèves</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">Absences</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Saisi Des Absences Des Elèves</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>Saisi Des Absences Des Elèves</header>
                       <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh"
                        href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down"
                        href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times"
                        href="javascript:;"></a>
                </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <a href="{{ route('absence_par_matiere',$niveau->id) }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
                                &nbsp;
                                <button id="addRow1" class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">
                                    Choisir une autre matière  <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal choix de matière -->
                                    <div class="modal fade" data-backdrop="static" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Choisir Une Matière</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                        <form action="{{ route('absence_par_niveau',$niveau->id) }}" method="GET">
                                                            <div class="form-group">
                                                                <label for="matiere_id">Selectionner une matiere</label>
                                                                <select class="form-control" name="matiere_id" id="matiere_id">
                                                                @foreach ($niveau->matieres as $key => $matiere)
                                                                    <option value="{{ $matiere->id }}" @if($matiere->id == $matiere_choisie->id) selected @endif>{{ $matiere->nom_matiere}}</option>
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
                                <!-- fin modal choix de matière -->

                                <button id="addRow1" class="btn btn-primary" data-toggle="modal" data-target="#modalchoixclasse">
                                    Choisir une autre classe  <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal choix de classe -->
                                    <div class="modal fade" data-backdrop="static" id="modalchoixclasse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Choisir Une Classe</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="niveau_id">Selectionner une classe</label>
                                                            <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id">
                                                            @foreach ($all_niveaux as $key => $niveau_identifier)
                                                                <option value="{{ route('absence_par_matiere',$niveau_identifier->id) }}" @if($niveau_identifier->id == $niveau->id) selected @endif>{{ $niveau_identifier->nom_niveau.' '.$niveau_identifier->options}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                <!-- end modal body -->
                                            </div>
                                        </div>
                                    </div>
                                <!-- fin modal choix de classe -->
                                <form action="{{ route('detail_absence_eleve',$niveau->id) }}" method="get" class="inline">
                                    <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                    <button type="submit" class="btn btn-primary">Liste Des Absences Des Elèves</button>
                                </form>
                            </div>
                            <div class="pull-right col-md-12 col-sm-12 col-12">
                                <div class="btn-group pull-right">
                                    <form action="{{ route('absence_par_niveau',$niveau->id) }}" method="get">
                                        <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                        <label for="d_absence">Date: </label> <input type="date" name="d_absence" id="d_absence" value="{{ $date_absence }}" min="{{ date('2020-12-01') }}" max="{{ date('Y-m-d') }}">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> valider</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 col-sm-7 col-7">
                                <div class="col-md-7 col-sm-7 col-7">
                                    <h4 class="text-bold full-width">Classe : {{ $niveau->nom_niveau.' '.$niveau->options }}
                                        <br>
                                        Matière : {{ $matiere_choisie->nom_matiere }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('absence.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                    style="width: 100%" id="eleves">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th> Eleves </th>
                                            <th width="15%"> Status </th>
                                            <th width="15%"> Motif </th>
                                            <th width="25%"> Commentaire </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_inscrits as $inscrit)

                                            <tr class="odd gradeX">
                                                <td class="patient-img">
                                                    <img src="/images/photos/eleves/{{ $inscrit->eleve->photo_profil }}"
                                                        alt="photo_eleve">
                                                </td>
                                                <td >
                                                    <input type="hidden" name="eleve_id[]" value="{{ $inscrit->eleve->id }}">
                                                    <input type="hidden" name="niveau_id" value="{{ $niveau->id }}">
                                                    <input type="hidden" name="annee_id" value="{{ $annee_id }}">
                                                    <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                    <input type="hidden" name="date_absence" value="{{ $date_absence }}">

                                                    {{ $inscrit->eleve->nom.' '.$inscrit->eleve->prenom }}
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <br>
                                                        <select class="form-control" name="status[]" id="status" required>
                                                            <option></option>
                                                            @if ($inscrit->eleve->sexe == 'Masculin')
                                                                <option value="present" @if($inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status',"present")->where('d_ab',$date_absence)->first()) selected @endif>Présent</option>
                                                                <option value="absent" @if($inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status',"absent")->where('d_ab',$date_absence)->first()) selected @endif>Absent</option>
                                                            @else
                                                                <option value="presente" @if($inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status',"presente")->where('d_ab',$date_absence)->first()) selected @endif>Présente</option>
                                                                <option value="absente" @if($inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status',"absente")->where('d_ab',$date_absence)->first()) selected @endif>Absente</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <br>
                                                        <select class="form-control" name="motif[]" id="motif">
                                                            <option></option>
                                                            <option value="justifier" @if($inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('motif',"justifier")->where('d_ab',$date_absence)->first()) selected @endif>Justifié</option>
                                                            <option value="non_justifier" @if($inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('motif',"non_justifier")->where('d_ab',$date_absence)->first()) selected @endif>Non justifié</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                            <br>
                                                        <textarea class="form-control" name="commentaire[]" id="commentaire" rows="1">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('d_ab',$date_absence)->pluck('commentaires')->first() }}</textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                         <button type="submit" class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection