@extends($chemin_theme_actif,['title' => 'Depense'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Gestion Des Dépenses</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Dépenses</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Gestion Des Dépenses</li>
        </ol>
    </div>
</div>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Liste Des Dépenses</header>
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
                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Nouvelle Dépense</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                            </button>
                                        </div>
                                        <!-- start modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('depense.store') }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="annee_id" value="{{ $annee_courante->id }}">
                                                    <div class="form-group">
                                                        <label for="depense">Dépense</label>
                                                        <input type="text" name="depense" id="depense" class="form-control" value="{{ old('depense') }}" placeholder="Entrez la dépense" maxlength="255" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="montant">Montant</label>
                                                        <input type="number" name="montant" id="montant" class="form-control" value="{{ old('montant')}}" placeholder="Entrez le montant" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date_depense">Date</label>
                                                        <input type="date" name="date_depense" id="date_depense" class="form-control" value="{{ old('date_depense')}}" placeholder="Entrez la date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="doc">Document pdf</label>
                                                        <input type="file" name="doc" id="doc" class="form-control" value="{{ old('doc')}}" placeholder="Importer le document">
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
                        {{-- <a  onclick="printDiv('liste_depense')" href="#" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer</a> --}}
                    </div>
                </div>
                <div class="table-scrollable">
                    <table
                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                            id="eleves">
                        <thead>
                            <tr>
                                <th class="text-center"> N° </th>
                                <th class="text-center"> Dépense </th>
                                <th class="text-center"> Montant </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center">Document</th>
                                <th class="text-center"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($all_depenses as $depense)
                                <tr class="odd gradeX">
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $depense->depense }}</td>
                                    <td class="text-center">{{ number_format($depense->montant,0,',',' ').' GNF' }}</td>
                                    <td class="text-center">{{ $depense->date_depense->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <a target="_blank" rel="noopener noreferrer"  href="images/photos/doc_depenses/{{ $depense->doc_depenses }}">ouvrir</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#nouveau{{$depense->id}}">Modifier
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <!-- debut modal -->
                                            <div class="modal fade" data-backdrop="static" id="nouveau{{$depense->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div  class="modal-header btn btn-danger text-center text-white">
                                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Modification D'une Dépense</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" class="white-text">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- start modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{ route('depense.update',$depense->id) }}" method="post" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}
                                                                    <div class="form-group">
                                                                        <label for="depense">Dépense</label>
                                                                        <input type="text" name="depense" id="depense" class="form-control" value="{{ $depense->depense }}" placeholder="Entrez la depense" maxlength="255" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="montant">Montant</label>
                                                                        <input type="number" name="montant" id="montant" class="form-control" value="{{ $depense->montant}}" placeholder="Entrez le montant" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="date_depense">Date</label>
                                                                        <input type="date" name="date_depense" id="date_depense" class="form-control" value="{{ $depense->date_depense->format('Y-m-d') }}" placeholder="Entrez la date" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="doc">Document pdf</label>
                                                                        <input type="file" name="doc" id="doc" class="form-control" value="{{ old('doc')}}" placeholder="Importer le document">
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
                                        <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $depense->id }})"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Annuler
                                        </a>
                                        <div id="myModal" class="mt-5 modal fade" data-backdrop="static">
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
                                                            De vouloir annuler la dépense ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('depense.destroy',$depense->id) }}" method="post" id="deleteform">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                Oui Annuler
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $total = $total + $depense->montant;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <h3><u>Total:</u> {{ $convertisseur->format($total) }} ({{ number_format($total,0,',',' ').' GNF' }})</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function deleteData(id)
      {
          var id = id;
          var url = '{{ route("depense.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteform").attr('action', url);
      }
      function formSubmit()
      {
          // alert("bonjour");
          $("#deleteform").submit();
      }
</script>
