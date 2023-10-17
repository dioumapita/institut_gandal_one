@extends($chemin_theme_actif,['title' => 'All-Emprunteurs'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion Des Emprunts</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Emprunt</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion Des Emprunts</li>
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
                                    <header>Gestion Des Emprunts</header>
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
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#nouveau">Nouveau
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <!-- debut modal -->
                                                <div class="modal fade" data-backdrop="static" id="nouveau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Ajouter Un Adhérent</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- start modal body -->
                                                                <div class="modal-body">
                                                                    <form action="{{ route('emprunteur.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label for="nom">Nom</label>
                                                                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="prenom">Prénom </label>
                                                                            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrez le prenom" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="quartier">Quartier</label>
                                                                            <input type="text" name="quartier" id="quartier" class="form-control"  placeholder="Entrez le quartier">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="contact">Contact</label>
                                                                            <input type="tel" name="contact" id="contact" class="form-control"  placeholder="Entrez le contact">
                                                                        </div>
                                                                        <div class="modal-footer d-flex justify-content-center">
                                                                            <button type="submit" class="btn btn-primary" >Valider <i class="fa fa-check"></i></button>
                                                                            &nbsp;&nbsp;
                                                                            <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            <!-- end modal body -->
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- fin modal -->
                                            &nbsp;&nbsp;
                                            <a href="{{ route('emprunt_invalide') }}" class="btn btn-primary"><i class="fa fa-list"></i> Liste Des Emprunts Invalides</a>
                                        </div>
                                    </div>

                                    <div class="table-scrollable">
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="eleves">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> N° </th>
                                                    <th class="text-center"> Emprunteur </th>
                                                    <th class="text-center"> Contact </th>
                                                    <th class="text-center">Nbre Livre Emprunter </th>
                                                    <th class="text-center">Nbre Livre Rendu </th>
                                                    <th class="text-center"> Reste </th>
                                                    <th class="text-center"> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $nbre_livre_emprunter = 0;
                                                    $nbre_livre_rendu = 0;
                                                    $reste = 0;
                                                @endphp
                                                @foreach ($all_emprunteurs as $emprunteur)
                                                    <tr class="odd gradeX">
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td class="text-center">{{ $emprunteur->nom.' '.$emprunteur->prenom }}</td>
                                                        <td class="text-center">{{ $emprunteur->contact }}</td>
                                                        <td class="text-center">{{ $emprunteur->emprunts->count() }}</td>
                                                        <td class="text-center">{{ $emprunteur->emprunts->where('status',1)->count() }}</td>
                                                        <td class="text-center">{{ $emprunteur->emprunts->count() - $emprunteur->emprunts->where('status',1)->count()}}</td>
                                                        <td>
                                                            <a href="{{ route('emprunteur.show',$emprunteur->id) }}" class="btn btn-primary btn-block"><i class="fa fa-list"></i> Détail</a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $nbre_livre_emprunter =  $nbre_livre_emprunter + $emprunteur->emprunts->count();
                                                        $nbre_livre_rendu = $nbre_livre_rendu + $emprunteur->emprunts->where('status',1)->count();
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h3>
                                            <u>Nbre De Livre Emprunter:</u> {{ $nbre_livre_emprunter }}<br>
                                            <u>Nbre De Livre Rendu:</u> {{ $nbre_livre_rendu }}<br>
                                            <u>Reste à Rendre:</u>{{ $nbre_livre_emprunter - $nbre_livre_rendu }}
                                        </h3>
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
