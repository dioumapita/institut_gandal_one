{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' =>'Credits-Personnels'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Gestion Des Crédits Du Personnel</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Crédit</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Gestion Des Crédits Du Personnel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Gestion Des Crédits Du Personnel</header>
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
                                    <i class="fa fa-reply"></i>Retour
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
                                    <th>Personnel</th>
                                    <th> Poste</th>
                                    <th> Montant Crédit </th>
                                    <th> Montant Rembouser </th>
                                    <th> Reste à Rembourser </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_personnels as $personnel)
                                    <tr class="odd gradeX">
                                        <td style="width: 18%">{{ $personnel->nom.' '.$personnel->prenom }} </td>
                                        <td>{{ $personnel->poste }}</td>
                                        <td>{{ number_format($personnel->creditPersonnels->sum('montant_credit'),0,',',' ').' GNF' }}  </td>
                                        <td>{{ number_format($personnel->creditPersonnels->sum('montant_rembourser'),0,',',' ').' GNF'}}  </td>
                                        <td>{{ number_format($personnel->creditPersonnels->sum('montant_credit') - $personnel->creditPersonnels->sum('montant_rembourser'),0,',',' ').' GNF'}}</td>
                                        <td>
                                            <a class="btn btn-danger" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $personnel->id }}">
                                                <i class="fa fa-money"></i> Effectuer Un Prêt
                                            </a>
                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#rembourser{{ $personnel->id }}">
                                                <i class="fa fa-money"></i> Rembourser Un Prêt
                                            </a>
                                            <a href="{{ route('creditpersonnel.show',$personnel->id) }}" class="btn btn-info"><i class="fa fa-recycle"></i> Historique</a>
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal{{ $personnel->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title text-center" id="myModalLabel">Effectuer Un Prêt</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <form action="{{ route('creditpersonnel.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="personnel_id" value="{{ $personnel->id }}">
                                                                        <div class="form-group">
                                                                            <label for="montant_credit">Montant Crédit *</label>
                                                                            <input type="number"
                                                                            class="form-control" name="montant_credit" id="montant_credit"  aria-describedby="helpId" placeholder="Veuillez saisir le montant crédit" required min="0" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="motif">Motif *</label>
                                                                            <input type="text"
                                                                                class="form-control" name="motif" id="motif"  aria-describedby="helpId" placeholder="Entrez le motif du crédit" required  />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="montant">Date *</label>
                                                                            <input type="date"
                                                                                class="form-control" name="date_credit" id="date_credit"  aria-describedby="helpId" placeholder="" required />
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
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="rembourser{{ $personnel->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-primary col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title text-center" id="myModalLabel">Rembourser Un Prêt</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($personnel->creditPersonnels->sum('montant_credit') - $personnel->creditPersonnels->sum('montant_rembourser') <= 0)
                                                                    <h3 class="text-center">Vous ne pouvez pas effectuez de <br>remboursement</h3>
                                                                    <div class="center">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                                                                    </div>
                                                                @else
                                                                    <form action="{{ route('creditpersonnel.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="personnel_id" value="{{ $personnel->id }}">
                                                                        <div class="form-group">
                                                                        <label for="montant_rembourser">Montant Rembourser *</label>
                                                                        <input type="number"
                                                                            class="form-control" name="montant_rembourser" id="montant_rembourser" max="{{ $personnel->creditPersonnels->sum('montant_credit') - $personnel->creditPersonnels->sum('montant_rembourser') }}"  aria-describedby="helpId" placeholder="" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="montant">Date *</label>
                                                                            <input type="date"
                                                                                class="form-control" name="date_credit" id="date_credit"  aria-describedby="helpId" placeholder="" required />
                                                                        </div>
                                                                        <br>
                                                                        <div class="container center">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                        </div>
                                                                    </form>
                                                                @endif
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
