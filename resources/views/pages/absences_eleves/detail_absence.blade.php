{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Absences-Details'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Liste Des Absences Des Elèves</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Absences</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Liste Des Absences Des Elèves</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Liste Des Absences Des Elèves  En {{ $matiere_choisie->nom_matiere }}</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh"
                        href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down"
                        href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times"
                        href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-sm-12 col-12">
                    <a href="{{ url()->previous() }}">
                        <div class="btn-group">
                            <button id="addRow1" class="btn btn-info">
                                <i class="fa fa-reply"></i> Retour 
                            </button>
                        </div>
                    </a>
                    <form action="{{ route('absence_par_niveau',$niveau->id) }}" method="get" class="inline">
                        <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                        <button type="submit" class="btn btn-primary">Saisi Des Absences Des Elèves</button>
                    </form>
                    {{-- <a  id="imprimer" href="#" class="btn btn-primary"><i class="fa fa-print"></i>Imprimer les absences en {{ $matiere_choisie->nom_matiere }}</a> --}}
                    <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="Imprimer les absences en {{ $matiere_choisie->nom_matiere }}" />
                    <button id="addRow1" class="btn btn-primary" data-toggle="modal" data-target="#modalLoginForm">
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
                                            <form action="{{ route('detail_absence_eleve',$niveau->id) }}" method="GET">
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
                    <a href="{{ route('print_absences_eleves',$niveau->id) }}" class="btn btn-primary"><i class="fa fa-print"></i>Imprimer les absences pour toutes les matières</a>
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
                <div class="table-scrollable">
                    <table
                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                            id="eleves">
                        <thead>
                            <tr>
                                <th> Image </th>
                                <th> Elèves </th>
                                <th> Status </th>
                                <th> Motif </th>
                                <th> Commentaire </th>
                                <th> Date </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_absences as $key => $absence)
                                    <tr>
                                        <td class="patient-img">
                                            <img src="/images/photos/eleves/{{ $absence->eleve->photo_profil }}"
                                                alt="photo_eleve">
                                        </td>
                                        <td>
                                            {{ $absence->eleve->nom. ' '.$absence->eleve->prenom }}
                                        </td>
                                        <td>
                                            @if ($absence->status == 'absent')
                                                {{ 'Absent' }}
                                            @elseif($absence->status == 'absente')
                                                {{ 'Absente' }}
                                            @elseif($absence->status == 'present')
                                                {{ 'Présent' }}
                                            @elseif($absence->status == 'presente')
                                                {{ 'Présente' }}
                                            @else

                                            @endif
                                        </td>
                                        <td>
                                            @if ($absence->motif == 'justifier')
                                                {{ 'Justifier' }}
                                            @elseif($absence->motif == 'non_justifier')
                                                {{ 'Non Justifier' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $absence->commentaires }}
                                        </td>
                                        <td>
                                            {{ $absence->d_ab }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#absences{{ $absence->eleve->id }}">Modifier
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <!-- debut modal -->
                                                <div class="modal fade" data-backdrop="static" id="absences{{ $absence->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification de l'absence d'un élève</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- start modal body -->
                                                                <div class="modal-body">
                                                                    <div class="center">
                                                                        <img src="/images/photos/eleves/{{ $absence->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                        
                                                                    <h4 class="media-heading"> 
                                                                        {{ $absence->eleve->nom.' '.$absence->eleve->prenom }}
                                                                        <br>
                                                                        Matricule: {{ $absence->eleve->matricule }}
                                                                    </h4>
                                                                </div>
                                                                    <form action="{{ route('absence.update',$absence->eleve->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}
                                                                        <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                                        <input type="hidden" name="niveau_id" value="{{ $niveau->id }}">
                                                                        <input type="hidden" name="date_absence" value="{{ $absence->d_ab  }}">
                                                                        <!-- status -->
                                                                        <div class="form-group">
                                                                            <label for="status">Status</label>
                                                                            <select class="form-control" name="status" id="status" required>
                                                                                @if ($absence->eleve->sexe == 'Masculin')
                                                                                    <option value="present" @if($absence->status == 'present') selected @endif>Présent</option>
                                                                                    <option value="absent" @if($absence->status == 'absent') selected @endif>Absent</option>
                                                                                @else
                                                                                    <option value="presente" @if($absence->status == 'presente') selected @endif>Présente</option>
                                                                                    <option value="absente" @if($absence->status == 'absente') selected @endif>Absente</option>
                                                                                @endif
                                                                                
                                                                            </select>
                                                                        </div>
                                                                        <!-- motif -->
                                                                        <div class="form-group">
                                                                            <label for="motif">Motif</label>
                                                                            <select class="form-control" name="motif" id="motif">
                                                                                <option value=""></option>
                                                                                <option value="justifier" @if($absence->motif == 'justifier') selected @endif>Justifier</option>
                                                                                <option value="non_justifier" @if($absence->motif == 'non_justifier') selected @endif>Non Justifier</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- commentaires -->
                                                                        <div class="form-group">
                                                                            <label for="commentaire">Commentaire</label>
                                                                            <textarea class="form-control" name="commentaire" id="commentaire" rows="2">{{ $absence->commentaires }}</textarea>
                                                                        </div>

                                                                        <div class="modal-footer d-flex justify-content-center">
                                                                            <button type="submit" class="btn btn-primary" >Valider <i class="fa fa-check"></i></button>
                                                                            &nbsp;&nbsp;
                                                                            <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            <!-- end modal body -->
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- fin modal -->
                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $absence->eleve->id }})"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Supprimer
                                            </a>
                                            <div id="myModal" class="mt-5 modal fade" data-backdrop="static">
                                                <div class="mt-5 modal-dialog modal-confirm">
                                                    <div class="modal-content">
                                                        <div class="modal-header flex-column">
                                                            <div class="icon-box">
                                                                <i class="material-icons">&#xE5CD;</i>
                                                            </div>						
                                                            <h4 class="modal-title w-100">Êtes-vous certain?</h4>	
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <form action="{{ route('absence.destroy',$absence->eleve->id) }}" method="post" id="deleteform">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="hidden" name="matiere_id" value="{{ $matiere_choisie->id }}">
                                                                <input type="hidden" name="niveau_id" value="{{ $niveau->id }}">
                                                                <input type="hidden" name="date_absence" value="{{ $absence->d_ab  }}">
                                                                <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                    Oui Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
<br><br>
    <div id="imprime" class="row">
        {{-- utiliser pour l'impression (rendu css) --}}
        <style>
            @media print{
                .font-bold {
                    font-weight: bold;
                }
                
                .rouge{
                    color: rgb(255, 0, 0) !important;
                    font-style: italic !important;
                }
                .jaune{
                    color: yellow !important;
                    font-style: italic !important;
                }
                .vert{
                    color: rgb(6, 168, 6) !important;
                    font-style: italic !important;
                }
                #bordure_table{
                    border: 2px solid black !important;
                    font-size: 20px;
                }
                #bordure_tables{
                    width: 50px;
                    border: 2px solid black !important;
                    font-size: medium;
                    word-break: normal;
                } 
                .cercle{
                            border: 5px solid;
                            border-radius: 20px;
                            padding: 0px;
                            margin-right: -33px;
	                    }
                .align-top{
                            text-align: center;
                            margin-top: -68px;
                         }
            }
        </style>
        <div id="invisible-screen" class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <div class="pull-left">
                                <address>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">MEN-A</u>
                                        <br>
                                        
                                        <u class="souligner">I.R.E: CONAKRY</u>
                                        <br>
                                        
                                        <u class="souligner">D.C.E: MATOTO</u>
                                        
                                        <br>
                                        
                                        <u class="souligner">D.S.C.E: TOMBOLIA</u>
                                    </h4>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">GROUPE SCOLAIRE BILLY ECOLE (G.S.B.E) </u>
                                        <br> &emsp;&emsp;&emsp;&emsp;<u class="souligner">"NOUVELLE VISION"</u>
                                    </h4>
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">REPLUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                     <br>
                                       <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                    </h4>
                                </address>
                            </div>
                            <div class="center">
                                <br><br>
                                <img src="/images/photos/logos/billy_ecole.png" width="250px" heigth="250px" alt="logo_ecole" srcset="">
                                <br><br>
                            </div>
                        </div>
                        {{-- <br><br><br><br><br><br><br><br><br><br> --}}
                        <div class="row col-md-12 col-sm-12 col-lg-12">
                            <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                <div class="cercle">
                                    <div class="text-center">
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">Liste Des Absences Des Elèves <br>
                                                De La {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                <br>
                                                En {{ $matiere_choisie->nom_matiere }}
                                            </u><br>
                                            <u class="souligner"> 
                                               Pour L'anneé Scolaire {{ $annee_courante->annee_scolaire }}
                                             <br> 
                                            </u>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <table id="bordure_table" class="table table-bordered">
                                <th class="text-center" id="bordure_table">Matricule</th>
                                <th class="text-center" id="bordure_table">Nom </th>
                                <th class="text-center" id="bordure_table">Prénom</th>
                                <th class="text-center" id="bordure_table">Présence</th>
                                <th class="text-center" id="bordure_table">Abs Justifiée</th>
                                <th class="text-center" id="bordure_table">Abs Non Justifiée</th>
                                <tbody id="bordure_table">
                                    @foreach ($all_inscrits as $inscrit)
                                        <tr id="bordure_table">
                                            <td class="text-center" id="bordure_table">{{ $inscrit->eleve->matricule }}</td>
                                            <td class="text-center" id="bordure_table">{{ $inscrit->eleve->nom }}</td>
                                            <td class="text-center" id="bordure_table">{{ $inscrit->eleve->prenom }}</td>
                                            @if ($inscrit->eleve->sexe == 'Masculin')
                                                <td class="text-center" id="bordure_table">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status','present')->count() }}</td>
                                                <td class="text-center" id="bordure_table">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status','absent')->where('motif','justifier')->count() }}</td>
                                                <td class="text-center" id="bordure_table">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status','absent')->where('motif','non_justifier')->count() }}</td>
                                            @else
                                                <td class="text-center" id="bordure_table">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status','presente')->count() }}</td>
                                                <td class="text-center" id="bordure_table">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status','absente')->where('motif','justifier')->count() }}</td>
                                                <td class="text-center" id="bordure_table">{{ $inscrit->eleve->absEleves->where('matiere_id',$matiere_choisie->id)->where('niveau_id',$niveau->id)->where('status','absente')->where('motif','non_justifier')->count() }}</td>
                                            @endif
                                                
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="">
                            <h4 class=" pull-right font-bold addr-font-h4">
                              Conakry, le {{ date('d/m/Y') }}<br><br>La Direction
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- script utiliser pour la suppression d'une absence --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("absence.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>