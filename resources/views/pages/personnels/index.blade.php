{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Personnels-Listes'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Liste Du Personnel</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Personnel</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Liste Du Personnel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Liste Du Personnel</header>
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
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group">
                                <a href="{{ route('home') }}" id="addRow"
                                    class="btn btn-info">
                                    <i class="fa fa-reply"></i> Retour
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('Personnel.create') }}" id="addRow"
                                    class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Ajouter Un Personnel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> Nom </th>
                                    <th> Prénom </th>
                                    <th> Poste </th>
                                    <th> Téléphone</th>
                                    {{-- <th> Quartier</th> --}}
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_personnels as $personnel)
                                    <tr class="odd gradeX">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $personnel->nom }}</td>
                                        <td class="left">{{ $personnel->prenom }}</td>
                                        <td>
                                            {{ $personnel->poste }}
                                        </td>
                                        <td>
                                            {{ $personnel->telephone }}
                                        </td>
                                        {{-- <td>
                                            {{ $personnel->quartier }}
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('Personnel.show',$personnel->id) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-eye "></i> Afficher
                                            </a>
                                            <a href="{{ route('Personnel.edit',$personnel->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i> Modifier
                                            </a>
                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $personnel->id }})"
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
                                                            <form action="{{ route('Personnel.destroy',$personnel->id) }}" method="post" id="deleteform">
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
{{-- script utiliser pour la suppression un personnel --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("Personnel.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
