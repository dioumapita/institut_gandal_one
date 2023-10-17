{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Emargement-Detail'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Détails Emargement Des Enseignants</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Emargement</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Détails Emargement Des Enseignants</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>Classe: {{ $niveau_choisit->nom_niveau.' '.$niveau_choisit->options }}</header>
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
                            <div class="col-md-6 col-sm-6 col-6">
                                <a href="{{ route('emargement_par_niveau',$id_niveau) }}">
                                    <div class="btn-group">
                                        <button id="addRow1" class="btn btn-info">
                                            <i class="fa fa-reply"></i> Retour
                                        </button>
                                    </div>
                                </a>
                            </div>
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                        id="eleves">
                                    <thead>
                                        <tr>
                                            <th> Image </th>
                                            <th> Enseignants </th>
                                            <th class="text-center"> Matières </th>
                                            <th class="text-center"> Heure Début </th>
                                            <th class="text-center"> Heure Fin </th>
                                            <th class="text-center"> Date D'emargement </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_emargement_niveau as $key => $emargement_niveau)
                                            <tr>
                                                <td class="patient-img">
                                                    <img src="/images/photos/enseignants/{{ $emargement_niveau->user->avatar }}"
                                                        alt="photo_enseignant">
                                                </td>
                                                <td>
                                                    {{ $emargement_niveau->user->nom. ' '.$emargement_niveau->user->prenom }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $emargement_niveau->matiere->nom_matiere }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $emargement_niveau->heure_debut->format('H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $emargement_niveau->heure_fin->format('H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $emargement_niveau->date_emarg->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    
                                                    <div class="btn-group">
                                                        {{-- <button class="btn btn-primary  btn-outline" data-toggle="modal" data-target="#classes{{ $emargement_niveau->id }}">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </button> --}}
                                                        <!-- debut modal -->
                                                            {{-- <div class="modal fade" data-backdrop="static" id="classes{{ $emargement_niveau->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification De L'emargement</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <!-- start modal body -->
                                                                            <div class="modal-body">
                                                                                <div class="center">
                                                                                        <img src="/images/photos/enseignants/{{ $emargement_niveau->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                                        
                                                                                    <h4 class="media-heading"> 
                                                                                        {{ $emargement_niveau->user->nom. ' '.$emargement_niveau->user->prenom }}<br>
                                                                                        Matière: {{ $emargement_niveau->matiere->nom_matiere }}<br>
                                                                                        Date: {{ $emargement_niveau->date_emarg->format('d/m/Y') }}
                                                                                    </h4>
                                                                                </div>
                                                                                <form action="{{ route('emargement.update',$emargement_niveau->id) }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('PUT') }}
                                                                                    <input type="hidden" name="user_id" value="{{ $emargement_niveau->user->id }}">
                                                                                    <input type="hidden" name="niveau_id" value="{{ $emargement_niveau->niveau->id }}">
                                                                                    <input type="hidden" name="date_emarg" value="{{ $emargement_niveau->date_emarg }}">
                                                                                    <input type="hidden" name="matiere_id" value="{{ $emargement_niveau->matiere->id }}">
                                                                                    <div class="form-group">
                                                                                        <label for="">Heure Début</label>
                                                                                        <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ $emargement_niveau->heure_debut->format('H:i') }}" placeholder="" aria-describedby="helpId">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Heure Fin</label>
                                                                                        <input type="time"  name="heure_fin" id="heure_fin" class="form-control" value="{{ $emargement_niveau->heure_fin->format('H:i') }}" placeholder="" aria-describedby="helpId">
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
                                                            </div> --}}
                                                        <!-- fin modal -->
                                                    </div>
                                                    <!--bouton suppression -->
                                                    <a href="#myModalDelete" data-toggle="modal" onclick="deleteData({{ $emargement_niveau->id}})"
                                                        class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> Supprimer
                                                    </a>
                                                    <div id="myModalDelete" class="mt-5 modal fade" data-backdrop="static">
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
                                                                    <form action="{{ route('emargement.destroy',$emargement_niveau->id) }}" method="post" id="deleteform">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
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
        @endsection

        {{-- script utiliser pour la suppression d'un niveau --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("emargement.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>