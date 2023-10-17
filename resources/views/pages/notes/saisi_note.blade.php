@extends($chemin_theme_actif,['title' => 'Notes-Saisi'])
    @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Saisie Des Notes</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">Notes</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Saisie Des Notes</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <ul class="nav customtab nav-tabs">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                Mode de saisie unique
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>Saisie Des Notes</header>
                        <div class="tools">
                            <!-- start liste des notes -->
                               <form action="{{ route('note_filtrer') }}" method="GET">
                                    <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                    <input type="hidden" name="matiere" value="{{ $matiere_choisie->id }}">
                                    <input type="hidden" name="trimestre" value="{{ $trimestre_choisit->id }}">
                                    <input type="hidden" name="annee" value="{{ $annee_choisie->id }}">
                                    <button type="submit" class="btn-lg btn-primary">Liste des notes</button>
                               </form>
                            <!-- end liste des notes --> 
                        </div>
                    </div>
                    <div class="card-body ">
                        <button id="addRow1" class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">
                            Choisir une autre matière  <i class="fa fa-plus"></i>
                        </button>
                        <!-- debut modal -->
                        <div class="modal fade" data-backdrop="static" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div  class="modal-header btn btn-danger text-center text-white">
                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Mode De Saisi Unique</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!-- start modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('saisie_note') }}" method="GET">
                                                <input type="hidden" name="niveau_choisi" value="{{ $niveau_choisi->id }}">
                                                <input type="hidden" name="annee" id="annee" value="{{ $annee_choisie->id }}">
                                                <div class="form-group">
                                                    <label for="">Selectionner une matiere</label>
                                                    <select class="form-control" name="matiere" id="">
                                                    @foreach ($niveau_choisi->matieres as $key => $matiere)
                                                        <option value="{{ $matiere->id }}" @if($matiere->id == $matiere_choisie->id) selected @endif>{{ $matiere->nom_matiere}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Selectionner un trimestre</label>
                                                    <select class="form-control" name="trimestre" id="">
                                                    @foreach ($all_trimestres as $key => $trimestre)
                                                        <option value="{{ $trimestre->id }}" @if($trimestre->id == $trimestre_choisit->id) selected @endif>{{ $trimestre->nom_trimestre}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="">Selectionner une annee scolaire</label>
                                                    <select class="form-control" name="annee" id="">
                                                    @foreach ($all_annee as $key => $annees)
                                                        <option value="{{ $annees->id }}">{{ $annees->annee_scolaire}}</option>
                                                    @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary">Valider <i class="fa fa-check"></i></button>
                                                    <button class="btn btn-dark" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    <!-- end modal body -->
                                </div>
                            </div>
                        </div>
                        <!-- fin modal -->
                        <div class="row">
                            <div class="col-md-7 col-sm-7 col-7">
                                <div class="col-md-7 col-sm-7 col-7">
                                    <h4 class="text-bold full-width">Classe : {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</h4>
                                    <h5 class="text-bold full-width">Matière : {{ $matiere_choisie->nom_matiere }}</h5>
                                    <h5 class="text-bold full-width">Coefficient : {{ $coefficient }}</h5>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-5">
                                <div class="pull-right col-md-5 col-sm-5 col-5">
                                    <h5 class="text-bold full-width">Trimestre : {{ $trimestre_choisit->id }}</h5>
                                    <h5 class="text-bold full-width">Année Scolaire: {{ $annee_choisie->annee_scolaire }}</h5>
                                </div>
                            </div>
                        </div>
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                    style="width: 100%" id="notes">
                                    <thead>
                                        <tr>
                                            <th style="width:8%;"> Matricule </th>
                                            <th style="width:8%;"> Nom </th>
                                            <th style="width:18%;"> Prénom </th>
                                            <th> Note1 </th>
                                            <th> Note2 </th>
                                            <th> Note3 </th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($eleves_inscrits as $inscrits)
                                            <tr class="odd gradeX">
                                                <td>
                                                    {{ $inscrits->eleve->matricule}}
                                                </td>
                                                <td>
                                                    {{ $inscrits->eleve->nom}}
                                                </td>
                                                <td>
                                                    {{ $inscrits->eleve->prenom }}
                                                </td>
                                                <td id="note_unique">
                                                    <form action="{{ route('enregistre_note')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="eleve_id" value="{{ $inscrits->eleve->id }}">
                                                        <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                        <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisit->id }}">
                                                        <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                        <input type="hidden" name="annee_id" value="{{ $annee_choisie->id }}">
                                                        <input type="text" name="note1" id="" min="0" max="{{ $bareme }}"  class="input-small"
                                                            value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note1')->first()}}"
                                                        >
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
                                                <td id="note_unique">
                                                    <form action="{{ route('enregistre_note')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="eleve_id" value="{{ $inscrits->eleve->id }}">
                                                        <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                        <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisit->id }}">
                                                        <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                        <input type="hidden" name="annee_id" value="{{ $annee_choisie->id }}">
                                                        <input type="number" name="note2" id="" min="0" max="{{ $bareme }}"  class="input-small"
                                                            value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note2')->first()}}"
                                                        >
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
                                                <td id="note_unique">
                                                    <form action="{{ route('enregistre_note')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="eleve_id" value="{{ $inscrits->eleve->id }}">
                                                        <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                        <input type="hidden" name="trimestre_id" value="{{ $trimestre_choisit->id }}">
                                                        <input type="hidden" name="niveau_id" value="{{ $niveau_choisi->id }}">
                                                        <input type="hidden" name="annee_id" value="{{ $annee_choisie->id }}">
                                                        <input type="number" name="note3" id="" min="0" max="{{ $bareme }}"  class="input-small"
                                                            value="{{ $inscrits->eleve->notes->where('matiere_id',$matiere_choisie->id)->where('trimestre_id',$trimestre_choisit->id)->where('annee_id',$annee_choisie->id)->pluck('note3')->first()}}"
                                                        >
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
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

   