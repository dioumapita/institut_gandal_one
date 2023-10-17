{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Listes-Eleves-Réinscrits'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Liste Des Elèves Réinscrits</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Elèves</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Liste Des Elèves Réinscrits</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Liste Des Elèves Réinscrits de la {{ $niveau_choisit->nom_niveau.' '.$niveau_choisit->options }}</header>
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
                                <a href="{{ route('eleve.index') }}" id="addRow"
                                    class="btn btn-primary">
                                    <i class="fa fa-reply"></i> Retour
                                </a>
                            </div>
                            <div class="btn-group pull-right">
                                <button id="addRow1" data-toggle="modal" data-target="#all_niveau" class="btn btn-danger">
                                    <i class="fa fa-list"></i> Afficher par classe
                                </button>
                                <!-- debut modal -->
                                    <div class="modal fade" data-backdrop="static" id="all_niveau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Afficher par classe</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">@lang('note.Select_classe')</label>
                                                                <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id" required>
                                                                <option value=""></option>
                                                                @foreach ($all_niveaux as $key => $niveau)
                                                                    <option value="{{ route('listes_eleves_reinscrits_par_niveau',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button class="btn btn-primary" data-dismiss="modal"> @lang('note.Annuler')<i class="fa fa-times"></i></button>
                                                            </div>
                                                    </div>
                                                <!-- end modal body -->
                                            </div>
                                        </div>
                                    </div>
                                <!-- fin modal -->
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    {{-- <th>Image</th> --}}
                                    <th> Matricule </th>
                                    <th> Nom </th>
                                    <th> Prénom </th>
                                    <th> Classe</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_reinscrits as $reinscrit)
                                    <tr class="odd gradeX">
                                        {{-- <td class="patient-img">
                                            <img src="/assets/asset_principal/img/std/std1.jpg"
                                                alt="profil_eleve">
                                        </td> --}}
                                        <td class="left">{{ $reinscrit->eleve->matricule }}</td>
                                        <td>{{ $reinscrit->eleve->nom }}</td>
                                        <td class="left">{{ $reinscrit->eleve->prenom }}</td>
                                        <td>{{ $reinscrit->niveau->nom_niveau.' '.$reinscrit->niveau->options }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $reinscrit->eleve->id }}">
                                                <i class="fa fa-pencil"></i> modifier
                                            </a>
                                            {{-- <div class="container"> --}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal{{ $reinscrit->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <h4 class="modal-title text-center" id="myModalLabel">Modification D'une Réinscription</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    {{-- <img src="/assets/asset_principal/img/std/std1.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a> --}}
                                                                    <h4 class="media-heading">
                                                                        {{ $reinscrit->eleve->nom.' '.$reinscrit->eleve->prenom }} <br>
                                                                        Matricule: {{ $reinscrit->eleve->matricule }} <br>
                                                                        Contact: {{ $reinscrit->eleve->telephone_parent }}
                                                                    </h4>
                                                                </div>
                                                                    <form action="{{ route('update_reinscription_eleve',$reinscrit->eleve->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}
                                                                        <div class="form-group">
                                                                            <label for="">Classe:</label>
                                                                            <select class="form-control" name="niveau_id" id="niveau_id" required>
                                                                                <option value="">Selectionnez une classe</option>
                                                                                @foreach ($all_niveaux as $niveau)
                                                                                    <option value="{{ $niveau->id }}" @if($reinscrit->niveau->id == $niveau->id) selected="selected" @endif>{{ $niveau->nom_niveau.' '.$niveau->options }}</option>
                                                                                @endforeach
                                                                            </select>
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
                                            {{-- </div> --}}
                                            <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $reinscrit->eleve->id }})"
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
                                                            <form action="{{ route('delete_reinscription_eleve',$reinscrit->eleve->id) }}" method="post" id="deleteform">
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
{{-- script utiliser pour la suppression d'un eleve --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("delete_reinscription_eleve", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
