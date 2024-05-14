{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Eleve-Paiement'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Historique De Paiement Des Frais Scolaire D'un Elève</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Historique De Paiement Des Frais Scolaire D'un Elève</li>
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
                                <header>Historique De Paiement D'un Elève</header>
                            </div>
                            <div class="white-box">
                                {{-- <a id="media_screen"  href="#" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Imprimer le reçu</a> --}}
                                    <br>
                                    <div class="table-scrollable mt-5">
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                >
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"> Montant Payer </th>
                                                    <th> Mois</th>
                                                    <th> Tranche</th>
                                                    <th> Type Paiement</th>
                                                    <th> Date </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_paiement as $paiement)
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            {{ number_format($paiement->somme_payer,0,',',' ') }}
                                                        </td>
                                                        <td>
                                                            {{ $paiement->mois }}
                                                        </td>
                                                        <td>
                                                            {{ $paiement->tranche }}
                                                        </td>
                                                        <td>
                                                            {{ $paiement->type_paiement }}
                                                        </td>
                                                        <td>
                                                            {{ $paiement->date_paiement->format('d/m/Y') }}
                                                        </td>
                                                        <td>
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
                                                                            <form action="{{ route('paiement_eleve.destroy',$paiement->id) }}" method="post" id="deleteform">
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
                                        <h3>
                                            <u>Scolarité Annuel:</u>
                                                @if($info_eleve->status == 1)
                                                    {{ number_format((($info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - $info_eleve->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}<br>
                                                @else
                                                    {{ number_format((($info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - $info_eleve->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}<br>
                                                @endif
                                            <u>Scolarité Payer:</u> {{ number_format($all_paiement->sum('somme_payer'),0,',',' ').' GNF' }}<br>
                                            <u>Reste:</u>
                                            @if($info_eleve->status == 1)
                                                {{ number_format(($info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription) - ($all_paiement->sum('somme_payer') + $info_eleve->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}
                                            @else
                                                {{ number_format(($info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite + $info_eleve->niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription) - ($all_paiement->sum('somme_payer') + $info_eleve->eleve->remisePaiementEleves->where('annee_id',$annee_courante->id)->sum('montant_reduit')),0,',',' ').' GNF' }}
                                            @endif
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
{{-- script utiliser pour la suppression d'un eleve --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("paiement_eleve.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
