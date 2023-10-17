@extends($chemin_theme_actif,['title' => 'Gestion-Arrierer'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion Des Arriérés De Tous Les Elèves</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion Des Arriérés De Tous Les Elèves</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Gestion Des Arriérés De Tous Les Elèves</header>
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
                            &nbsp;&nbsp;&nbsp;
                            <button class="btn deepPink-bgcolor  btn-outline" data-toggle="modal" data-target="#emargement">Paiement Des Arriérés Par Classe
                                <i class="fa fa-plus"></i>
                            </button>
                            <!-- debut modal -->
                                <div class="modal fade" data-backdrop="static" id="emargement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div  class="modal-header btn btn-danger text-center text-white">
                                                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Paiement Des Arriérés Par Classe</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="white-text">&times;</span>
                                                </button>
                                            </div>
                                            <!-- start modal body -->
                                                <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Selectionner une classe</label>
                                                            <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id">
                                                             <option value=""></option>
                                                            @foreach ($all_niveaux as $key => $niveau)
                                                                <option value="{{ route('arrierer.show',$niveau) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- <button type="submit">valider</button> --}}
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button class="btn btn-primary" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                        </div>
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
                                <th> Matricule </th>
                                <th> Elève </th>
                                <th> Classe</th>
                                <th> Montant Arriéré </th>
                                <th> Montant Payer </th>
                                <th> Reste</th>
                                <th style="width: 20%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $montant_total = 0;
                                $montant_payer = 0;
                                $reste = 0;
                            @endphp
                            @foreach ($all_inscriptions as $inscription)
                                <tr class="odd gradeX">
                                    <td class="left">{{ $inscription->eleve->matricule }}</td>
                                    <td>{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }}</td>
                                    <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>
                                    <td>{{ number_format($inscription->eleve->arrieres->sum('montant_arrierer'),0,',',' ').' GNF' }} </td>
                                    <td>
                                        {{ number_format($inscription->eleve->arrieres->sum('montant_rembourser'),0,',',' ').' GNF' }}
                                    </td>
                                    <td>
                                        {{ number_format($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser'),0,',',' ').' GNF' }}
                                    </td>
                                    <td>
                                        @if($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser') >  0)
                                            <a class="btn btn-danger btn-block" href="#aboutModal" data-toggle="modal" data-target="#versement{{ $inscription->eleve->id }}">
                                                <i class="fa fa-money"></i> Effectuer Un Paiement
                                            </a>
                                            <a class="btn btn-primary btn-block" href="#aboutModal" data-toggle="modal" data-target="#edit_versement{{ $inscription->eleve->id }}">
                                                <i class="fa fa-edit"></i> Modifier
                                            </a>
                                        @elseif($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser') <= 0)
                                            <a class="btn btn-primary btn-block" href="#aboutModal" data-toggle="modal" data-target="#edit_versement{{ $inscription->eleve->id }}">
                                                <i class="fa fa-edit"></i> Modifier
                                            </a>
                                        @else

                                        @endif
                                        <div class="container">
                                            <!-- Modal -->
                                            <div class="modal fade" id="versement{{ $inscription->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                            <h4 class="modal-title text-center" id="myModalLabel">Paiement Des Arriérés D'un Elève</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="center">
                                                                <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                <h4 class="media-heading">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }} <br>
                                                                    Matricule: {{ $inscription->eleve->matricule }} <br>
                                                                    Montant Arriéré: {{ number_format($inscription->eleve->arrieres->sum('montant_arrierer'),0,',',' ')." GNF" }} <br>
                                                                    Montant Payer: {{ number_format($inscription->eleve->arrieres->sum('montant_rembourser'),0,',',' ')." GNF" }}<br>
                                                                    Reste: {{ number_format($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser'),0,',',' ')." GNF" }}
                                                                </h4>
                                                            </div>
                                                            <form action="{{ route('arrierer.store') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="eleve_id" value="{{ $inscription->eleve_id }}">
                                                                <div class="form-group">
                                                                <label for="montant">Montant Payer *</label>
                                                                <input type="number"
                                                                    class="form-control" name="montant" id="montant" value="{{ old('montant') }}" max="{{ $inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser') }}" aria-describedby="helpId" placeholder="" required>
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
                                            <div class="modal fade" id="edit_versement{{ $inscription->eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                            <h4 class="modal-title text-center" id="myModalLabel">Modification Des Arriérés D'un Elève</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="center">
                                                                <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                <h4 class="media-heading">{{ $inscription->eleve->nom.' '.$inscription->eleve->prenom }} <br>
                                                                    Matricule: {{ $inscription->eleve->matricule }} <br>
                                                                    Montant Arriéré: {{ number_format($inscription->eleve->arrieres->sum('montant_arrierer'),0,',',' ')." GNF" }} <br>
                                                                    Montant Payer: {{ number_format($inscription->eleve->arrieres->sum('montant_rembourser'),0,',',' ')." GNF" }}<br>
                                                                    Reste: {{ number_format($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser'),0,',',' ')." GNF" }}
                                                                </h4>
                                                            </div>
                                                            <form action="{{ route('arrierer.update',$inscription->eleve->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                                {{ method_field('PUT') }}
                                                                <div class="form-group">
                                                                    <label for="montant_arrierer">Montant Arriéré *</label>
                                                                    <input type="number"
                                                                        class="form-control" name="montant_arrierer" id="montant_arrierer" value="{{ $inscription->eleve->arrieres->sum('montant_arrierer') }}"  aria-describedby="helpId" placeholder="" required>
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="montant_rembourser">Montant Rembourser *</label>
                                                                <input type="number"
                                                                    class="form-control" name="montant_rembourser" id="montant_rembourser" value="{{ $inscription->eleve->arrieres->sum('montant_rembourser') }}" max="{{ $inscription->eleve->arrieres->sum('montant_arrierer') }}" aria-describedby="helpId" placeholder="" required>
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
                                    $montant_total = $montant_total + $inscription->eleve->arrieres->sum('montant_arrierer');
                                    $montant_payer = $montant_payer + $inscription->eleve->arrieres->sum('montant_rembourser');
                                    $reste = $reste + ($inscription->eleve->arrieres->sum('montant_arrierer') - $inscription->eleve->arrieres->sum('montant_rembourser'));
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <h3>
                        <u>Montant Total:</u> {{ number_format($montant_total,0,',',' ').' GNF' }} <br>
                        <u>Montant Payer:</u> {{ number_format($montant_payer,0,',',' '). ' GNF' }} <br>
                        <u>Reste:</u> {{ number_format($reste,0,',',' ').' GNF' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
