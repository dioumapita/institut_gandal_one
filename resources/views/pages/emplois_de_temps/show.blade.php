{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Emplois-Show'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">@lang('emplois_temps.AfficheEmplois')</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">@lang('home.EmploisDeTemps')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">@lang('emplois_temps.AfficheEmplois')</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>@lang('home.EmploisDeTemps') @lang('emplois_temps.de') @lang('liste_eleve.la') {{ $niveau->nom_niveau.' '.$niveau->options }}</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6">
                                    <a href="{{ route('emploi.index') }}">
                                        <div class="btn-group">
                                            <button id="addRow1" class="btn btn-info">
                                                 <i class="fa fa-reply"></i> @lang('liste_eleve.Retour')
                                            </button>
                                        </div>
                                    </a>
                                    &nbsp;
                                    <a href="{{ route('emploi.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('emplois_temps.Nouveau')</a>
                                    &nbsp;
                                    {{-- <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="@lang('liste_eleve.Imprimer')" /> --}}
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="btn-group pull-right">
                                        <!--bouton suppression -->
                                        <a href="#myModalDeleteEmploi" data-toggle="modal" onclick="deleteData({{$niveau_id}})"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i> @lang('liste_eleve.Supprimer')
                                        </a>
                                        <!-- debut modal -->
                                            <div id="myModalDeleteEmploi" class="mt-5 modal fade" data-backdrop="static">
                                                <div class="mt-5 modal-dialog modal-confirm">
                                                    <div class="modal-content">
                                                        <div class="modal-header flex-column">
                                                            <div class="icon-box">
                                                                <i class="material-icons">&#xE5CD;</i>
                                                            </div>
                                                            <h4 class="modal-title w-100">@lang('note.Confirmation')</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- <p>
                                                                Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                            </p> --}}
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('note.Annuler')</button>
                                                            <form action="{{ route('emploi.destroy',$niveau_id) }}" method="post" id="deleteform">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                    @lang('note.OuiSupprimer')
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- fin modal -->
                                    </div>
                                    <div class="btn-group pull-right">
                                        &nbsp;&nbsp;
                                    </div>
                                    <div class="btn-group pull-right">
                                        <a href="{{ route('emploi.edit',$niveau_id) }}">
                                            <div class="btn-group">
                                                <button id="addRow1" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>@lang('liste_eleve.Modifier')
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-scrollable">
                                <table
                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width="18%"> @lang('emplois_temps.Horaires')  </th>
                                            <th> @lang('emplois_temps.LUNDI') </th>
                                            <th> @lang('emplois_temps.MARDI') </th>
                                            <th> @lang('emplois_temps.MERCREDI') </th>
                                            <th> @lang('emplois_temps.JEUDI') </th>
                                            <th> @lang('emplois_temps.VENDREDI') </th>
                                            <th> @lang('emplois_temps.SAMEDI') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emplois_du_temps as $emplois)
                                            <tr class="odd gradeX">
                                                <td>
                                                    @foreach ($emplois->unique() as $emploi)
                                                        {{ $emploi->heure_debut }} @lang('emplois_temps.a') {{ $emploi->heure_fin }}
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        @foreach ($emplois as $emploi)
                                                           @if ($emploi->matiere == '')

                                                           @else
                                                                @if ($emploi->jr == 1)
                                                                    {{ $emploi->matiere->nom_matiere }}
                                                                @else

                                                                @endif

                                                           @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        @foreach ($emplois as $emploi)
                                                           @if ($emploi->matiere == '')

                                                           @else
                                                                @if ($emploi->jr == 2)
                                                                    {{ $emploi->matiere->nom_matiere }}
                                                                @else

                                                                @endif

                                                           @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        @foreach ($emplois as $emploi)
                                                           @if ($emploi->matiere == '')

                                                           @else
                                                                @if ($emploi->jr == 3)
                                                                    {{ $emploi->matiere->nom_matiere }}
                                                                @else

                                                                @endif

                                                           @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        @foreach ($emplois as $emploi)
                                                           @if ($emploi->matiere == '')

                                                           @else
                                                                @if ($emploi->jr == 4)
                                                                    {{ $emploi->matiere->nom_matiere }}
                                                                @else

                                                                @endif

                                                           @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        @foreach ($emplois as $emploi)
                                                           @if ($emploi->matiere == '')

                                                           @else
                                                                @if ($emploi->jr == 5)
                                                                    {{ $emploi->matiere->nom_matiere }}
                                                                @else

                                                                @endif

                                                           @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="">
                                                        @foreach ($emplois as $emploi)
                                                           @if ($emploi->matiere == '')

                                                           @else
                                                                @if ($emploi->jr == 6)
                                                                    {{ $emploi->matiere->nom_matiere }}
                                                                @else

                                                                @endif

                                                           @endif
                                                        @endforeach
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
            <!--print emplois -->

            <div id="imprime" class="row">
                {{-- utiliser pour l'impression (rendu css) --}}
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
                <div id="invisible-screen" class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h4 class="font-bold addr-font-h4">
                                                <u class="souligner">MENPU-A</u>
                                                <br>

                                                <u class="souligner">I.R.E: Kindia</u>
                                                <br>

                                                <u class="souligner">D.P.E: Dubreka</u>

                                                <br>

                                                <u class="souligner">D.S.S.E: Kagbelen</u>
                                            </h4>
                                            <h4 class="font-bold addr-font-h4">
                                                <u class="souligner">Complexe Scolaire Futur Génération</u>
                                            </h4>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <h4 class="font-bold addr-font-h4">
                                                <u class="souligner">REPLUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                             <br>
                                               <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                            </h4>
                                        </address>
                                    </div>
                                    <div class="center">
                                        <img src="/images/photos/logos/logo_fug.png" width="250px" heigth="200px" alt="logo_ecole" srcset="">
                                    </div>
                                </div>
                                <div class="row col-md-12 col-sm-12 col-lg-12">
                                    <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                        <div class="cercle">
                                            <div class="text-center">
                                                <h4 class="font-bold addr-font-h4">
                                                    <u class="souligner">@lang('home.EmploisDeTemps')</u><br>
                                                    <u class="souligner">
                                                    @lang('liste_eleve.Classe') {{ $niveau->nom_niveau.' '.$niveau->options }} <br>
                                                     @lang('liste_eleve.Annee_Scolaire2') {{ $annee_courante->annee_scolaire }}
                                                    </u>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br><br>
                                <div>
                                    <table class="table table-bordered">
                                        <thead id="bordure_table">
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.Horaires')</th>
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.LUNDI')</th>
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.MARDI')</th>
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.MERCREDI')</th>
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.JEUDI')</th>
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.VENDREDI')</th>
                                            <th class="text-center" id="bordure_table">@lang('emplois_temps.SAMEDI')</th>
                                        </thead>
                                        <tbody id="bordure_tables">
                                            @foreach ($emplois_du_temps as $emplois)

                                                <tr class="odd gradeX" id="bordure_table">
                                                    <td class="text-center" id="bordure_tables">
                                                        @foreach ($emplois->unique() as $emploi)
                                                            {{ $emploi->heure_debut }} @lang('emplois_temps.a') {{ $emploi->heure_fin }}
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center" id="bordure_tables">
                                                        <div class="">
                                                            @foreach ($emplois as $emploi)
                                                            @if ($emploi->matiere == '')

                                                            @else
                                                                    @if ($emploi->jr == 1)
                                                                        {{ $emploi->matiere->nom_matiere }}
                                                                    @else

                                                                    @endif

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-center" id="bordure_tables">
                                                        <div class="">
                                                            @foreach ($emplois as $emploi)
                                                            @if ($emploi->matiere == '')

                                                            @else
                                                                    @if ($emploi->jr == 2)
                                                                        {{ $emploi->matiere->nom_matiere }}
                                                                    @else

                                                                    @endif

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-center" id="bordure_tables">
                                                        <div class="">
                                                            @foreach ($emplois as $emploi)
                                                            @if ($emploi->matiere == '')

                                                            @else
                                                                    @if ($emploi->jr == 3)
                                                                        {{ $emploi->matiere->nom_matiere }}
                                                                    @else

                                                                    @endif

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-center" id="bordure_tables">
                                                        <div class="">
                                                            @foreach ($emplois as $emploi)
                                                            @if ($emploi->matiere == '')

                                                            @else
                                                                    @if ($emploi->jr == 4)
                                                                        {{ $emploi->matiere->nom_matiere }}
                                                                    @else

                                                                    @endif

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-center" id="bordure_tables">
                                                        <div class="">
                                                            @foreach ($emplois as $emploi)
                                                            @if ($emploi->matiere == '')

                                                            @else
                                                                    @if ($emploi->jr == 5)
                                                                        {{ $emploi->matiere->nom_matiere }}
                                                                    @else

                                                                    @endif

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-center" id="bordure_tables">
                                                        <div class="">
                                                            @foreach ($emplois as $emploi)
                                                            @if ($emploi->matiere == '')

                                                            @else
                                                                    @if ($emploi->jr == 6)
                                                                        {{ $emploi->matiere->nom_matiere }}
                                                                    @else

                                                                    @endif

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pull-right">
                                    <br>
                                    <h4 class=" pull-right font-bold addr-font-h4">
                                        Conakry , @lang('liste_eleve.le') {{ date('d/m/Y') }}
                                            <br><br>
                                            @lang('liste_eleve.Direction')
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- end print emplois -->
        @endsection
{{-- script utiliser pour la suppression d'un niveau --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("emploi.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
