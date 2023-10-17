{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Paiement-Personnel'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Paiement Du Personnel</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Paiement Du Personnel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Paiement Du Personnel</header>
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
                                    <th> Personnel </th>
                                    <th> Poste </th>
                                    <th> Total Montant Payer </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_personnels as $personnel)
                                    <tr class="odd gradeX">
                                        <td style="width: 18%">{{ $personnel->nom.' '.$personnel->prenom }}</td>
                                        <td>
                                            {{ $personnel->poste }}
                                        </td>
                                        <td>
                                            {{ number_format($personnel->paiementPersonnels->sum('somme_payer'),0,',',' ').' GNF' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $personnel->id }}">
                                                <i class="fa fa-money"></i> Effectuer Un Paiement
                                            </a>
                                            <a class="btn btn-primary" href="{{ route('paiement_personnel.show',$personnel->id) }}"><i class="fa fa-recycle"></i> Historique Des Paiements</a>
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal{{ $personnel->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title text-center" id="myModalLabel">Paiement Du Personnel</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if($personnel->creditPersonnels->sum('montant_credit') - $personnel->creditPersonnels->sum('montant_rembourser') > 0)
                                                                    <div class="center">
                                                                        <h4 class="media-heading">
                                                                            Vous ne pouvez pas effectuez un paiement car<br>
                                                                            {{ $personnel->nom.' '.$personnel->prenom }}
                                                                            <br>
                                                                            à une dette de {{ number_format($personnel->creditPersonnels->sum('montant_credit') - $personnel->creditPersonnels->sum('montant_rembourser'),0,',',' ').' GNF' }}
                                                                        </h4>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Fermer</button>
                                                                    </div>
                                                                @else
                                                                    <div class="center">
                                                                        <h4 class="media-heading">{{ $personnel->nom.' '.$personnel->prenom }}
                                                                            <br>
                                                                        Poste: {{ $personnel->poste }}
                                                                        </h4>
                                                                    </div>
                                                                        <form action="{{ route('paiement_personnel.store') }}" method="post">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="personnel_id" value="{{ $personnel->id }}">
                                                                            <div class="form-group">
                                                                            <label for="montant">Montant Payer *</label>
                                                                            <input type="number"
                                                                                class="form-control" name="montant" id="montant" aria-describedby="helpId" placeholder="" required min="0">
                                                                            </div>
                                                                            <div class="form-group">
                                                                            <label for="type_paiement">Type De Paiement</label>
                                                                            <select class="form-control" name="type_paiement" id="type_paiement" required>
                                                                                <option value="Espèce">Espèce</option>
                                                                                <option value="Dépot">Dépôt</option>
                                                                                <option value="Chèque">Chèque</option>
                                                                                <option value="Autres">Autres</option>
                                                                            </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="date_paiement">Date Paiement *</label>
                                                                                <input type="date"
                                                                                class="form-control" name="date_paiement" id="date_paiement" aria-describedby="helpId" placeholder="Entrez la date de paiement" required>
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
