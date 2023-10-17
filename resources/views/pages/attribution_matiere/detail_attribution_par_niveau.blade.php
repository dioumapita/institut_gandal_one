{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Enseignant-Matiere-Niveau'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Détails Attribution Matière</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Attribution De Matiere</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Détails Attribution Matière</li>
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
                        <a href="{{ route('attribution_de_matiere_par_niveau',$niveau_id) }}">
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
                                    <th> Matière Enseignée </th>
                                    <th class="text-center"> Prix Par Heure</th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_enseignement as $key => $enseigner)
                                    <tr>
                                        <td class="patient-img">
                                            <img src="/images/photos/enseignants/{{ $enseigner->user->avatar }}"
                                                alt="photo_enseignant">
                                        </td>
                                        <td>
                                            {{ $enseigner->user->nom. ' '.$enseigner->user->prenom }}
                                        </td>
                                        <td>
                                            {{ $enseigner->matiere->nom_matiere }}
                                        </td>
                                        <td class="text-center">
                                            {{ $enseigner->prix_heure.' GNF' }}
                                        </td>
                                        <td>

                                            <div class="btn-group">
                                                <button class="btn btn-primary  btn-outline" data-toggle="modal" data-target="#classes{{ $enseigner->matiere->id }}">
                                                    <i class="fa fa-edit"></i> Modifier
                                                </button>
                                                <!-- debut modal -->
                                                    <div class="modal fade" data-backdrop="static" id="classes{{ $enseigner->matiere->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification De L'attribution De Matière</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <!-- start modal body -->
                                                                    <div class="modal-body">
                                                                        <div class="center">
                                                                            <img src="/images/photos/enseignants/{{ $enseigner->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                            <h4 class="media-heading">
                                                                                {{ $enseigner->user->nom. ' '.$enseigner->user->prenom }}<br>
                                                                                Matière: {{ $enseigner->matiere->nom_matiere }}
                                                                            </h4>
                                                                        </div>
                                                                        <form action="{{ route('attribution.update',$enseigner->matiere->id) }}" method="post">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('PUT') }}
                                                                            <input type="hidden" name="user_id" value="{{ $enseigner->user->id }}">
                                                                            <input type="hidden" name="niveau_id" value="{{ $enseigner->niveau->id }}">
                                                                            <div class="form-group">
                                                                                <label for="prix_heure">Prix Par Heure: </label>
                                                                                <input type="number" name="prix_heure" id="prix_heure" class="form-control" value="{{ $enseigner->prix_heure }}"
                                                                                placeholder="prix par heure" required>
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
                                            </div>
                                            <!--bouton suppression -->
                                            <form action="{{ route('attribution.destroy',$enseigner->matiere->id) }}" method="post" class="inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="user_id" value="{{ $enseigner->user->id }}">
                                                <input type="hidden" name="niveau_id" value="{{ $enseigner->niveau->id }}">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Retirer la matière à l'enseignant</button>
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
{{-- script utiliser pour la suppression d'un niveau --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("attribution.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
