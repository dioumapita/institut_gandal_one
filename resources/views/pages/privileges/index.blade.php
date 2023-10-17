@extends($chemin_theme_actif,['title' => 'Gestion des privilèges'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion Des Privilèges</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Compte</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion Des Privilèges</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Gestion Des Privilèges</header>
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
                                <th class="text-center"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_roles as $role)
                                @foreach($role->users as $travailleur)
                                    <tr class="odd gradeX">
                                        <td style="width: 20%" class="text-center">{{ $travailleur->nom }}</td>
                                        <td class="text-center">{{ $travailleur->prenom }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#nouveau{{ $travailleur->id }}">Permission
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <!-- debut modal -->
                                                <div class="modal fade" data-backdrop="static" id="nouveau{{ $travailleur->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Attribution De Permission</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- start modal body -->
                                                                <div class="modal-body">
                                                                    <form action="{{ route('privilege.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="user_id" value="{{ $travailleur->id }}">
                                                                        <div class="form-group">
                                                                            <label for="privilege_id">Permission</label>
                                                                            <select  name="privilege_id[]" id="privilege_id" class="form-control select2" multiple required>
                                                                            <option value="">Sélectionnez</option>
                                                                                @foreach ($all_permissions as $permission)
                                                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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
                                            <a href="{{ route('privilege.show',$travailleur->id) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-eye "></i> Détail
                                            </a>

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
