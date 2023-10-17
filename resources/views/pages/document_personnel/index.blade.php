@extends($chemin_theme_actif,['title' => 'Document-Personnel'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Document Du Personnel</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Document</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Document Du Personnel</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Gestion Des Documents Du Personnel</header>
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
                                <th> N° </th>
                                <th> Personnel </th>
                                <th> Poste </th>
                                <th> Téléphone</th>
                                <th> Nbre de documents</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_personnels as $personnel)
                                <tr class="odd gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $personnel->prenom.' '.$personnel->nom }}</td>
                                    <td>{{ $personnel->poste }}</td>
                                    <td>
                                        {{ $personnel->telephone }}
                                    </td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#nouveau{{$personnel->id}}">Joindre un document
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <!-- debut modal -->
                                            <div class="modal fade" data-backdrop="static" id="nouveau{{$personnel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Joindre un document</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- start modal body -->
                                                            <div class="modal-body">
                                                                <form action="#" method="post">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group">
                                                                        <label for="document">Choisir le document</label>
                                                                        <input type="file" name="document" id="document" class="form-control" value="{{ old('document')}}" placeholder="choisir le document" required>
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
                                            <a href="#" class="btn btn-info btn-block">Détail<i class="fa fa-eye"></i></a>
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
