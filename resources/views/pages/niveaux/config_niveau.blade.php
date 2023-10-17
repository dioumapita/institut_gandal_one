{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Config_Niveau'])
@section('content')
    <!-- Start title -->
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Configuration Du Paiement Des Frais Scolaire</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="#">Accueil</a>&nbsp;
                            <i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Configuration Du Paiement Des Frais Scolaire</li>
                </ol>
            </div>
        </div>
    <!-- End title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Configuration Du Paiement Des Frais Scolaire</header>
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
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('niveaux.create') }}" class="btn btn-primary">
                                    Ajouter une classe
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="{{ route('niveaux.index') }}" class="btn btn-primary">
                                    Liste des classes
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
                                    <th> Classes </th>
                                    <th>Frais D'inscription</th>
                                    <th>Frais De Réinscription</th>
                                    <th> Scolarité Annuel </th>
                                    <th>Mensualité</th>
                                    <th> Tranche 1 Inscription</th>
                                    <th> Tranche 1 Réinscription</th>
                                    <th> Tranche 2 </th>
                                    <th> Tranche 3 </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_niveaux as $key => $niveau)
                                    <tr class="odd gradeX">
                                       <td>{{ $i++ }}</td>
                                       <td>{{ $niveau->nom_niveau.' '.$niveau->options }}</td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription }}
                                            @else

                                            @endif
                                        </td>
                                        <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription }}
                                            @else

                                            @endif
                                        </td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite}}
                                            @else

                                            @endif
                                       </td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->mensualite }}
                                            @else

                                            @endif
                                       </td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche1 }}
                                            @else

                                            @endif
                                       </td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche1_reinscription }}
                                            @else

                                            @endif
                                       </td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche2 }}
                                            @else

                                            @endif
                                        </td>
                                       <td>
                                            @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0)
                                                {{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche3 }}
                                            @else

                                            @endif
                                       </td>
                                       <td>
                                            <a class="btn btn-danger btn-block" href="#configModal" data-toggle="modal" data-target="#configModal{{ $niveau->id }}">
                                                <i class="fa fa-pencil"></i> Modifier
                                            </a>
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="configModal{{ $niveau->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                <h4 class="modal-title text-center" id="myModalLabel">Configuration Du Paiement Des Frais Scolaire</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    <h4 class="media-heading">
                                                                        Classe: {{ $niveau->nom_niveau.' '.$niveau->options }}
                                                                    </h4>
                                                                </div>
                                                                    <form action="{{ route('update_config_niveau',$niveau->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}
                                                                        <input type="hidden" name="annee_id" value="{{ $annee_courante->id }}">
                                                                        <input type="hidden" name="niveau_id" value="{{ $niveau->id }}">
                                                                        <div class="form-group">
                                                                            <label  for="frais_inscription">Frais D'inscription</label>
                                                                            <input class="form-control" type="number" name="frais_inscription" id="frais_inscription" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_inscription }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="frais_reinscription">Frais De Réinscription</label>
                                                                            <input class="form-control" type="number" name="frais_reinscription" id="frais_reinscription" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->frais_reinscription }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="scolarite_annuel">Scolarité Annuel</label>
                                                                            <input class="form-control" type="number" name="scolarite_annuel" id="scolarite_annuel" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->scolarite }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="mensualite">Mensualité</label>
                                                                            <input class="form-control" type="number" name="mensualite" id="mensualite" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->mensualite }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="tranche1">Tranche 1 Inscription:</label>
                                                                            <input class="form-control" type="number" name="tranche1" id="tranche1" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche1 }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="tranche1">Tranche 1 Réinscription:</label>
                                                                            <input class="form-control" type="number" name="tranche1_reinscription" id="tranche1" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche1_reinscription }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="tranche2">Tranche 2:</label>
                                                                            <input class="form-control" type="number" name="tranche2" id="tranche2" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche2 }}" @else value=""  @endif required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label  for="tranche3">Tranche 3:</label>
                                                                            <input class="form-control" type="number" name="tranche3" id="tranche3" @if($niveau->frais_scolaires->where('annee_id',$annee_courante->id)->count() > 0) value="{{ $niveau->frais_scolaires->where('annee_id',$annee_courante->id)->first()->tranche3 }}" @else value=""  @endif required>
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
