{{-- on herite du theme actif --}}
@extends($chemin_theme_actif,['title'=>'matieres-listes'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('matiere.ListeMatiere')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('home.Matieres')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('matiere.ListeMatiere')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('matiere.ListeMatiere')</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6">
                            <a href="{{ route('home') }}">
                                <div class="btn-group">
                                    <button id="addRow1" class="btn btn-info">
                                        <i class="fa fa-reply"></i> @lang('liste_eleve.Retour')
                                    </button>
                                </div>
                            </a>
                            <a href="{{ route('matiere.create') }}">
                                <div class="btn-group">
                                    <button id="addRow1" class="btn btn-primary">
                                        @lang('matiere.AjoutMatiere') <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </a>
                            <a href="{{ route('config_matiere') }}" class="btn btn-primary"><i class="fa fa-cog"></i> @lang('home.Configurations')</a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <div class="form-group">
                                    <select onchange="window.location.href = this.value" class="form-control" name="classe" id="classe">
                                        <option value="{{ route('matiere.index') }}">@lang('matiere.AfficherParClasse')</option>
                                        @foreach ($all_classes as $classe)
                                            <option value="{{ route('matiere_par_classe',$classe->id) }}">{{ $classe->nom_niveau.' '.$classe->options }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column"
                            style="width: 100%" id="matieres">
                            <thead>
                                <tr>
                                    <th > N° </th>
                                    <th  class="text-center"> @lang('home.Matieres') </th>
                                    <th class="text-center">@lang('liste_eleve.Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_matieres as $key => $matiere)
                                    <tr class="odd gradeX">
                                        <td>{{ $i++ }}</td>
                                        <td class="text-center"> {{ $matiere->nom_matiere }} </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" href="#modifMatiere" data-toggle="modal" data-target="#modifMatiere{{ $matiere->id }}">
                                                <i class="fa fa-pencil"></i> @lang('liste_eleve.Modifier')
                                            </a>
                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $matiere->id }})"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i> @lang('liste_eleve.Supprimer')
                                            </a>
                                            <!-- modification -->
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="modifMatiere{{ $matiere->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <h4 class="modal-title text-center" id="myModalLabel">@lang('matiere.ModifMatiere')</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <form action="{{ route('modification_de_matiere',$matiere->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}
                                                                        <input type="hidden" name="id_matiere" value="{{ $matiere->id }}">
                                                                        <div class="form-group">
                                                                            <label  for="matiere">@lang('matiere.NomMatière')</label>
                                                                            <input class="form-control" type="text" name="nom_matiere" id="matiere" value="{{ $matiere->nom_matiere }}" required>
                                                                        </div>
                                                                        <br>
                                                                        <div class="container center">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> @lang('note.Valider')</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> @lang('note.Annuler')</button>
                                                                        </div>
                                                                    </form>

                                                            </div>
                                                            <div class="modal-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end modification -->
                                            <!--start suppression -->
                                                <div id="myModal" class="mt-5 modal fade" data-backdrop="static">
                                                    <div class="mt-5 modal-dialog modal-confirm">
                                                        <div class="modal-content">
                                                            <div class="modal-header flex-column">
                                                                <div class="icon-box">
                                                                    <i class="material-icons">&#xE5CD;</i>
                                                                </div>
                                                                <h4 class="modal-title w-100">@lang('note.Confirmation')</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{-- <p>
                                                                    Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                </p> --}}
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('note.Annuler')</button>
                                                                <form action="{{ route('suppression_de_matiere',$matiere->id) }}" method="post" id="deleteform">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                        @lang('note.OuiSupprimer')
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--end suppression -->
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
             var url = '{{ route("suppression_de_matiere", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
