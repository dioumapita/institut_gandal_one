{{-- on herite du chemin du theme actif --}}
    @extends($chemin_theme_actif,['title' => 'Absence-Eleve'])
        @section('content')
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Gestions Des Absences Des Eleves</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="#">Absences</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Gestions Des Absences Des Eleves</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-red">
                        <div class="card-head">
                            <header>Gestions Des Absences Des Eleves</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-2">
                                    <div class="form-group">
                                        <label for="">Selectionner une classe</label>
                                        <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id" required>
                                         <option value=""></option>
                                        @foreach ($all_niveaux as $key => $niveau)
                                            <option value="{{ route('absence_par_matiere',$niveau) }}">{{ $niveau->nom_niveau.' '.$niveau->options}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        @endsection