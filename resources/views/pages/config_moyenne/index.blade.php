{{-- on herite du chemin du theme activer --}}
@extends($chemin_theme_actif,['title' => 'Config-Moyenne'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('note.ConfigMoyAdmission')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('note.Moyenne')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('note.ConfigMoyAdmission')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('note.ConfigMoyAdmission')</header>
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
                                    <i class="fa fa-reply"></i> @lang('liste_eleve.Retour')
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
                                    <th class="text-center">N°</th>
                                    <th class="text-center"> @lang('liste_eleve.Classe') </th>
                                    <th class="text-center"> @lang('note.Moyenne_admission') </th>
                                    <th> @lang('liste_eleve.Actions') </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_niveaux as $key => $niveau)
                                    <tr class="odd gradeX">
                                       <td class="text-center">{{ $i++ }}</td>
                                       <td class="text-center">{{ $niveau->nom_niveau.' '.$niveau->options }}</td>
                                       <td class="text-center">{{ $niveau->moyennee_admission }}</td>
                                       <td>
                                            <a class="btn btn-danger btn-block" href="#configModal" data-toggle="modal" data-target="#configModal{{ $niveau->id }}">
                                                <i class="fa fa-pencil"></i> @lang('liste_eleve.Modifier')
                                            </a>
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="configModal{{ $niveau->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                <h4 class="modal-title text-center" id="myModalLabel">@lang('note.ConfigMoy')</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    <h4 class="media-heading">
                                                                        @lang('liste_eleve.Classe') {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                                    </h4>
                                                                </div>
                                                                    <form action="{{ route('config_moyenne.update',$niveau->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}
                                                                        <div class="form-group">
                                                                            <label  for="">@lang('note.ConfigMoy')</label>
                                                                            <input class="form-control" type="number" name="moyenne_admission" id="moyenne_admission" value="{{ $niveau->moyennee_admission }}" required>
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
