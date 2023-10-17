@extends($chemin_theme_actif,['title' => 'Config-Trimestre'])
@section('content')
<!-- Start title -->
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Configuration Des Trimestres </div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;
                <a class="parent-item" href="#">Accueil</a>&nbsp;
                    <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Configuration Des Trimestres </li>
        </ol>
    </div>
</div>
<!-- End title -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Configuration Des Trimestres</header>
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
                    </div>
                </div>
                <div class="table-scrollable">
                    <table
                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                            id="eleves">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center"> Trimestre </th>
                                <th class="text-center">Mois 1</th>
                                <th class="text-center">Mois 2</th>
                                <th class="text-center">Mois 3</th>
                                <th class="text-center"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_trimestres as $trimestre)
                                <tr class="odd gradeX">
                                   <td class="text-center">{{ $i++ }}</td>
                                   <td class="text-center">{{ $trimestre->nom_trimestre }}</td>
                                   <td class="text-center">
                                       @if($trimestre->mois1 == 1)
                                            {{ "Janvier" }}
                                       @elseif($trimestre->mois1 == 2)
                                            {{ "Fevrier" }}
                                       @elseif($trimestre->mois1 == 3)
                                            {{ "Mars"}}
                                       @elseif($trimestre->mois1 == 4)
                                            {{ "Avril" }}
                                       @elseif($trimestre->mois1 == 5)
                                            {{ "Mai"}}
                                       @elseif($trimestre->mois1 == 6)
                                            {{ "Juin" }}
                                       @elseif($trimestre->mois1 == 7)
                                            {{ "Juillet"}}
                                       @elseif($trimestre->mois1 == 8)
                                            {{ "Aout" }}
                                       @elseif($trimestre->mois1 == 9)
                                            {{ "Septembre"}}
                                       @elseif($trimestre->mois1 == 10)
                                            {{ "Octobre"}}
                                       @elseif($trimestre->mois1 == 11)
                                            {{ "Novembre"}}
                                       @elseif($trimestre->mois1 == 12)
                                            {{ "Décembre"}}
                                       @else

                                       @endif
                                    </td>
                                   <td class="text-center">
                                    @if($trimestre->mois2 == 1)
                                        {{ "Janvier" }}
                                    @elseif($trimestre->mois2 == 2)
                                        {{ "Fevrier" }}
                                    @elseif($trimestre->mois2 == 3)
                                        {{ "Mars"}}
                                    @elseif($trimestre->mois2 == 4)
                                        {{ "Avril" }}
                                    @elseif($trimestre->mois2 == 5)
                                        {{ "Mai"}}
                                    @elseif($trimestre->mois2 == 6)
                                        {{ "Juin" }}
                                    @elseif($trimestre->mois2 == 7)
                                        {{ "Juillet"}}
                                    @elseif($trimestre->mois2 == 8)
                                        {{ "Aout" }}
                                    @elseif($trimestre->mois2 == 9)
                                        {{ "Septembre"}}
                                    @elseif($trimestre->mois2 == 10)
                                        {{ "Octobre"}}
                                    @elseif($trimestre->mois2 == 11)
                                        {{ "Novembre"}}
                                    @elseif($trimestre->mois2 == 12)
                                        {{ "Décembre"}}
                                    @else

                                    @endif
                                    </td>
                                   <td class="text-center">
                                    @if($trimestre->mois3 == 1)
                                         {{ "Janvier" }}
                                    @elseif($trimestre->mois3 == 2)
                                        {{ "Fevrier" }}
                                    @elseif($trimestre->mois3 == 3)
                                        {{ "Mars"}}
                                    @elseif($trimestre->mois3 == 4)
                                        {{ "Avril" }}
                                    @elseif($trimestre->mois3 == 5)
                                        {{ "Mai"}}
                                    @elseif($trimestre->mois3 == 6)
                                        {{ "Juin" }}
                                    @elseif($trimestre->mois3 == 7)
                                        {{ "Juillet"}}
                                    @elseif($trimestre->mois3 == 8)
                                        {{ "Aout" }}
                                    @elseif($trimestre->mois3 == 9)
                                        {{ "Septembre"}}
                                    @elseif($trimestre->mois3 == 10)
                                        {{ "Octobre"}}
                                    @elseif($trimestre->mois3 == 11)
                                        {{ "Novembre"}}
                                    @elseif($trimestre->mois3 == 12)
                                        {{ "Décembre"}}
                                    @else

                                    @endif
                                    </td>
                                   <td>
                                        <a class="btn btn-danger btn-block" href="#configModal" data-toggle="modal" data-target="#configModal{{ $trimestre->id }}">
                                            <i class="fa fa-pencil"></i> Modifier
                                        </a>
                                        <div class="container">
                                            <!-- Modal -->
                                            <div class="modal fade" id="configModal{{ $trimestre->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                            <h4 class="modal-title text-center" id="myModalLabel">Configuration Du  Trimestre</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="center">
                                                                <h4 class="media-heading">
                                                                    {{ $trimestre->nom_trimestre }}
                                                                </h4>
                                                            </div>
                                                                <form action="{{ route('update_config_trimestre',$trimestre->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}
                                                                    <input type="hidden" name="trimestre_id" value="{{ $trimestre->id }}">
                                                                    <div class="form-group">
                                                                        <label for="mois1">Premier Mois</label>
                                                                        <select  name="mois1" id="mois1" class="form-control select2">
                                                                          <option value="null">Sélectionnez un mois</option>
                                                                          <option value="1" @if($trimestre->mois1 == 1) selected @endif>Janvier</option>
                                                                            <option value="2" @if($trimestre->mois1 == 2) selected @endif>Fevrier</option>
                                                                            <option value="3" @if($trimestre->mois1 == 3) selected @endif>Mars</option>
                                                                            <option value="4" @if($trimestre->mois1 == 4) selected @endif>Avril</option>
                                                                            <option value="5" @if($trimestre->mois1 == 5) selected @endif>Mai</option>
                                                                            <option value="6" @if($trimestre->mois1 == 6) selected @endif>Juin</option>
                                                                            <option value="7" @if($trimestre->mois1 == 7) selected @endif>Juillet</option>
                                                                            <option value="8" @if($trimestre->mois1 == 8) selected @endif>Août</option>
                                                                            <option value="9" @if($trimestre->mois1 == 9) selected @endif>Septembre</option>
                                                                            <option value="10" @if($trimestre->mois1 == 10) selected @endif>Octobre</option>
                                                                            <option value="11" @if($trimestre->mois1 == 11) selected @endif>Novembre</option>
                                                                            <option value="12" @if($trimestre->mois1 == 12) selected @endif>Décembre</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="mois2">Deuxième Mois</label>
                                                                        <select  name="mois2" id="mois2" class="form-control select2">
                                                                          <option value="null">Sélectionnez un mois</option>
                                                                          <option value="1" @if($trimestre->mois2 == 1) selected @endif>Janvier</option>
                                                                            <option value="2" @if($trimestre->mois2 == 2) selected @endif>Fevrier</option>
                                                                            <option value="3" @if($trimestre->mois2 == 3) selected @endif>Mars</option>
                                                                            <option value="4" @if($trimestre->mois2 == 4) selected @endif>Avril</option>
                                                                            <option value="5" @if($trimestre->mois2 == 5) selected @endif>Mai</option>
                                                                            <option value="6" @if($trimestre->mois2 == 6) selected @endif>Juin</option>
                                                                            <option value="7" @if($trimestre->mois2 == 7) selected @endif>Juillet</option>
                                                                            <option value="8" @if($trimestre->mois2 == 8) selected @endif>Août</option>
                                                                            <option value="9" @if($trimestre->mois2 == 9) selected @endif>Septembre</option>
                                                                            <option value="10" @if($trimestre->mois2 == 10) selected @endif>Octobre</option>
                                                                            <option value="11" @if($trimestre->mois2 == 11) selected @endif>Novembre</option>
                                                                            <option value="12" @if($trimestre->mois2 == 12) selected @endif>Décembre</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="mois3">Troixième Mois</label>
                                                                        <select  name="mois3" id="mois3" class="form-control select2">
                                                                          <option value="null">Sélectionnez un mois</option>
                                                                          <option value="1" @if($trimestre->mois3 == 1) selected @endif>Janvier</option>
                                                                            <option value="2" @if($trimestre->mois3 == 2) selected @endif>Fevrier</option>
                                                                            <option value="3" @if($trimestre->mois3 == 3) selected @endif>Mars</option>
                                                                            <option value="4" @if($trimestre->mois3 == 4) selected @endif>Avril</option>
                                                                            <option value="5" @if($trimestre->mois3 == 5) selected @endif>Mai</option>
                                                                            <option value="6" @if($trimestre->mois3 == 6) selected @endif>Juin</option>
                                                                            <option value="7" @if($trimestre->mois3 == 7) selected @endif>Juillet</option>
                                                                            <option value="8" @if($trimestre->mois3 == 8) selected @endif>Août</option>
                                                                            <option value="9" @if($trimestre->mois3 == 9) selected @endif>Septembre</option>
                                                                            <option value="10" @if($trimestre->mois3 == 10) selected @endif>Octobre</option>
                                                                            <option value="11" @if($trimestre->mois3 == 11) selected @endif>Novembre</option>
                                                                            <option value="12" @if($trimestre->mois3 == 12) selected @endif>Décembre</option>
                                                                        </select>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
 </script>
@endsection
