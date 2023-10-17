@extends($chemin_theme_actif,['title' => 'Historique-Credit-Personnel'])
@section('content')
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Historique Des Crédits D'un Personnel</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Crédit</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Historique Des Crédits D'un Personnel</li>
        </ol>
    </div>
</div>
<a href="{{ route('creditpersonnel.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
   <br><br>
   <div id="media_screen" class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
    <div class="profile-sidebar">
        <div class="card">
            <div class="card-head card-topline-aqua">
                <header>Informations Du Personnel</header>
            </div>
            <div class="card-body no-padding height-9">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Nom: {{ $personnel->nom}}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Prénom: {{ $personnel->prenom }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Poste: {{ $personnel->poste }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>Téléphone: {{ $personnel->telephone}}</b>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- END BEGIN PROFILE SIDEBAR -->

        <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>Historique Des Crédits Et Remboursements</header>
                        </div>
                        <div class="white-box">
                                <div class="table-scrollable mt-5">
                                    <h3 class="text-center"><u>Historique Des Crédits</u></h3>
                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                            >
                                        <thead>
                                            <tr>
                                                <th class="text-center"> Montant Crédit </th>
                                                <th class="text-center"> Motif</th>
                                                <th class="text-center"> Date </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($personnel->creditPersonnels as $credit)
                                                @if($credit->montant_credit != null)
                                                    <tr class="odd gradeX">
                                                        <td class="text-center" style="width: 20%">
                                                            {{ number_format($credit->montant_credit,0,',',' ').' GNF' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $credit->motif }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $credit->date_credit->format('d/m/Y') }}
                                                        </td>
                                                        <td>

                                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $credit->id }}">
                                                                <i class="fa fa-pencil"></i> Modifier
                                                            </a>
                                                            <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $credit->id }})"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </a>
                                                            <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                <div class="mt-5 modal-dialog modal-confirm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header flex-column">
                                                                            <div class="icon-box">
                                                                                <i class="material-icons">&#xE5CD;</i>
                                                                            </div>
                                                                            <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>
                                                                                Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-center">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                            <form action="{{ route('creditpersonnel.destroy',$credit->id) }}" method="post" id="deleteform">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}
                                                                                <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                    Oui Supprimer
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="myModal{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                <h4 class="modal-title text-center" id="myModalLabel">Modification Du Crédit D'un Enseignant</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                    <form action="{{ route('creditpersonnel.update',$credit->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                            <label for="montant">Montant Credit *</label>
                                                                                            <input type="number"
                                                                                            class="form-control" name="montant_credit" id="montant_credit" value="{{ $credit->montant_credit }}" aria-describedby="helpId" placeholder="Entrez le montant crédit" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="motif">Motif *</label>
                                                                                            <input type="text"
                                                                                            class="form-control" name="motif" id="motif" value="{{ $credit->motif }}"  aria-describedby="helpId" placeholder="Entrez le motif du crédit" required  />
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="montant">Date *</label>
                                                                                            <input type="date"
                                                                                            class="form-control" name="date_credit" id="date_credit" value="{{ $credit->date_credit->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
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
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h3><u>Total:</u> {{ number_format($personnel->creditPersonnels->sum('montant_credit'),0,',',' ').' GNF' }}</h3>
                                </div>

                                <div class="table-scrollable mt-5">
                                    <h3 class="text-center"><u>Historique Des Remboursements</u></h3>
                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                            >
                                        <thead>
                                            <tr>
                                                <th class="text-center"> Montant Rembourser </th>
                                                <th class="text-center"> Date </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($personnel->creditPersonnels as $credit)
                                                @if($credit->montant_rembourser != null)
                                                    <tr class="odd gradeX">
                                                        <td class="text-center" style="width: 20%">
                                                            {{ number_format($credit->montant_rembourser,0,',',' ').' GNF' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $credit->date_credit->format('d/m/Y') }}
                                                        </td>
                                                        <td>

                                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $credit->id }}">
                                                                <i class="fa fa-pencil"></i> Modifier
                                                            </a>
                                                            <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $credit->id }})"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </a>
                                                            <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                <div class="mt-5 modal-dialog modal-confirm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header flex-column">
                                                                            <div class="icon-box">
                                                                                <i class="material-icons">&#xE5CD;</i>
                                                                            </div>
                                                                            <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>
                                                                                Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-center">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                            <form action="{{ route('creditpersonnel.destroy',$credit->id) }}" method="post" id="deleteform">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}
                                                                                <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                    Oui Supprimer
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="myModal{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                <h4 class="modal-title text-center" id="myModalLabel">Modification Du Crédit D'un Enseignant</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                    <form action="{{ route('creditpersonnel.update',$credit->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                            <label for="montant_rembourser">Montant Rembourser *</label>
                                                                                            <input type="number"
                                                                                            class="form-control" name="montant_rembourser" id="montant_rembourser" max="{{ $credit->sum('montant_credit') - $credit->sum('montant_rembourser') }}" value="{{ $credit->montant_rembourser }}" aria-describedby="helpId" placeholder="Entrez le montant crédit" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="date_credit">Date *</label>
                                                                                            <input type="date"
                                                                                            class="form-control" name="date_credit" id="date_credit" value="{{ $credit->date_credit->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
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
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h3><u>Total:</u> {{ number_format($personnel->creditPersonnels->sum('montant_rembourser'),0,',',' ').' GNF' }}</h3>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
@endsection
{{-- script utiliser pour la suppression d'un credit ou remboursement --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("creditpersonnel.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
