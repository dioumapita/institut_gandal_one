{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Historique-Paiement-Enseignant'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Historique De Paiement D'un Enseignant</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Historique De Paiement D'un Enseignant</li>
            </ol>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
    <br><br>
    <div id="media_screen" class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <div class="card">
                <div class="card-head card-topline-aqua">
                    <header>Informations De L'enseignant</header>
                </div>
                <div class="card-body no-padding height-9">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nom: {{ $enseignant->nom }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Prénom: {{ $enseignant->prenom }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Téléphone: {{ $enseignant->telephone }}</b>
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
                        <header>Historique De Paiement D'un Enseignant</header>
                    </div>
                    <div class="white-box">
                            <div class="table-scrollable mt-5">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                        id="eleves">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> Montant Payer </th>
                                            <th class="text-center"> Mois</th>
                                            <th class="text-center"> Type De Paiement</th>
                                            <th class="text-center"> Date </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_paiement as $paiement)
                                            <tr class="odd gradeX">
                                                <td class="text-center" style="width: 20%">
                                                    {{ number_format($paiement->somme_payer,0,',',' ').' GNF' }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($paiement->mois_paiement == 1)
                                                        {{ "Janvier" }}
                                                    @elseif($paiement->mois_paiement == 2)
                                                        {{ "Février" }}
                                                    @elseif($paiement->mois_paiement == 3)
                                                        {{ "Mars" }}
                                                    @elseif($paiement->mois_paiement == 4)
                                                        {{ "Avril" }}
                                                    @elseif($paiement->mois_paiement == 5)
                                                        {{ "Mai" }}
                                                    @elseif($paiement->mois_paiement == 6)
                                                        {{ "Juin"}}
                                                    @elseif($paiement->mois_paiement == 7)
                                                        {{ "Juillet" }}
                                                    @elseif($paiement->mois_paiement == 8)
                                                        {{ "Août" }}
                                                    @elseif($paiement->mois_paiement== 9)
                                                        {{ "Septembre" }}
                                                    @elseif($paiement->mois_paiement == 10)
                                                        {{ "Octobre" }}
                                                    @elseif($paiement->mois_paiement == 11)
                                                        {{ "Novembre" }}
                                                    @else
                                                        {{ "Décembre" }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $paiement->type_paiement }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $paiement->date_paiement->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $paiement->id }}">
                                                        <i class="fa fa-pencil"></i> Modifier
                                                    </a>
                                                    <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $paiement->id }})"
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
                                                                <div class="modal-body">
                                                                    <p>
                                                                        Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                    <form action="{{ route('paiement_enseignant.destroy',$paiement->id) }}" method="post" id="deleteform">
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
                                                        <div class="modal fade" id="myModal{{ $paiement->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                        <h4 class="modal-title text-center" id="myModalLabel">Modification Du Paiement D'un Enseignant</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="center">
                                                                            <img src="/images/photos/enseignants/{{ $paiement->user->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                            <h4 class="media-heading">{{ $paiement->user->nom.' '.$paiement->user->prenom }}
                                                                                <br>
                                                                            </h4>
                                                                        </div>
                                                                            <form action="{{ route('paiement_enseignant.update',$paiement->id) }}" method="post">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('PUT') }}
                                                                                <div class="form-group">
                                                                                    <label for="montant">Montant Payer *</label>
                                                                                    <input type="number"
                                                                                    class="form-control" name="montant" id="montant" value="{{ $paiement->somme_payer }}" aria-describedby="helpId" placeholder="Entrez le montant payer" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="mois_paiement">Mois</label>
                                                                                    <select  class="form-control" name="mois_paiement" id="mois_paiement">
                                                                                    <option value="">Selectionnez le mois</option>
                                                                                        <option value="1" @if($paiement->mois_paiement == 1) selected @endif>Janvier</option>
                                                                                        <option value="2" @if($paiement->mois_paiement == 2) selected @endif>Fevrier</option>
                                                                                        <option value="3" @if($paiement->mois_paiement == 3) selected @endif>Mars</option>
                                                                                        <option value="4" @if($paiement->mois_paiement == 4) selected @endif>Avril</option>
                                                                                        <option value="5" @if($paiement->mois_paiement == 5) selected @endif>Mai</option>
                                                                                        <option value="6" @if($paiement->mois_paiement == 6) selected @endif>Juin</option>
                                                                                        <option value="7" @if($paiement->mois_paiement == 7) selected @endif>Juillet</option>
                                                                                        <option value="8" @if($paiement->mois_paiement == 8) selected @endif>Août</option>
                                                                                        <option value="9" @if($paiement->mois_paiement == 9) selected @endif>Septembre</option>
                                                                                        <option value="10" @if($paiement->mois_paiement == 10) selected @endif>Octobre</option>
                                                                                        <option value="11" @if($paiement->mois_paiement == 11) selected @endif>Novembre</option>
                                                                                        <option value="12" @if($paiement->mois_paiement == 12) selected @endif>Décembre</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="type_paiement">Type De Paiement *</label>
                                                                                    <select class="form-control" name="type_paiement" id="type_paiement" required>
                                                                                    <option value="Espèce" @if($paiement->type_paiement == "Espèce") selected @endif>Espèce</option>
                                                                                    <option value="Dépot" @if($paiement->type_paiement == "Dépot") selected @endif>Dépôt</option>
                                                                                    <option value="Chèque" @if($paiement->type_paiement == "Chèque") selected @endif>Chèque</option>
                                                                                    <option value="Autres" @if($paiement->type_paiement == "Autres") selected @endif>Autres</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="date_paiement">Date Paiement *</label>
                                                                                    <input type="date"
                                                                                        class="form-control" name="date_paiement" id="date_paiement" value="{{ $paiement->date_paiement->format('Y-m-d') }}" aria-describedby="helpId" placeholder="Entrez la date de paiement" required>
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
                                    <u>Total:</u> {{ number_format($all_paiement->sum('somme_payer'),0,',',' ').' GNF' }}
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
{{-- script utiliser pour la suppression d'un paiement --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("paiement_enseignant.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
