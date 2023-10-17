{{-- on herite du chemin du thème actif --}}
    @extends($chemin_theme_actif,['title' => 'Emplois-Create'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">@lang('emplois_temps.CreateEmplois')</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">@lang('liste_eleve.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">@lang('home.EmploisDeTemps')</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">@lang('emplois_temps.CreateEmplois')</li>
                    </ol>
                </div>
            </div>
            <a href="{{ route('emploi.index') }}" class="btn btn-info"><i class="fa fa-reply"></i> @lang('liste_eleve.Retour')</a>
            <a href="{{ route('emploi.show',$niveau_id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> @lang('emplois_temps.ListeEmplois')</a>
            <br><br>
            <!-- debut -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-head">
                                <header>@lang('liste_eleve.Classe') {{ $niveau_choisit->nom_niveau.' '.$niveau_choisit->options }}</header>
                            </div>
                            <div class="card-body ">
                                <form id="emplois-de-temps" method="POST" action="{{ route('emploi.store') }}" class="form-horizontal" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="niveau_choisi" value="{{ $niveau_id }}">
                                    <input type="hidden" name="annee_choisi" value="{{ $annee_id }}">
                                    <h3>Cour de 08 à 16</h3>
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
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label for="">@lang('emplois_temps.de')</label>
                                                            <input type="text" name="heure_debut[]" value="08:00"  class="col-md-4 col-sm-4 col-4">
                                                            <label for="">@lang('emplois_temps.a')</label>
                                                            <input type="text" name="heure_fin[]" value="10:00"  class="col-md-4 col-sm-4 col-4">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                             <br>
                                                              <select class="form-control" name="L_matiere[]" id="">
                                                                <option value=""></option>
                                                                  @foreach ($all_matiere as $matiere)
                                                                    <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label for="">@lang('emplois_temps.de')</label>
                                                            <input type="text" name="heure_debut[]" value="10:00"   class="col-md-4 col-sm-4 col-4">
                                                            <label for="">@lang('emplois_temps.a')</label>
                                                            <input type="text" name="heure_fin[]" value="12:00"   class="col-md-4 col-sm-4 col-4">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                             <br>
                                                              <select class="form-control" name="L_matiere[]" id="">
                                                                <option value=""></option>
                                                                  @foreach ($all_matiere as $matiere)
                                                                    <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
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
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label for="">@lang('emplois_temps.de')</label>
                                                            <input type="text" name="heure_debut[]" value="12:00"  class="col-md-4 col-sm-4 col-4">
                                                            <label for="">@lang('emplois_temps.a')</label>
                                                            <input type="text" name="heure_fin[]" value="14:00"  class="col-md-4 col-sm-4 col-4">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                             <br>
                                                              <select class="form-control" name="L_matiere[]" id="L_matiere2">
                                                                <option value=""></option>
                                                                @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="M_matiere[]" id="M_matiere2">
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="Me_matiere[]" id="Me_matiere2">
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="J_matiere[]" id="J_matiere2">
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="V_matiere[]" id="V_matiere2">
                                                                    <option value=""></option>
                                                                    @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="S_matiere[]" id="S_matiere2">
                                                                   <option></option>
                                                                   @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label for="">@lang('emplois_temps.de')</label>
                                                            <input type="text" name="heure_debut[]" value="14:00"  class="col-md-4 col-sm-4 col-4">
                                                            <label for="">@lang('emplois_temps.a')</label>
                                                            <input type="text" name="heure_fin[]" value="16:00"  class="col-md-4 col-sm-4 col-4">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                             <br>
                                                              <select class="form-control" name="L_matiere[]" id="L_matiere3">
                                                                <option></option>
                                                                @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="M_matiere[]" id="M_matiere3">
                                                                   <option></option>
                                                                   @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="Me_matiere[]" id="Me_matiere3">
                                                                   <option></option>
                                                                   @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="J_matiere[]" id="J_matiere3">
                                                                   <option></option>
                                                                   @foreach ($all_matiere as $matiere)
                                                                       <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="V_matiere[]" id="V_matiere3">
                                                                   <option></option>
                                                                   @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="niveau[]" value="{{ $niveau_id }}">
                                                            <input type="hidden" name="annee[]" value="{{ $annee_id }}">
                                                            <div class="form-group">
                                                                <br>
                                                                 <select class="form-control" name="S_matiere[]" id="S_matiere3">
                                                                   <option></option>
                                                                   @foreach ($all_matiere as $matiere)
                                                                        <option value="{{ $matiere->id }}">{{ $matiere->nom_matiere }}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                        </td>
                                                    </tr>
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
