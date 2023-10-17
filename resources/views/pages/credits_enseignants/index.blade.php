{{-- on herite du chemin du chemin_du theme --}}
@extends($chemin_theme_actif,['title' => 'Credit-Enseignant'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Gestion Des Crédits Des Enseignants</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Crédit</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Gestion Des Crédits Des Enseignants</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Gestion Des Crédits Des Enseignants
                        Pour Le Mois
                        @if ($num_mois == 1)
                            {{ "De Janvier" }}
                        @elseif($num_mois == 2)
                            {{ "De Février" }}
                        @elseif($num_mois == 3)
                            {{ "De Mars" }}
                        @elseif($num_mois == 4)
                            {{ "D'Avril" }}
                        @elseif($num_mois == 5)
                            {{ "De Mai" }}
                        @elseif($num_mois == 6)
                            {{ "De Juin"}}
                        @elseif($num_mois == 7)
                            {{ "De Juillet" }}
                        @elseif($num_mois == 8)
                            {{ "D' Août" }}
                        @elseif($num_mois == 9)
                            {{ "De Septembre" }}
                        @elseif($num_mois == 10)
                            {{ "D' Octobre" }}
                        @elseif($num_mois == 11)
                            {{ "De Novembre" }}
                        @else
                            {{ "De Décembre" }}
                        @endif
                    </header>
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
                                    <i class="fa fa-reply"></i>Retour
                                </a>
                            </div>
                            &nbsp;
                            <button class="btn btn-primary" data-toggle="modal" data-target="#afficher_par_mois">Choisir un autre mois
                                <i class="fa fa-plus"></i>
                            </button>
                            <div class="modal fade" data-backdrop="static" id="afficher_par_mois" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div  class="modal-header btn btn-danger text-center text-white">
                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Afficher les crédits par mois</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                            </button>
                                        </div>
                                        <!-- start modal body -->
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Selectionnez le mois</label>
                                                        <select onchange="window.location.href = this.value" class="form-control" name="num_mois" id="num_mois">
                                                        <option value="">Choisir ...</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',1) }}">Janvier</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',2) }}">Fevrier</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',3) }}">Mars</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',4) }}">Avril</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',5) }}">Mai</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',6) }}">Juin</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',7) }}">Juillet</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',8) }}">Août</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',9) }}">Septembre</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',10) }}">Octobre</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',11) }}">Novembre</option>
                                                        <option value="{{ route('credit_enseignant_par_mois',12) }}">Décembre</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <!-- end modal body -->
                                    </div>
                                </div>
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
                                    <th> Enseignant </th>
                                    <th> Bon </th>
                                    <th> Prêt</th>
                                    <th> Rembourser</th>
                                    <th> Reste</th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_enseignant as $enseignant)
                                    <tr class="odd gradeX">
                                        <td class="patient-img">
                                            <img src="/images/photos/enseignants/{{ $enseignant->avatar }}"
                                                alt="">
                                        </td>
                                        <td>{{ $enseignant->nom.' '.$enseignant->prenom }}</td>
                                        <td>{{ number_format($enseignant->creditEnseignants->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit'),0,',',' ').' GNF' }}</td>
                                        <td>
                                            {{ number_format($enseignant->creditEnseignants->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois'),0,'.',' ').' GNF' }}
                                        </td>
                                        <td>{{ number_format($enseignant->creditEnseignants->where('mois_remboursement',$num_mois)->sum('somme_rembourser'),0,',',' ').' GNF' }}</td>
                                        <td>{{ number_format(
                                                ($enseignant->creditEnseignants->where('mois_remboursement',$num_mois)->where('type_de_credit','Bon')->sum('somme_credit') + $enseignant->creditEnseignants->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois'))
                                                - ($enseignant->creditEnseignants->where('mois_remboursement',$num_mois)->sum('somme_rembourser')),0,',',' '
                                            ).' GNF'}}</td>
                                        <td>
                                            <a class="btn btn-danger" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $enseignant->id }}">
                                                <i class="fa fa-money"></i> Effectuer Un Crédit
                                            </a>
                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#rembourser{{ $enseignant->id }}">
                                                <i class="fa fa-money"></i> Rembourser Un Crédit
                                            </a>
                                            <a class="btn btn-primary" href="{{ route('Credit.show',$enseignant->id) }}"><i class="fa fa-recycle"></i> Historique</a>
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal{{ $enseignant->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title text-center" id="myModalLabel">Gestion Des Crédits Des Enseignants</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    {{-- <img src="/images/photos/enseignants/{{ $enseignant->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a> --}}
                                                                    <h4 class="media-heading">{{ $enseignant->nom.' '.$enseignant->prenom }}
                                                                        <br>
                                                                        Contact: {{ $enseignant->telephone }}
                                                                    </h4>
                                                                </div>
                                                                    <form action="{{ route('Credit.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="user_id" value="{{ $enseignant->id }}">
                                                                        <div class="form-group">
                                                                            <label for="montant">Montant Crédit *</label>
                                                                            <input type="number"
                                                                            class="form-control" name="montant_credit" id="montant_credit"  aria-describedby="helpId" placeholder="Entrez le montant crédit" required min="0" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="motif">Motif *</label>
                                                                            <input type="text"
                                                                                class="form-control" name="motif" id="motif"  aria-describedby="helpId" placeholder="Entrez le motif du crédit" required  />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="type_de_credit">Type de crédit</label>
                                                                            <select class="form-control" name="type_de_credit" id="type_de_credit" required>
                                                                            <option value="">Selectionnez le type de crédit</option>
                                                                            <option value="Bon">Bon</option>
                                                                            <option value="Prêt">Prêt</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="pour_le_bon" class="form-group">
                                                                            <label for="mois_remboursement">Selectionner le mois</label>
                                                                            <select  class="form-control" name="mois_remboursement" id="mois_remboursement">
                                                                            <option value="">Selectionnez le mois</option>
                                                                                <option value="1">Janvier</option>
                                                                                <option value="2">Fevrier</option>
                                                                                <option value="3">Mars</option>
                                                                                <option value="4">Avril</option>
                                                                                <option value="5">Mai</option>
                                                                                <option value="6">Juin</option>
                                                                                <option value="7">Juillet</option>
                                                                                <option value="8">Août</option>
                                                                                <option value="9">Septembre</option>
                                                                                <option value="10">Octobre</option>
                                                                                <option value="11">Novembre</option>
                                                                                <option value="12">Décembre</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="pour_le_pret1" class="form-group">
                                                                            <label for="debut_remboursement">Début Remboursement</label>
                                                                            <select  class="form-control" name="debut_remboursement" id="debut_remboursement">
                                                                            <option value="">Selectionnez le mois</option>
                                                                                <option value="1">Janvier</option>
                                                                                <option value="2">Fevrier</option>
                                                                                <option value="3">Mars</option>
                                                                                <option value="4">Avril</option>
                                                                                <option value="5">Mai</option>
                                                                                <option value="6">Juin</option>
                                                                                <option value="7">Juillet</option>
                                                                                <option value="8">Août</option>
                                                                                <option value="9">Septembre</option>
                                                                                <option value="10">Octobre</option>
                                                                                <option value="11">Novembre</option>
                                                                                <option value="12">Décembre</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="pour_le_pret2" class="form-group">
                                                                            <label for="fin_remboursement">Fin Remboursement</label>
                                                                            <select  class="form-control" name="fin_remboursement" id="fin_remboursement">
                                                                            <option value="">Selectionnez le mois</option>
                                                                                <option value="1">Janvier</option>
                                                                                <option value="2">Fevrier</option>
                                                                                <option value="3">Mars</option>
                                                                                <option value="4">Avril</option>
                                                                                <option value="5">Mai</option>
                                                                                <option value="6">Juin</option>
                                                                                <option value="7">Juillet</option>
                                                                                <option value="8">Août</option>
                                                                                <option value="9">Septembre</option>
                                                                                <option value="10">Octobre</option>
                                                                                <option value="11">Novembre</option>
                                                                                <option value="12">Décembre</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="pour_le_pret3" class="form-group">
                                                                            <label for="montant_par_mois">Montant Par Mois</label>
                                                                            <input type="number" name="montant_par_mois" id="montant_par_mois" class="form-control" placeholder="Entrez le montant par mois">
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
                                                <div class="modal fade" id="rembourser{{ $enseignant->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-primary col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title text-center" id="myModalLabel">Rembourser Un Crédit</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($enseignant->creditEnseignants->sum('somme_credit') - $enseignant->creditEnseignants->sum('somme_rembourser') <= 0)
                                                                    <h3 class="text-center">Vous ne pouvez pas effectuez de <br>remboursement car cet enseignant n'a aucun crédit.</h3>
                                                                    <div class="center">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                                                                    </div>
                                                                @else
                                                                    <form action="{{ route('Credit.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="user_id" value="{{ $enseignant->id }}">
                                                                        <div class="form-group">
                                                                        <label for="montant_rembourser">Montant Rembourser *</label>
                                                                        <input type="number"
                                                                            class="form-control" name="montant_rembourser" id="montant_rembourser" max="{{ $enseignant->creditEnseignants->sum('somme_credit') - $enseignant->creditEnseignants->sum('somme_rembourser') }}"  aria-describedby="helpId" placeholder="" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="type_de_credit">Type de crédit</label>
                                                                            <select class="form-control" name="type_de_credit" id="type_de_credit" required>
                                                                                <option value="">Selectionnez le type de crédit</option>
                                                                                <option value="Bon">Bon</option>
                                                                                <option value="Prêt">Prêt</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="mois_remboursement">Selectionner le mois</label>
                                                                            <select  class="form-control" name="mois_remboursement" id="mois_remboursement">
                                                                            <option value="">Selectionnez le mois</option>
                                                                                <option value="1">Janvier</option>
                                                                                <option value="2">Fevrier</option>
                                                                                <option value="3">Mars</option>
                                                                                <option value="4">Avril</option>
                                                                                <option value="5">Mai</option>
                                                                                <option value="6">Juin</option>
                                                                                <option value="7">Juillet</option>
                                                                                <option value="8">Août</option>
                                                                                <option value="9">Septembre</option>
                                                                                <option value="10">Octobre</option>
                                                                                <option value="11">Novembre</option>
                                                                                <option value="12">Décembre</option>
                                                                            </select>
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
    <script>
        $(function() {
            $('#pour_le_bon').hide();
            $('#pour_le_pret1').hide();
            $('#pour_le_pret2').hide();
            $('#pour_le_pret3').hide();
            $('#type_de_credit').change(function(){
                if($('#type_de_credit').val() == 'Bon') {
                    $('#pour_le_bon').show();
                    $('#pour_le_pret1').hide();
                    $('#pour_le_pret2').hide();
                    $('#pour_le_pret3').hide();
                } else {
                    $('#pour_le_pret1').show();
                    $('#pour_le_pret2').show();
                    $('#pour_le_pret3').show();
                    $('#pour_le_bon').hide();
                }
            });
        });
    </script>
@endsection
