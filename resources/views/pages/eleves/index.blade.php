{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'eleves-listes'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('liste_eleve.ListeDesEleves')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">@lang('liste_eleve.Elèves')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">@lang('liste_eleve.ListeDesEleves')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>@lang('liste_eleve.ListeEleveEtablissement')</header>
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
                            <a href="{{ route('home') }}" class="btn btn-info"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour') </a>
                            <div class="btn-group">
                                <a href="{{ route('eleve.create') }}" id="addRow"
                                    class="btn btn-primary">
                                    @lang('liste_eleve.Inscrire_eleve') <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            {{-- <a id="imprimer" href="#" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer </a> --}}
                          <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="@lang('liste_eleve.Imprimer')" />
                          &nbsp;
                          <a href="{{ route('listes_eleves_reinscrits') }}" class="btn btn-primary">Liste des Réinscrits</a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group pull-right">
                                <div class="form-group">
                                    <select onchange="window.location.href = this.value" class="form-control" name="classe" id="classe">
                                        <option value="{{ route('eleve.index') }}">@lang('liste_eleve.Affiche_par_classe')</option>
                                        @foreach ($all_classes as $classe)
                                            <option value="{{ route('eleve_par_niveau',$classe->id) }}" @if($classe->id == $id_niveau) selected @endif>{{ $classe->nom_niveau.' '.$classe->options }}</option>
                                        @endforeach
                                    </select>
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
                                    {{-- <th>@lang('liste_eleve.Image')</th> --}}
                                    <th> @lang('liste_eleve.Matricule') </th>
                                    <th> @lang('liste_eleve.Nom') </th>
                                    <th> @lang('liste_eleve.Prenom') </th>
                                    <th> Classe</th>
                                    <th> @lang('liste_eleve.Date_inscription') </th>
                                    <th> @lang('liste_eleve.Actions') </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_inscriptions as $inscription)
                                    <tr class="odd gradeX">
                                        {{-- <td class="patient-img">
                                            <img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}"
                                                alt="photo_eleve">
                                        </td> --}}
                                        <td class="left">{{ $inscription->eleve->matricule }}</td>
                                        <td>{{ $inscription->eleve->nom }}</td>
                                        <td class="left">{{ $inscription->eleve->prenom }}</td>
                                        <td>{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>
                                        <td>{{ $inscription->date_inscription->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('eleve.show',$inscription->eleve->id) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-eye "></i> @lang('liste_eleve.Afficher')
                                            </a>
                                            <a href="{{ route('eleve.edit',$inscription->eleve->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa fa-pencil"></i> @lang('liste_eleve.Modifier')
                                            </a>

                                            <a href="#myModal" data-toggle="modal" onclick="deleteData({{ $inscription->eleve->id }})"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i> @lang('liste_eleve.Supprimer')
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
                                                            <form action="{{ route('eleve.destroy',$inscription->eleve->id) }}" method="post" id="deleteform">
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
        {{-- utiliser pour l'impression (rendu css) --}}
        <style>
            @media print{
                /* @page {size: landscape} */
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
                #harounaya{
                    font-weight: bolder;
                }
                #paragraphe
                {
                    font-size: medium;
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
                                        <u class="souligner">METFP</u>
                                        <br>
                                        <u class="souligner">I.R.E: Conakry</u>
                                    </h4>
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">I.S.S.D GANDAL PLUS</u>
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
                                 <img src="/images/photos/logos/logo_gandal2.jpg" width="250px" heigth="200px" alt="logo_ecole" srcset="">
                            </div>
                        </div>
                        <br>
                        <div class="row col-md-12 col-sm-12 col-lg-12">
                            <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                <div class="cercle">
                                    <div class="text-center">
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">@lang('liste_eleve.ListeTousEleve')</u><br>
                                            <u class="souligner">
                                               @lang('liste_eleve.De') @lang('liste_eleve.Annee_Scolaire') {{ $annee_courante->annee_scolaire }}
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
                                            <th colspan="3" class="text-center" id="bordure_table">@lang('liste_eleve.Inscrit')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Inscrit')</td>
                                            <td class="text-center" id="bordure_table">@lang('liste_eleve.Garçon')</td>
                                            <td class="text-center" id="bordure_table"> @lang('liste_eleve.Fille') </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" id="bordure_table">{{ $all_inscriptions->count() }}</td>
                                            <td class="text-center" id="bordure_table">
                                                {{-- on affiche le nombre de garçon --}}
                                                @php
                                                    $nbre_garçon = 0;
                                                @endphp
                                                @foreach ($all_inscriptions as $inscription)
                                                    @if ($inscription->eleve->sexe == "Masculin")
                                                        @php $nbre_garçon++ @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_garçon }}
                                            </td>
                                            <td class="text-center" id="bordure_table">
                                                {{-- on affiche le nombre de fille --}}
                                                @php
                                                    $nbre_fille = 0;
                                                @endphp
                                                @foreach ($all_inscriptions as $inscription)
                                                    @if ($inscription->eleve->sexe == "Feminin")
                                                        @php $nbre_fille++ @endphp
                                                    @endif
                                                @endforeach
                                                {{ $nbre_fille }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div>
                            <table id="bordure_table" class="table table-bordered">
                                {{-- <th class="text-center" id="bordure_table">@lang('liste_eleve.Image')</th> --}}
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Matricule')</th>
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Nom') </th>
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Prenom')</th>
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Classe')</th>
                                <th class="text-center" id="bordure_table">@lang('liste_eleve.Tel_tuteur')</th>
                                <tbody id="bordure_table">
                                    @foreach ($all_inscriptions as $inscription)
                                        <tr id="bordure_table">
                                            {{-- <td class="text-center" id="bordure_table"><img src="/images/photos/eleves/{{ $inscription->eleve->photo_profil }}" width="120px" height="80px" alt="" srcset=""> </td> --}}
                                            <td class="text-center" id="bordure_table">{{ $inscription->eleve->matricule }}</td>
                                            <td class="text-center" id="bordure_table">{{ $inscription->eleve->nom }}</td>
                                            <td class="text-center" id="bordure_table">{{ $inscription->eleve->prenom }}</td>
                                            <td class="text-center" id="bordure_table">{{ $inscription->niveau->nom_niveau.' '.$inscription->niveau->options }}</td>
                                            <td class="text-center" id="bordure_table">{{ $inscription->eleve->telephone_parent }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="">
                            <h4 class=" pull-right font-bold addr-font-h4">
                              Conakry, @lang('liste_eleve.le') {{ date('d/m/Y') }}<br><br>@lang('liste_eleve.Direction')
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- script utiliser pour la suppression d'un eleve --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("eleve.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>


