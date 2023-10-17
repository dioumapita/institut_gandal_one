@extends($chemin_theme_actif,['title' => 'Détail-Reduction'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Historique Des Remises D'un Elève</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Remise</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Historique Des Remises D'un Elève</li>
        </ol>
    </div>
</div>
<a href="{{ route('remise_paiement_eleve.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
    <div class="profile-sidebar">
        <div class="card">
            <div class="card-head card-topline-aqua">
                <header>Informations De l'élève</header>
            </div>
            <div class="card-body no-padding height-9">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Matricule: {{ $info_eleve->eleve->matricule }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Nom: {{ $info_eleve->eleve->nom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Prénom: {{ $info_eleve->eleve->prenom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Classe: {{ $info_eleve->niveau->nom_niveau.' '.$info_eleve->niveau->options }}</b>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- END BEGIN PROFILE SIDEBAR -->

        <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>Historique Des Remises D'un Elève</header>
                        </div>
                        <div class="white-box">
                            {{-- <a id="media_screen" onclick="printDiv('imprime')" href="#" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Imprimer le reçu</a> --}}
                                <br>
                                <div class="table-scrollable mt-5">
                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                            >
                                        <thead>
                                            <tr>
                                                <th class="text-center"> Montant Réduit </th>
                                                <th class="text-center"> Type De Réduiction</th>
                                                <th class="text-center"> Date </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_remises as $remise)
                                                <tr class="odd gradeX">
                                                    <td class="text-center">
                                                        {{ number_format($remise->montant_reduit,0,',',' ') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $remise->type }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $remise->date_reduction->format('d/m/Y') }}
                                                    </td>
                                                    <td>

                                                        <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $remise->id }}">
                                                            <i class="fa fa-pencil"></i> Modifier
                                                        </a>
                                                        <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $remise->id }})"
                                                            class="btn btn-danger">
                                                            <i class="fa fa-trash"></i> Supprimer
                                                        </a>
                                                        <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                            <div class="mt-5 modal-dialog modal-confirm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header flex-column">
                                                                        <div class="icon-box">
                                                                            <i class="material-icons">&#xE5CD;</i>
                                                                        </div>
                                                                        <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                        <form action="{{ route('remise_paiement_eleve.destroy',$remise->id) }}" method="post" id="deleteform">
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
                                                        <div class="container">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal{{ $remise->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                            <h4 class="modal-title text-center" id="myModalLabel">Modification Du Rémise</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('remise_paiement_eleve.update',$remise->id) }}" method="post">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('PUT') }}
                                                                                <div class="form-group">
                                                                                    <label for="montant_reduit">Montant Réduit *</label>
                                                                                    <input type="number"
                                                                                    class="form-control" name="montant_reduit" id="montant_reduit" value="{{ $remise->montant_reduit }}" aria-describedby="helpId" placeholder="" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="type">Type De Remise</label>
                                                                                    <select class="form-control" name="type" id="type" required>
                                                                                    <option value="Pour le personnel" @if($remise->type == "Pour le personnel") selected @endif>Pour le personnel</option>
                                                                                    <option value="Pour un dont" @if($remise->type == "Pour un dont") selected @endif>Pour un dont</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="date_reduction">Date *</label>
                                                                                    <input type="date"
                                                                                        class="form-control" name="date_reduction" id="date_reduction" value="{{ $remise->date_reduction->format('Y-m-d') }}" aria-describedby="helpId" placeholder="" required>
                                                                                </div>
                                                                                <br>
                                                                                <div class="container center">
                                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h3>
                                        <u>Montant Total:</u> {{ number_format($info_eleve->eleve->remisePaiementEleves->sum('montant_reduit'),0,',',' ').' GNF' }}<br>
                                    </h3>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
@endsection
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("remise_paiement_eleve.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
