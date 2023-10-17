{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Enseignants-listes'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Liste Des Enseignants</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Enseignants</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Liste Des Enseignants</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Liste Des Enseignants</header>
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
                                <a href="{{ route('home') }}" id="addRow"
                                    class="btn btn-info">
                                    <i class="fa fa-reply"></i> Retour
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('enseignant.create') }}" id="addRow"
                                    class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                   Inscrire un enseignant
                                </a>
                            </div>
                            {{-- <a id="imprimer" href="#" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer la liste des enseignants</a> --}}
                            <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="Imprimer La Liste Des Enseignants" />
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th> Nom </th>
                                    <th> Prénom </th>
                                    <th> Téléphone </th>
                                    <th> Quartier</th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_enseignants as $enseignant)
                                    <tr class="odd gradeX">
                                        <td class="patient-img">
                                            <img src="/images/photos/enseignants/{{ $enseignant->avatar }}"
                                                alt="profil_enseignant">
                                        </td>
                                        <td>{{ $enseignant->nom }}</td>
                                        <td class="left">{{ $enseignant->prenom }}</td>
                                        <td>
                                           {{ $enseignant->telephone }}
                                        </td>
                                        <td>
                                            {{ $enseignant->adresse }}
                                        </td>
                                        <td>
                                            <a href="{{ route('enseignant.show',$enseignant->id) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-eye "></i> Afficher
                                            </a>
                                            <a href="{{ route('enseignant.edit',$enseignant->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i> Modifier
                                            </a>
                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $enseignant->id }})"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Supprimer
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
                                                                Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <form action="{{ route('enseignant.destroy',$enseignant->id) }}" method="post" id="deleteform">
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
    <br><br>
    <div id="imprime" class="row">
        <style>
            @media print{
                .font-bold {
                    font-weight: bold;
                }

                .rouge{
                    color: rgb(255, 0, 0) !important;
                    font-style: italic !important;
                }
                .jaune{
                    color: yellow !important;
                    font-style: italic !important;
                }
                .vert{
                    color: rgb(6, 168, 6) !important;
                    font-style: italic !important;
                }
                #bordure_table{
                    border: 2px solid black !important;
                    font-size: 20px;
                }
                #bordure_tables{
                    width: 50px;
                    border: 2px solid black !important;
                    font-size: medium;
                    word-break: normal;
                }
                .cercle{
                            border: 5px solid;
                            border-radius: 20px;
                            padding: 0px;
                            margin-right: -33px;
	                    }
                .align-top{
                            text-align: center;
                            margin-top: -68px;
                         }
            }
        </style>
        <div id="invisible-screens" class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <address>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">MEPU-A</u>
                                        <br>

                                        <u class="souligner">I.R.E: Conakry</u>
                                        <br>

                                        <u class="souligner">D.C.E: Ratoma</u>

                                        <br>

                                        <u class="souligner">D.S.E.E: DAR-ES-SALAM</u>
                                    </h4>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">Complexe Scolaire GANDAL</u>
                                    </h4>
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">REPUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                     <br>
                                       <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                    </h4>
                                </address>
                            </div>
                            <div class="center">
                                 <img src="/images/photos/logos/logo_gandal.jpg" width="250px" heigth="200px" alt="logo_ecole" srcset="">
                            </div>
                        </div>
                        <br>
                        <div class="row col-md-12 col-sm-12 col-lg-12">
                            <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                <div class="cercle">
                                    <div class="text-center">
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">Liste Des Enseignants</u><br>
                                            <u class="souligner">
                                               De L'anneé Scolaire {{ $annee_courante->annee_scolaire }}
                                             <br>
                                            </u>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <p class="text-center font-bold addr-font-h4"><u>TABLEAU STATISTIQUES</u></p>
                            <div>
                                <table class="table table-bordered">
                                    <thead id="bordure_table">
                                        <tr id="bordure_table">
                                            <th colspan="4" class="text-center" id="bordure_table"> INSCRIT </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center" id="bordure_table">
                                            <td class="text-center" id="bordure_table">TOTAL</td>
                                            <td class="text-center" id="bordure_table"> Monsieur </td>
                                            <td class="text-center" id="bordure_table"> Madame </td>
                                            <td class="text-center" id="bordure_table"> Mademoiselle </td>
                                        </tr>
                                        <tr class="text-center" id="bordure_table">
                                            <td class="text-center" id="bordure_table">{{ $all_enseignants->count() }}</td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_monsieur = 0;
                                                @endphp
                                                @foreach ($all_enseignants as $enseignant)
                                                    @if ($enseignant->civilite == 'Monsieur')
                                                        @php
                                                            $nbre_monsieur++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_monsieur }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_de_dame = 0;
                                                @endphp
                                                @foreach ($all_enseignants as $enseignant)
                                                    @if ($enseignant->civilite == 'Madame')
                                                        @php
                                                            $nbre_de_dame++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_de_dame }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                @php
                                                    $nbre_de_demoiselle = 0;
                                                @endphp
                                                @foreach ($all_enseignants as $enseignant)
                                                    @if ($enseignant->civilite == 'Mademoiselle')
                                                        @php
                                                            $nbre_de_demoiselle++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_de_demoiselle }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div>
                            <table id="bordure_table" class="table table-bordered">
                                <th class="text-center" id="bordure_table">Nom </th>
                                <th class="text-center" id="bordure_table">Prénom</th>
                                <th class="text-center" id="bordure_table">Téléphone</th>
                                <th class="text-center" id="bordure_table">Quartier</th>
                                <tbody id="bordure_table">
                                    @foreach ($all_enseignants as $enseignant)
                                        <tr id="bordure_table">
                                            <td class="text-center" id="bordure_table">{{ $enseignant->nom }}</td>
                                            <td class="text-center" id="bordure_table">{{ $enseignant->prenom }}</td>
                                            <td class="text-center" id="bordure_table">{{ $enseignant->telephone }}</td>
                                            <td class="text-center" id="bordure_table">{{ $enseignant->adresse }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="">
                            <h4 class=" pull-right font-bold addr-font-h4">
                              Conakry, le {{ date('d/m/Y') }}<br><br>La Direction
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- script utiliser pour la suppression d'un enseignant --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("enseignant.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
