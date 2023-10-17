@extends($chemin_theme_actif,['title' => 'compta-general'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Comptabilité Générale</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Comptabilité</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Comptabilité Générale</li>
        </ol>
    </div>
</div>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Comptabilité Générale</header>
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
                    <div class="col-md-12 col-sm-12 col-12">
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
                        >
                        <thead>
                             <th class="text-center">Indice</th>
                             <th class="text-center">Montant</th>
                        </thead>
                        <tbody>
                            @php
                                $frais_inscription = 0;
                                $credit_inscription = 0;
                                $frais_reinscription = 0;
                                $credit_reinscription = 0;
                                $frais_scolaire = 0;
                                $credit_scolaire = 0;
                                $remise = 0;
                            @endphp
                            <tr>
                                <td class="text-center">Frais D'inscription</td>
                                <td class="text-center">
                                    @foreach ($all_inscrits->where('status',0) as $inscrit)
                                            @php
                                                $frais_inscription = $frais_inscription + $inscrit->niveau->frais_inscription;
                                                $credit_inscription = $credit_inscription + ($inscrit->niveau->frais_inscription - $inscrit->frais_inscription);
                                            @endphp
                                      @endforeach
                                      {{ number_format($frais_inscription,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Crédit Frais D'inscription</td>
                                <td class="text-center">
                                    {{ number_format($credit_inscription,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Frais Réinscription</td>
                                <td class="text-center">
                                    @foreach ($all_inscrits->where('status',1) as $inscrit)
                                            @php
                                                $frais_reinscription = $frais_reinscription + $inscrit->niveau->frais_reinscription;
                                                $credit_reinscription = $credit_reinscription + ($inscrit->niveau->frais_reinscription - $inscrit->frais_reinscription);
                                            @endphp
                                        @endforeach
                                        {{ number_format($frais_reinscription,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Crédit Frais Réinscription</td>
                                <td class="text-center">
                                    {{ number_format($credit_reinscription,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Frais Scolarite</td>
                                <td class="text-center">
                                    @foreach ($all_inscrits as $inscrit)
                                        @php
                                            $frais_scolaire = $frais_scolaire + ($inscrit->niveau->scolarite - $inscrit->eleve->remisePaiementEleves->sum('montant_reduit'));
                                            $credit_scolaire = $credit_scolaire + ($inscrit->niveau->scolarite - ($inscrit->eleve->paiementEleves->sum('somme_payer') + $inscrit->eleve->remisePaiementEleves->sum('montant_reduit')));
                                        @endphp
                                    @endforeach
                                        {{ number_format($frais_scolaire,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Crédit Frais Scolaire</td>
                                <td class="text-center">
                                    {{ number_format($credit_scolaire,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Paiement Enseignant</td>
                                <td class="text-center">
                                    {{ number_format($total_paiement_enseignant,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Crédit Enseignant</td>
                                <td class="text-center">
                                    {{ number_format($total_credit_enseignant,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Paiement Personnel</td>
                                <td class="text-center">
                                    {{ number_format($total_paiement_personnel,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Crédit Personnel</td>
                                <td class="text-center">
                                    {{ number_format($total_credit_personnel,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Arrierer</td>
                                <td class="text-center">
                                    {{ number_format($total_arrierer,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Rémise</td>
                                <td class="text-center">
                                    @foreach ($all_inscrits as $inscrits)
                                        @php
                                            $remise = ($remise + $inscrits->eleve->remisePaiementEleves->sum('montant_reduit'));
                                        @endphp
                                    @endforeach
                                    {{ number_format($remise,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Total Crédit</td>
                                <td class="text-center">
                                    {{ number_format($credit_inscription + $credit_reinscription + $credit_scolaire + $total_credit_enseignant + $total_credit_personnel + $total_arrierer,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Dépense</td>
                                <td class="text-center">
                                    {{ number_format($total_depense,0,',',' ').' GNF' }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="text-center">Solde Général</td>
                                <td class="text-center">
                                    {{ number_format(($frais_inscription + $frais_reinscription + $frais_scolaire + $total_arrierer) - ($total_paiement_enseignant + $total_paiement_personnel + $total_credit_enseignant + $total_credit_personnel + $total_depense),0,',',' ') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Solde Courant</td>
                                <td class="text-center">
                                    {{ number_format(($frais_inscription + $frais_reinscription + $frais_scolaire) - ($total_paiement_enseignant + $total_paiement_personnel + $total_credit_enseignant + $total_credit_personnel + $total_depense + $total_arrierer + $credit_inscription + $credit_reinscription + $credit_scolaire),0,',',' ') }}
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
