@extends($chemin_theme_actif,['title' => 'Détail-Attribution-Niveau'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Détails Attribution De Classe</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Attribution De Classe</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Détails Attribution De Classe</li>
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
                    <a href="{{ route('attribution_de_matiere_par_niveau',$niveau_choisit->id) }}">
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
                                <th> Contact</th>
                                <th> Classe Enseignée </th>
                                <th> Salaire</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if($enseignant_niveau != null)
                                    <td class="patient-img">
                                        <img src="/images/photos/enseignants/{{ $enseignant_niveau->user->avatar }}"
                                            alt="photo_enseignant">
                                    </td>
                                    <td>
                                        {{ $enseignant_niveau->user->nom. ' '.$enseignant_niveau->user->prenom }}
                                    </td>
                                    <td>
                                        {{ $enseignant_niveau->user->telephone }}
                                    </td>
                                    <td>
                                        {{ $niveau_choisit->nom_niveau.' '.$niveau_choisit->options }}
                                    </td>
                                    <td>
                                        {{ number_format($enseignant_niveau->salaire,0,',',' ') }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary  btn-outline" data-toggle="modal" data-target="#classes">
                                            <i class="fa fa-edit"></i> Modifier
                                        </button>
                                        <!-- debut modal -->
                                            <div class="modal fade" data-backdrop="static" id="classes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification De L'attribution De Classe</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- start modal body -->
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    <img src="/images/photos/enseignants/{{ $enseignant_niveau->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                    <h4 class="media-heading">
                                                                        {{ $enseignant_niveau->user->nom. ' '.$enseignant_niveau->user->prenom }}<br>
                                                                    </h4>
                                                                </div>
                                                                <form action="#" method="post">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}
                                                                    <input type="hidden" name="user_id" value="{{ $enseignant_niveau->user->id }}">
                                                                    <input type="hidden" name="niveau_id" value="{{ $niveau_choisit->id }}">
                                                                    <div class="form-group">
                                                                        <label for="salaire">Salaire : </label>
                                                                        <input type="number" name="salaire" id="salaire" class="form-control" value="{{ $enseignant_niveau->salaire }}"
                                                                        placeholder="salaire de l'enseignant" required>
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
                                        <!--bouton suppression -->
                                        <form action="{{ route('enseigne_niveau.destroy',$enseignant_niveau->id) }}" method="post" class="inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Retirer la classe à l'enseignant</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("enseigne_niveau.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
