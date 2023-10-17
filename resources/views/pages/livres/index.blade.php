@extends($chemin_theme_actif,['title' => 'Livre'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion Des Livres</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Livres</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion Des Livres</li>
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
                                    <header>Gestion Des Livres</header>
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
                                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Ajouter Un Livre</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- start modal body -->
                                                                <div class="modal-body">
                                                                    <form action="{{ route('livre.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label for="ibsn">ISBN </label>
                                                                            <input type="text" name="ibsn" id="ibsn" class="form-control" value="{{ old('ibsn') }}" placeholder="Entrez le ibsn" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="titre">Titre Du Livre</label>
                                                                            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre')}}" placeholder="Entrez le titre" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="annee">Annee</label>
                                                                            <input type="text" name="annee" id="annee" class="form-control" value="{{ old('annee')}}" placeholder="Entrez l'annee">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nbre_page">Nbre De Page</label>
                                                                            <input type="number" name="nbre_page" id="nbre_page" class="form-control" value="{{ old('nbre_page')}}" placeholder="Entrez le nombre de page">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nbre_examplaire">Nbre D'examplaire</label>
                                                                            <input type="number" name="nbre_examplaire" id="nbre_examplaire" class="form-control" value="{{ old('nbre_examplaire')}}" placeholder="Entrez le nombre d'examplaire">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="auteur_id">Auteur Du Livre</label>
                                                                            <select  name="auteur_id" id="auteur_id" class="form-control select2" required>
                                                                              <option value="">Sélectionnez un auteur</option>
                                                                                @foreach ($all_auteurs as $auteur)
                                                                                    <option value="{{ $auteur->id }}">{{ $auteur->nom.' '.$auteur->prenom }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="category_id">Categorie Du Livre</label>
                                                                            <select  name="category_id" id="category_id" class="form-control select2" required>
                                                                              <option value="">Sélectionnez une Categorie</option>
                                                                                @foreach ($all_categories as $categorie)
                                                                                    <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                                                                @endforeach
                                                                            </select>
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
                                                    <th class="text-center"> N° </th>
                                                    <th class="text-center"> ISBN </th>
                                                    <th class="text-center"> Titre </th>
                                                    <th class="text-center"> Auteur </th>
                                                    <th class="text-center"> Categorie </th>
                                                    <th class="text-center"> Nbre.Page </th>
                                                    <th class="text-center"> Nbre.Ex </th>
                                                    <th class="text-center"> Nbre Emprunter</th>
                                                    <th class="text-center"> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_livres as $livre)
                                                    <tr class="odd gradeX">
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td class="text-center">{{ $livre->isbn }}</td>
                                                        <td class="text-center">{{ $livre->titre }}</td>
                                                        <td class="text-center">{{ $livre->auteur->nom.' '.$livre->auteur->prenom}}</td>
                                                        <td class="text-center">{{ $livre->category->libelle }}</td>
                                                        <td class="text-center">{{ $livre->nbre_page }}</td>
                                                        <td class="text-center">{{ $livre->nbre_examplaire }}</td>
                                                        <td class="text-center">
                                                            {{ $livre->emprunts->where('status',0)->count() }}
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#classes{{ $livre->id }}">Modifier
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <!-- debut modal -->
                                                                <div class="modal fade" data-backdrop="static" id="classes{{ $livre->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                                                                    <form action="{{ route('livre.update',$livre->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                            <label for="ibsn">ISBN </label>
                                                                                            <input type="text" name="ibsn" id="ibsn" class="form-control" value="{{ $livre->isbn }}" placeholder="Entrez le ibsn" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="titre">Titre Du Livre</label>
                                                                                            <input type="text" name="titre" id="titre" class="form-control" value="{{ $livre->titre }}" placeholder="Entrez le titre" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="annee">Annee</label>
                                                                                            <input type="text" name="annee" id="annee" class="form-control" value="{{ $livre->annee }}" placeholder="Entrez l'annee" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="nbre_page">Nbre De Page</label>
                                                                                            <input type="number" name="nbre_page" id="nbre_page" class="form-control" value="{{ $livre->nbre_page }}" placeholder="Entrez le nombre de page" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="nbre_examplaire">Nbre D'examplaire</label>
                                                                                            <input type="number" name="nbre_examplaire" id="nbre_examplaire" class="form-control" value="{{ $livre->nbre_examplaire }}" placeholder="Entrez le nombre d'examplaire" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="auteur_id">Auteur Du Livre</label>
                                                                                            <select  name="auteur_id" id="auteur_id" class="form-control select2" required>
                                                                                              <option value="">Sélectionnez un auteur</option>
                                                                                                @foreach ($all_auteurs as $auteur)
                                                                                                    <option value="{{ $auteur->id }}" @if($auteur->id == $livre->auteur_id) selected @endif>{{ $auteur->nom.' '.$auteur->prenom }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="category_id">Categorie Du Livre</label>
                                                                                            <select  name="category_id" id="category_id" class="form-control select2" required>
                                                                                              <option value="">Sélectionnez une Categorie</option>
                                                                                                @foreach ($all_categories as $categorie)
                                                                                                    <option value="{{ $categorie->id }}" @if($categorie->id == $livre->category_id) selected @endif>{{ $categorie->libelle }}</option>
                                                                                                @endforeach
                                                                                            </select>
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
                                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $livre->id }})"
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
                                                                            <form action="{{ route('livre.destroy',$livre->id) }}" method="post" id="deleteform">
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
<script type="text/javascript">
    $('#annee').datepicker({
       minViewMode: 2,
       format: 'yyyy',
       autoclose: true
     });
</script>
<script>
   $.fn.modal.Constructor.prototype.enforceFocus = function() {};
</script>
@endsection
{{-- script utiliser pour la suppression un auteur --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("livre.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>


