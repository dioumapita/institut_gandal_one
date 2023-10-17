@extends($chemin_theme_actif,['title' => 'Auteur'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Liste Des Auteurs</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Auteur</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Liste Des Auteurs</li>
        </ol>
    </div>
</div>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <div class="tabbable-line">
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-red">
                                <div class="card-head">
                                    <header>Liste Des Auteurs</header>
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
                                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Ajouter Un Fournisseur</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- start modal body -->
                                                                <div class="modal-body">
                                                                    <form action="{{ route('auteur.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label for="nom">Nom </label>
                                                                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Entrez le nom" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="prenom">Prénom</label>
                                                                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom')}}" placeholder="Entrez le prénom" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="date_naiss">Date De Naissance</label>
                                                                            <input type="date" name="date_naiss" id="date_naiss" class="form-control" value="{{ old('date_naiss')}}" placeholder="Entrez la date de naissance">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nationnalite">Nationnalité</label>
                                                                            <input type="text" name="nationnalite" id="nationnalite" class="form-control" value="{{ old('nationnalite')}}" placeholder="Entrez la nationnalite">
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
                                                    <th class="text-center"> Date-Naiss </th>
                                                    <th class="text-center"> Nationnalité </th>
                                                    <th class="text-center"> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_auteurs as $auteur)
                                                    <tr class="odd gradeX">
                                                        <td class="text-center">{{ $auteur->nom }}</td>
                                                        <td class="text-center">{{ $auteur->prenom }}</td>
                                                        <td class="text-center">{{ $auteur->date_naiss->format('d/m/Y') }}</td>
                                                        <td class="text-center">{{ $auteur->nationnalite }}</td>
                                                        <td>
                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#classes{{ $auteur->id }}">Modifier
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <!-- debut modal -->
                                                                <div class="modal fade" data-backdrop="static" id="classes{{ $auteur->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification Des Informations</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <!-- start modal body -->
                                                                                <div class="modal-body">
                                                                                    <form action="{{ route('auteur.update',$auteur->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                            <label for="nom">Nom</label>
                                                                                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $auteur->nom }}" placeholder="Nom" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="prenom">Prénom</label>
                                                                                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $auteur->prenom }}" placeholder="Prénom" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="date_naiss">Date De Naissance</label>
                                                                                            <input type="date" name="date_naiss" id="date_naiss" class="form-control" value="{{ $auteur->date_naiss->format('Y-m-d') }}" placeholder="Entrez la date de naissance">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="nationnalite">Nationnalité</label>
                                                                                            <input type="text" name="nationnalite" id="nationnalite" class="form-control" value="{{ $auteur->nationnalite }}" placeholder="Entrez la nationnalite">
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
                                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $auteur->id }})"
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
                                                                            <form action="{{ route('auteur.destroy',$auteur->id) }}" method="post" id="deleteform">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- script utiliser pour la suppression un auteur --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("auteur.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
