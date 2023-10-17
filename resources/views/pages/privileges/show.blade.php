@extends($chemin_theme_actif,['title' => 'Détail-Privilège'])
@section('content')
<!-- Start title -->
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Détail Des Permissions</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="#">Accueil</a>&nbsp;
                    <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Détail Des Permissions</li>
        </ol>
    </div>
</div>
<!-- End title -->
<a href="{{ route('privilege.index')}}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
<br>
<br>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <div class="card">
                    <div class="card-head card-topline-aqua">
                        <header>Utilisateur</header>
                    </div>
                    <div class="card-body no-padding height-9">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nom: {{ $travailleur->nom }}</b>
                            </li>
                            <li class="list-group-item">
                                <b>Prénom: {{ $travailleur->prenom }}</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>Détail Des Permissions</header>
                        </div>
                        <div class="white-box">
                            <div  class="container">
                                <div class="row">
                                </div>
                            </div>
                                <h3 class="text-center"><u>Détail Des Permissions</u></h3>
                                <div class="table-scrollable mt-5">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">N°</th>
                                                <th class="text-center">Permission</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($travailleur->permissions as $permission)
                                                    <tr>
                                                        <td class="text-center">{{ $p++ }}</td>
                                                        <td class="text-center">{{ $permission->name}}</td>
                                                        <td class="">
                                                            <a href="#deletepaiement" data-toggle="modal" onclick="deletePermission({{ $permission->id }})"
                                                                class="btn btn-danger btn-block">
                                                                <i class="fa fa-trash"></i> Annuler
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
                                                                                De vouloir retirer ce privilège à l'utilisateur ?
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-center">
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                                            <form action="{{ route('privilege.update',$permission->id) }}" method="post" id="deletePaiementClient">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('PUT') }}
                                                                                <input type="hidden" name="user_id" value="{{ $travailleur->id }}">
                                                                                <button  type="button"  onclick = "formPaiement()" class="btn btn-danger" data-dismiss="modal">
                                                                                    Oui Annuler
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
                            <div id="detail">

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
    function deletePermission(id)
          {
              var id = id;
              var url = '{{ route("privilege.update", ":id") }}';
              url = url.replace(':id', id);
              $("#deletePaiementClient").attr('action', url);
          }
          function formPaiement()
          {
              // alert("bonjour");
              $("#deletePaiementClient").submit();
          }
</script>
