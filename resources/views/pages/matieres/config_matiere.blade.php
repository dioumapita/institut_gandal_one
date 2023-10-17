{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Config-Matiere'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">@lang('matiere.ConfigMatiere')</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">@lang('home.Matieres')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">@lang('matiere.ConfigMatiere')</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>@lang('matiere.ConfigMatiere')</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh"
                                    href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down"
                                    href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times"
                                    href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 col-sm-6 col-6">

                                    <div class="btn-group">
                                        <a href="{{ route('home') }}">
                                            <button id="addRow1" class="btn btn-info">
                                                <i class="fa fa-reply"></i> @lang('liste_eleve.Retour')
                                            </button>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <button id="addRow1" data-toggle="modal" data-target="#all_niveau" class="btn btn-primary">
                                            <i class="fa fa-list"></i> @lang('matiere.AfficherParClasse')
                                        </button>
                                    </div>
                                    <!-- debut modal -->
                                        <div class="modal fade" data-backdrop="static" id="all_niveau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div  class="modal-header btn btn-danger text-center text-white">
                                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('matiere.AfficherParClasse')</h4>
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
                                                                    @foreach ($all_niveau as $key => $niveau)
                                                                        <option value="{{ route('matiere_par_classe',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
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
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                        id="matieres">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> N° </th>
                                            <th class="text-center"> @lang('home.Matieres') </th>
                                            <th class="text-center"> @lang('liste_eleve.Actions') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_matieres as $matiere)
                                            <tr>
                                                <td class="text-center">
                                                   {{ $i++ }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $matiere->nom_matiere }}
                                                </td>
                                                <td>

                                                    <div class="">
                                                        <button class="btn deepPink-bgcolor  btn-block" data-toggle="modal" data-target="#classes{{ $matiere->id }}">@lang('matiere.AttributionMatiere')
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                        <!-- debut modal -->
                                                            <div class="modal fade" data-backdrop="static" id="classes{{ $matiere->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">@lang('matiere.ConfigMatiere')</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <!-- start modal body -->
                                                                            <div class="modal-body">
                                                                                <div class="center">
                                                                                    <h4 class="media-heading">
                                                                                        @lang('home.Matieres') {{ $matiere->nom_matiere}}
                                                                                    </h4>
                                                                                </div>
                                                                                <form action="{{ route('store_config_matiere') }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="matiere_id" value="{{ $matiere->id }}">
                                                                                    <!-- start coefficient -->
                                                                                        <div class="form-group">
                                                                                            <label for="coefficient" class="control-label col-md-3">@lang('note.Coefficient')
                                                                                                <span class="required"> * </span>
                                                                                            </label>
                                                                                            <div class="">
                                                                                                <div class="input-group spinner">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-info" data-dir="dwn"
                                                                                                            type="button">
                                                                                                            <span class="fa fa-minus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                    <input type="number" id="coefficient" name="coefficient"
                                                                                                        class="form-control text-center @error('coefficient')is-invalid @enderror"
                                                                                                        value="1"  min="1" max="4">
                                                                                                        @error('coefficient')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                            <span class="fa fa-plus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <!--end coefficient -->
                                                                                    <!-- start bareme -->
                                                                                        <div class="form-group">
                                                                                            <label for="bareme" class="control-label col-md-3">@lang('note.Barème')
                                                                                                <span class="required"> * </span>
                                                                                            </label>
                                                                                            <div class="">
                                                                                                <div class="input-group spinner">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-info" data-dir="dwn"
                                                                                                            type="button">
                                                                                                            <span class="fa fa-minus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                    <input type="number" id="bareme" name="bareme"
                                                                                                        class="form-control text-center @error('bareme')is-invalid @enderror"
                                                                                                        value="10" min="5" max="20">
                                                                                                        @error('bareme')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    <span class="input-group-btn">
                                                                                                        <button class="btn btn-danger" data-dir="up" type="button">
                                                                                                            <span class="fa fa-plus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <!-- end bareme -->
                                                                                    <!-- Start Classe -->
                                                                                        <div class="form-group">
                                                                                            <label for="niveau" class="control-label col-md-3">@lang('liste_eleve.Classe')
                                                                                                <span class="required"> * </span>
                                                                                            </label>
                                                                                            <div class="">
                                                                                                <select id="niveau" name="niveau" class="form-control @error('niveau')is-invalid @enderror" required>
                                                                                                    <option value="">@lang('matiere.Selectionnez')</option>
                                                                                                    @foreach ($all_niveau as $niveau)
                                                                                                        <option value="{{ $niveau->id }}">{{ $niveau->nom_niveau.' '.$niveau->options }}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                                @error('niveau')
                                                                                                    <span class="invalid-feedback" role="alert">
                                                                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                                    </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>
                                                                                    <!-- End Classe -->

                                                                                        <div class="modal-footer d-flex justify-content-center">
                                                                                            <button type="submit" class="btn btn-primary" >@lang('note.Valider') <i class="fa fa-check"></i></button>
                                                                                            &nbsp;&nbsp;
                                                                                            <button class="btn btn-danger" data-dismiss="modal">@lang('note.Annuler') <i class="fa fa-times"></i></button>
                                                                                        </div>
                                                                                </form>
                                                                            </div>
                                                                        <!-- end modal body -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- fin modal -->
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
