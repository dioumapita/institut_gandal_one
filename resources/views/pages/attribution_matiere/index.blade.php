{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Attributions-Matières'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Attribution De Matières Aux Enseignants</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Enseignements</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Attribution De Matières Aux Enseignantx</li>
            </ol>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>Attribution De Matières Aux Enseignants</header>
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
                                <select onchange="window.location.href = this.value" class="form-control" name="niveau_id" id="niveau_id">
                                    <option value="">Selectionner une classe</option>
                                    @foreach ($all_niveau as $niveau)
                                    <option value="{{ route('attribution_de_matiere_par_niveau',$niveau->id) }}">{{ $niveau->nom_niveau.' '.$niveau->options }}</option>
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
