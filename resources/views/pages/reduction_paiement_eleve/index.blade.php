@extends($chemin_theme_actif,['title' => 'Gestion des reductions'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion des rémises des frais scolaire</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Rémise</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion des rémises des frais scolaire</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Gestion des rémises des frais scolaire</header>
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
                                <th> Matricule </th>
                                <th> Elève </th>
                                <th> Classe</th>
                                <th> Montant Réduit </th>
                                <th style="width: 20%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_remise = 0;
                            @endphp
                            @foreach ($all_inscriptions as $inscription)
                                <tr class="odd gradeX">
                                    <td class="left">{{ $inscription->eleve->matricule }}</td>
                                    <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                    <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>
                                    <td>{{ number_format($inscription->eleve->remisePaiementEleves->sum('montant_reduit'),0,'',' ').' GNF' }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-block" href="#aboutModal" data-toggle="modal" data-target="#versement{{ $inscription->eleve->id }}">
                                            <i class="fa fa-money"></i> Effectuer Une Réduction
                                        </a>
                                        <a class="btn btn-primary btn-block" href="{{ route('remise_paiement_eleve.show',$inscription->eleve->id) }}">
                                            <i class="fa fa-recycle"></i> Historique
                                        </a>
                                        <div class="container">
                                            <!-- Modal -->
                                            <div class="modal fade" id="versement{{ $inscription->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                            <h4 class="modal-title text-center" id="myModalLabel">Effectuez Une Réduction</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="center">
                                                                <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                <h4 class="media-heading">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }} <br>
                                                                    Matricule: {{ $inscription->eleve->matricule }} <br>
                                                                    Contact: {{ $inscription->eleve->telephone_parent }}
                                                                </h4>
                                                            </div>
                                                            <form action="{{ route('remise_paiement_eleve.store') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="eleve_id" value="{{ $inscription->eleve_id }}">
                                                                <input type="hidden" name="niveau_id" value="{{ $inscription->niveau->id }}">
                                                                <div class="form-group">
                                                                    <label for="montant_reduit">Pourcentage Réduit *</label>
                                                                    <input type="number"
                                                                        class="form-control" name="montant_reduit" id="montant_reduit" value="{{ old('montant_reduit') }}"  aria-describedby="helpId" placeholder="" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="type">Selectionnez un type</label>
                                                                    <select class="form-control" name="type" id="type" required>
                                                                        <option value="Pour le personnel">Pour le personnel</option>
                                                                        <option value="Pour un dont">Pour le dont</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="date_reduction">Date *</label>
                                                                    <input type="date"
                                                                        class="form-control" name="date_reduction" id="date_reduction" value="{{ old('date_reduction') }}"  aria-describedby="helpId" placeholder="" required>
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
                                @php
                                    $total_remise = $total_remise + $inscription->eleve->remisePaiementEleves->sum('montant_reduit');
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <h3>
                        <u>Montant total réduit:</u> {{ number_format($total_remise,0,'',' ').' GNF' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
