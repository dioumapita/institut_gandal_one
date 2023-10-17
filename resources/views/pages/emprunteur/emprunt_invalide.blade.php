@extends($chemin_theme_actif,['title' => 'Emprunt-Invalide'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Liste Des Emprunts Invalide</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Emprunt</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Liste Des Emprunts Invalide</li>
        </ol>
    </div>
</div>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <div class="tabbable-line">
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-red">
                                <div class="card-head">
                                    <header>Liste Des Emprunts Invalide</header>
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
                                                <a href="{{ route('emprunteur.index') }}" id="addRow"
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
                                                    <th class="text-center"> N° </th>
                                                    <th class="text-center"> Isbn </th>
                                                    <th class="text-center"> Livre </th>
                                                    <th class="text-center"> Auteur </th>
                                                    <th class="text-center"> Categorie </th>
                                                    <th class="text-center"> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $to_day = Carbon\Carbon::now();
                                                @endphp
                                                @foreach ($all_emprunts as $emprunt)
                                                    @if($to_day->gt($emprunt->date_fin))
                                                        <tr class="odd gradeX">
                                                            <td class="text-center">{{ $i++ }}</td>
                                                            <td class="text-center">{{ $emprunt->livre->isbn }}</td>
                                                            <td class="text-center">{{ $emprunt->livre->titre }}</td>
                                                            <td class="text-center">{{ $emprunt->livre->auteur->nom.' '.$emprunt->livre->auteur->prenom }}</td>
                                                            <td class="text-center">{{ $emprunt->livre->category->libelle }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-list"></i> Détail</a>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
