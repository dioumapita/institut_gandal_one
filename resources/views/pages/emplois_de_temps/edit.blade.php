{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Emplois-Edit'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">@lang('emplois_temps.ModifEmplois')</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">@lang('home.EmploisDeTemps')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">@lang('emplois_temps.ModifEmplois')</li>
                    </ol>
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour')</a>
            <br><br>
            <!-- debut -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>@lang('liste_eleve.Classe') {{ $niveau_choisit->nom_niveau.' '.$niveau_choisit->options }}</header>
                        </div>
                        <div class="card-body ">
                            <form id="emplois-de-temps" method="POST" action="{{ route('emploi.update',$niveau_id) }}" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>@lang('emplois_temps.CoursDeMatin')</h3>
                                <fieldset>
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
                                                    @foreach ($emplois->unique() as $emploi)

                                                        @if ($emploi->heure_debut < 12)

                                                            <tr class="odd gradeX">
                                                                <td>
                                                                    @foreach ($emplois->unique() as $emploi)
                                                                        <label for="">@lang('emplois_temps.de')</label>
                                                                        <input type="text" name="heure_debut[]" value="{{ old('heure_debut[]')?old('heure_debut[]'):$emploi->heure_debut }}"  class="col-md-4 col-sm-4 col-4">
                                                                        <label for="">@lang('emplois_temps.a')</label>
                                                                        <input type="text" name="heure_fin[]" value="{{ $emploi->heure_fin }}"  class="col-md-4 col-sm-4 col-4">
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                    <br>
                                                                    <select class="form-control" name="L_matiere[]" id="">
                                                                        @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 1)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                    </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="M_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 2)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="Me_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 3)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="J_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 4)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="V_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 5)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="S_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 6)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                <h3>@lang('emplois_temps.CourDeMidi')</h3>
                                <fieldset>
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
                                                    @foreach ($emplois->unique() as $emploi)

                                                        @if ($emploi->heure_debut >= 12 AND  $emploi->heure_fin <= 15)

                                                            <tr class="odd gradeX">
                                                                <td>
                                                                    @foreach ($emplois->unique() as $emploi)
                                                                        <label for="">@lang('emplois_temps.de')</label>
                                                                        <input type="text" name="heure_debut[]" value="{{ $emploi->heure_debut }}"  class="col-md-4 col-sm-4 col-4">
                                                                        <label for="">@lang('emplois_temps.a')</label>
                                                                        <input type="text" name="heure_fin[]" value="{{ $emploi->heure_fin }}"   class="col-md-4 col-sm-4 col-4">
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                    <br>
                                                                    <select class="form-control" name="L_matiere[]" id="">
                                                                        @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 1)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                    </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="M_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 2)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="Me_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 3)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="J_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 4)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="V_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 5)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                    <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="S_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                @if ($emploi->jr == 6)
                                                                                    <option value=""></option>
                                                                                    @foreach ($all_matiere as $matiere)
                                                                                        <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                    @endforeach
                                                                                @else

                                                                                @endif

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                <h3>@lang('emplois_temps.CourDeSoir')</h3>
                                <fieldset>
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
                                                        @foreach ($emplois->unique() as $emploi)

                                                            @if ($emploi->heure_debut >= 15)

                                                                <tr class="odd gradeX">
                                                                    <td>
                                                                        @foreach ($emplois->unique() as $emploi)
                                                                            <label for="">@lang('emplois_temps.de')</label>
                                                                            <input type="text" name="heure_debut[]" value="{{ $emploi->heure_debut }}"  class="col-md-4 col-sm-4 col-4">
                                                                            <label for="">@lang('emplois_temps.a')</label>
                                                                            <input type="text" name="heure_fin[]" value="{{ $emploi->heure_fin }}"    class="col-md-4 col-sm-4 col-4">
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                        <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                        <div class="form-group">
                                                                        <br>
                                                                        <select class="form-control" name="L_matiere[]" id="">
                                                                            @foreach ($emplois as $emploi)

                                                                                    @if ($emploi->jr == 1)
                                                                                        <option value=""></option>
                                                                                        @foreach ($all_matiere as $matiere)
                                                                                            <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                        @endforeach
                                                                                    @else

                                                                                    @endif

                                                                                @endforeach
                                                                        </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                        <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <select class="form-control" name="M_matiere[]" id="">
                                                                                @foreach ($emplois as $emploi)

                                                                                    @if ($emploi->jr == 2)
                                                                                        <option value=""></option>
                                                                                        @foreach ($all_matiere as $matiere)
                                                                                            <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                        @endforeach
                                                                                    @else

                                                                                    @endif

                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                        <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <select class="form-control" name="Me_matiere[]" id="">
                                                                                @foreach ($emplois as $emploi)

                                                                                    @if ($emploi->jr == 3)
                                                                                        <option value=""></option>
                                                                                        @foreach ($all_matiere as $matiere)
                                                                                            <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                        @endforeach
                                                                                    @else

                                                                                    @endif

                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                        <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <select class="form-control" name="J_matiere[]" id="">
                                                                                @foreach ($emplois as $emploi)

                                                                                    @if ($emploi->jr == 4)
                                                                                        <option value=""></option>
                                                                                        @foreach ($all_matiere as $matiere)
                                                                                            <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                        @endforeach
                                                                                    @else

                                                                                    @endif

                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                        <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <select class="form-control" name="V_matiere[]" id="">
                                                                                @foreach ($emplois as $emploi)

                                                                                    @if ($emploi->jr == 5)
                                                                                        <option value=""></option>
                                                                                        @foreach ($all_matiere as $matiere)
                                                                                            <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                        @endforeach
                                                                                    @else

                                                                                    @endif

                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                                        <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <select class="form-control" name="S_matiere[]" id="">
                                                                                @foreach ($emplois as $emploi)

                                                                                    @if ($emploi->jr == 6)
                                                                                        <option value=""></option>
                                                                                        @foreach ($all_matiere as $matiere)
                                                                                            <option value="{{ $matiere->id }}" @if($emploi->matiere != '' and $emploi->matiere->id == $matiere->id) selected="selected" @endif>{{ $matiere->nom_matiere }}</option>
                                                                                        @endforeach
                                                                                    @else

                                                                                    @endif

                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- fin -->
        @endsection
