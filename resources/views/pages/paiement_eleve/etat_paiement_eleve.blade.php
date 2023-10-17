{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Etat-Paiement-Eleve'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Etat De Paiement Des Elèves</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Etat De Paiement Des Elèves</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Etat De Paiement Des Elèves</header>
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
                            &nbsp;
                            <div class="btn-group">
                                <a href="{{ route('retard_paiement_eleve') }}" id="addRow"
                                    class="btn btn-primary">
                                    <i class="fa fa-th-large"></i>
                                    Eleves en rétard de paiement
                                </a>
                            </div>
                            &nbsp;
                            <div class="btn-group">
                                <a href="{{ route('total_paiement_eleve') }}" id="addRow"
                                    class="btn btn-primary">
                                    <i class="fa fa-money"></i>
                                    Eleves en règle de paiement
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <button class="btn deepPink-bgcolor  btn-outline" data-toggle="modal" data-target="#emargement">Afficher par classe
                                    <i class="fa fa-plus"></i>
                                </button>
                                <!-- debut modal -->
                                    <div class="modal fade" data-backdrop="static" id="emargement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div  class="modal-header btn btn-danger text-center text-white">
                                                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Etat De Paiement Des Elèves</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="white-text">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- start modal body -->
                                                    <div class="modal-body">
                                                            <form action="{{ route('etat_paiement_eleve_par_classe') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="">Selectionner une classe</label>
                                                                    <select  class="form-control" name="niveau_id" id="niveau_id" required>
                                                                    <option value=""></option>
                                                                    @foreach ($all_niveaux as $key => $niveau)
                                                                        <option value="{{ $niveau->id }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select class="form-control" name="status" id="status" required>
                                                                        <option value="1">Tous les élèves</option>
                                                                        <option value="2">Les élèves en rétard de paiement</option>
                                                                        <option value="3">Les élèves en règle de paiement</option>
                                                                        <option value="4">Retard de paiement de la 1ère tranche</option>
                                                                        <option value="5">Retard de paiement de la 2ème tranche</option>
                                                                        <option value="6">Retard de paiement de la 3ème tranche</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="submit" class="btn btn-primary">Valider<i class="fa fa-check"> </i></button>
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
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th> Matricule </th>
                                    <th> Elève </th>
                                    <th> Classe</th>
                                    <th> Scolarite à payer </th>
                                    <th> Scolarite payer </th>
                                    <th> Reste </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $scolarite_total = 0;
                                    $scolarite_payer = 0;
                                    $reste = 0;
                                @endphp
                                @foreach ($all_inscriptions as $inscription)
                                    <tr class="odd gradeX">
                                        <td class="patient-img">
                                            <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}"
                                                alt="photo_profil">
                                        </td>
                                        <td class="left">{{ $inscription->eleve->matricule }}</td>
                                        <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                        <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>
                                        <td>{{ number_format(($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' ')." GNF" }} </td>
                                        <td>
                                            {{ number_format($inscription->eleve->paiementEleves->sum('somme_payer'),0,',',' ')." GNF" }}
                                        </td>
                                        <td>
                                            {{ number_format($inscription->niveau->scolarite - ($inscription->eleve->paiementEleves->sum('somme_payer') + $inscription->eleve->remisePaiementEleves->sum('montant_reduit')),0,',',' '). " GNF" }}
                                        </td>
                                    </tr>
                                    @php
                                          $scolarite_total = $scolarite_total + ($inscription->niveau->scolarite - $inscription->eleve->remisePaiementEleves->sum('montant_reduit'));
                                          $scolarite_payer = $scolarite_payer + $inscription->eleve->paiementEleves->sum('somme_payer');
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <h3>
                            <u>Scolarite Total:</u> {{ number_format($scolarite_total,0,',',' ').' GNF' }}<br>
                            <u>Scolarite Payer:</u> {{ number_format($scolarite_payer,0,',',' ').' GNF' }}<br>
                            <u>Reste:</u> {{  number_format($scolarite_total - $scolarite_payer,0,',',' '). ' GNF' }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
