@extends($chemin_theme_actif,['title' => 'Compte-User'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion Des Comptes Utilisateurs</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Compte</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion Des Comptes Utilisateurs</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Gestion Des Comptes Utilisateurs</header>
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
                        <div class="btn-group">
                            <a href="{{ route('home') }}" id="addRow"
                                class="btn btn-info">
                                <i class="fa fa-reply"></i> Retour
                            </a>
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#nouveau">Nouveau
                            <i class="fa fa-plus"></i>
                        </button>
                        <!-- debut modal -->
                            <div class="modal fade" data-backdrop="static" id="nouveau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div  class="modal-header btn btn-danger text-center text-white">
                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Nouveau Compte</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                            </button>
                                        </div>
                                        <!-- start modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('store.compte_user') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="nom">Nom</label>
                                                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Entrez le nom" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prenom">Prénom</label>
                                                        <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}" placeholder="Entrez le prénom" required>
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
                </div>
                <div class="table-scrollable">
                    <table
                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                            id="eleves">
                        <thead>
                            <tr>
                                <th class="text-center"> Nom </th>
                                <th class="text-center"> Prénom </th>
                                <th class="text-center"> Username </th>
                                <th class="text-center">Mot de passe</th>
                                <th class="text-center"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_roles as $role)
                                @foreach($role->users as $travailleur)
                                    <tr class="odd gradeX">
                                        <td style="width: 20%" class="text-center">{{ $travailleur->nom }}</td>
                                        <td class="text-center">{{ $travailleur->prenom }}</td>
                                        <td class="text-center">
                                            {{ $travailleur->username }}
                                        </td>
                                        <td class="text-center">
                                            {{-- {{ $travailleur->password }} --}}
                                        </td>
                                        <td>
                                            <a href="#deletepaiement" data-toggle="modal" onclick="deleteCompte({{ $travailleur->id }})"
                                                class="btn btn-danger btn-block">
                                                <i class="fa fa-trash"></i> Supprimer Le Compte
                                            </a>
                                            <div id="deletepaiement" class="mt-5 modal fade" data-backdrop="static">
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
                                                                De vouloir supprimer ce compte ?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                            <form action="{{ route('delete_compte',$travailleur->id) }}" method="post" id="deletePaiementClient">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button  type="button"  onclick = "formPaiement()" class="btn btn-danger" data-dismiss="modal">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function deleteCompte(id)
          {
              var id = id;
              var url = '{{ route("delete_compte", ":id") }}';
              url = url.replace(':id', id);
              $("#deletePaiementClient").attr('action', url);
          }
          function formPaiement()
          {
              // alert("bonjour");
              $("#deletePaiementClient").submit();
          }
</script>

