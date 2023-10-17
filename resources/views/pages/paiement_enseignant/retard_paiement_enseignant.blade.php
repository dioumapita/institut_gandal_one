{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Retard-Paiement-Enseignant'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Les Enseignants En Retard De Paiement</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Les Enseignants En Retard De Paiement</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Les Enseignants En Retard De Paiement</header>
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
                                <a href="{{ route('etat_paiement_enseignant') }}" id="addRow"
                                    class="btn btn-info">
                                        <i class="fa fa-reply"></i> Retour
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('total_paiement_enseignant') }}" id="addRow"
                                    class="btn btn-primary">
                                    <i class="fa fa-money"></i>
                                    Les enseignants en règle de paiement
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
                                    <th>Image</th>
                                    <th> Enseignants </th>
                                    <th> Salaire à payer </th>
                                    <th> Salaire déjà payer </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_enseignant as $enseignant)
                                    @if (($enseignant->emargements->sum('gains') - $enseignant->paiementEnseignants->sum('somme_payer')) > 0)
                                        <tr class="odd gradeX">
                                            <td class="patient-img">
                                                <img src="/images/photos/enseignants/{{ $enseignant->avatar }}"
                                                    alt="photo_enseignant">
                                            </td>
                                            <td>{{ $enseignant->nom.' '.$enseignant->prenom }}</td>
                                            <td>{{ number_format($enseignant->emargements->sum('gains'),0,',',' ').' GNF' }}  </td>
                                            <td>
                                                {{ number_format($enseignant->paiementEnseignants->sum('somme_payer'),0,',',' ').' GNF' }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
