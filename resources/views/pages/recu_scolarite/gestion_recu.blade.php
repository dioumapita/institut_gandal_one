@extends($chemin_theme_actif,['title' => 'gestion-recu'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion des reçu de la scolarité</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Reçu</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion des reçu de la scolarité</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Gestion des reçu de la scolarité</header>
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
                            <a href="{{ route('paiement_eleve.index') }}" id="addRow"
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
                                <th class="text-center">N° Reçu</th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Tel Tuteur </th>
                                <th class="text-center"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_recus as $recu)
                                <tr>
                                    <td class="text-center">{{ $recu->num_recu }}</td>
                                    <td class="text-center">{{ $recu->date_paiement->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $recu->eleve->telephone_parent }}</td>
                                    <td><a href="{{ route('historique_recu_scolarite',$recu->num_recu) }}" class="btn btn-info btn-block">Afficher <i class="fa fa-eye"></i></a></td>
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
