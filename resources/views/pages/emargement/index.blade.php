{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Enseignant-Par-Niveau'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Gestions Emargements</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Emargements</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Gestions Emargements</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>Emargements du jour: {{ date('d/m/Y') }}</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6">
                                    <a href="{{ route('home') }}">
                                        <div class="btn-group">
                                            <button id="addRow1" class="btn btn-info">
                                               <i class="fa fa-reply"></i> Retour
                                            </button>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="btn-group pull-right">
                                        <button class="btn deepPink-bgcolor  btn-outline" data-toggle="modal" data-target="#emargement">Choisir une classe pour émarger
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <!-- debut modal -->
                                            <div class="modal fade" data-backdrop="static" id="emargement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Gestions Emargements</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- start modal body -->
                                                            <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="">Selectionner une classe</label>
                                                                        <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id">
                                                                         <option value=""></option>
                                                                        @foreach ($all_niveaux as $key => $niveau)
                                                                            <option value="{{ route('emargement_par_niveau',$niveau) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                    </div>
                                                                    {{-- <button type="submit">valider</button> --}}
                                                                    <div class="modal-footer d-flex justify-content-center">
                                                                        <button class="btn btn-primary" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                    </div>
                                                            </div>
                                                        <!-- end modal body -->
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- fin modal -->
                                    </div>
                                </div>
                            </div>
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                    id="eleves"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> Image </th>
                                            <th class="text-center"> Enseignants </th>
                                            <th class="text-center"> Matières </th>
                                            <th class="text-center"> Heure Début </th>
                                            <th class="text-center"> Heure Fin </th>
                                            <th class="text-center"> Classe </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_emargement as $key => $emargement)
                                            <tr class="odd gradeX">
                                                <td class="patient-img">
                                                    <img src="/images/photos/enseignants/{{ $emargement->user->avatar }}"
                                                        alt="">
                                                </td>
                                                <td> {{ $emargement->user->nom.' '.$emargement->user->prenom }} </td>
                                                <td class="text-center">{{ $emargement->matiere->nom_matiere }}</td>
                                                <td class="text-center">
                                                    {{ $emargement->heure_debut->format('H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $emargement->heure_fin->format('H:i') }}
                                                </td>
                                                <td class="text-center"> {{ $emargement->niveau->nom_niveau.' '.$emargement->niveau->options }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
