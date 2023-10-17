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
                        href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                    <header>@lang('matiere.ListeMatiere') @lang('liste_eleve.De') @lang('liste_eleve.la') {{ $niveau->nom_niveau.' '.$niveau->options }}</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6">
                            <a href="{{ route('matiere.index') }}">
                                <div class="btn-group">
                                    <button id="addRow1" class="btn btn-info">
                                        <i class="fa fa-reply"></i> @lang('liste_eleve.Retour')
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <div class="form-group">
                                    <select onchange="window.location.href = this.value" class="form-control" name="classe" id="classe">
                                        <option value="{{ route('matiere.index') }}">Afficher les matières par classe</option>
                                        @foreach ($all_classes as $classe)
                                            <option value="{{ route('matiere_par_classe',$classe->id) }}" @if($classe->id == $niveau->id) selected @endif>{{ $classe->nom_niveau.' '.$classe->options }}</option>
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
                                    <th> N° </th>
                                    <th> @lang('home.Matieres') </th>
                                    <th class="text-center"> @lang('note.Coefficient') </th>
                                    <th class="text-center"> @lang('note.Barème') </th>
                                    <th> @lang('liste_eleve.Actions') </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($niveau->matieres as $key => $matiere)
                                    <tr class="odd gradeX">
                                        <td>{{ $i++ }} </td>
                                        <td> {{ $matiere->nom_matiere }} </td>
                                        <td class="text-center"> {{ $matiere->pivot->coefficient }}</td>
                                        <td class="text-center"> {{ $matiere->pivot->bareme }}</td>
                                        <td>
                                            <!-- start bouton modifier -->
                                            <a class="btn btn-primary" href="#configModal" data-toggle="modal" data-target="#configModal{{ $matiere->id }}">
                                                <i class="fa fa-pencil"></i> @lang('liste_eleve.Modifier')
                                            </a>
                                            <!-- end bouton modifier -->
                                            <!-- start bouton supprimer -->
                                            <a href="#myModalDelete" data-toggle="modal" onclick="deleteData({{ $matiere->id }})"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i> @lang('matiere.SupprimerMatiereClasse')
                                            </a>
                                            <!-- end bouton supprimer -->
                                            <!-- start modal modifier -->
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="configModal{{ $matiere->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <h4 class="modal-title text-center" id="myModalLabel">@lang('matiere.ConfigMatiere')</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    <h4 class="media-heading">
                                                                        @lang('home.Matieres') {{ $matiere->nom_matiere }}
                                                                    </h4>
                                                                </div>
                                                                    <form action="{{ route('matiere.update',$matiere->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}
                                                                        <input type="hidden" name="niveau_id" id="niveau_id" value="{{ $niveau->id }}">
                                                                        <div class="form-group">
                                                                            <label  for="coefficient">@lang('note.Coefficient')</label>
                                                                            <input class="form-control" type="number" name="coefficient" id="coefficient" value="{{  $matiere->pivot->coefficient }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="bareme">@lang('note.Barème')</label>
                                                                            <input class="form-control" type="number" name="bareme" id="bareme" value="{{ $matiere->pivot->bareme }}" required>
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
                                            <!-- end modal modifier -->
                                            <!-- start modal supprimer -->
                                            <div id="myModalDelete" class="mt-5 modal fade" data-backdrop="static">
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
                                                            <form action="{{ route('matiere.destroy',$matiere->id) }}" method="post" id="deleteform">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="hidden" name="niveau_id" value="{{ $niveau->id }}">
                                                                <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                    @lang('note.OuiSupprimer')
                                                                </button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal supprimer -->
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
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("matiere.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
