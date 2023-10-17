<div
x-data="{ isUploading: false, progress: 0 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">@lang('profil.Mon_Profil')</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">@lang('home.Accueil')</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                {{-- <li><a class="parent-item" href="#"></a>&nbsp;<i class="fa fa-angle-right"></i>
                </li> --}}
                <li class="active">@lang('profil.Mon_Profil')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card card-topline-aqua">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                    @if($avatar)
                                        {{-- <div class="profile-userpic">
                                            <img src="{{ $avatar->temporaryUrl() }}" class="img-circle" alt="photo_profil" width="500" height="140">
                                        </div> --}}
                                    @else
                                        <div class="profile-userpic">
                                            <img src="images/photos/avatars/{{ $nom_photo }}" class="img-circle"  alt="photo_profil" width="500" height="140">
                                        </div>
                                    @endif
                            </div>
                            <div class="profile-usertitle">
                                {{-- message de succès du changement de photo de profil  --}}
                                    @if(session()->has('msg_photo_profil'))
                                        <div wire:poll.3s class="alert alert-success">
                                            <strong>{{ session('msg_photo_profil') }}</strong>
                                        </div>
                                    @endif
                                <div class="profile-usertitle-name"> {{ $nom }} </div>
                                {{-- <div class="profile-usertitle-job"> superviseur </div> --}}
                            </div>
                                <div class="profile-userbuttons">
                                    <form wire:submit.prevent='save_photo_profil'>
                                        <div class="form-group">
                                            <input type="file" wire:model='avatar' class="form-control @error('avatar')is-invalid @enderror" accept="image/*">
                                            <!-- Progress Bar -->
                                                <div x-show="isUploading">
                                                    <progress max="100" x-bind:value="progress"></progress>
                                                </div>
                                                <!-- Message d'erreur du photo de profil -->
                                                @error('avatar')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="msg_error_profil">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            <span class="profile-usertitle-job">Cliquez pour changer votre photo <br> (Taille max:12M)</span>
                                        </div>
                                        <button type="submit"
                                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary">@lang('profil.ChangePhoto')
                                        </button>
                                    </form>
                                </div>
                                <div class="profile-userbuttons">
                                    <a href="{{ route('form_change_password') }}"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">@lang('profil.ChangePassword')
                                    </a>
                                </div>
                            <!-- END SIDEBAR BUTTONS -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>@lang('profil.info_perso')</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>@lang('profil.Nom') </b>
                                    <div class="profile-desc-item pull-right">{{ $nom }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.Prenom') </b>
                                    <div class="profile-desc-item pull-right">{{ $prenom }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.Email') </b>
                                    <div class="profile-desc-item pull-right">{{ $email }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.Telephone') </b>
                                    <div class="profile-desc-item pull-right">{{ $telephone }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.Username') </b>
                                    <div class="profile-desc-item pull-right">{{ $username }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.Date_naiss') </b>
                                    <div class="profile-desc-item pull-right">{{ $date_format }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.civilite') </b>
                                    <div class="profile-desc-item pull-right">{{ $civilite }}</div>
                                </li>
                                <li class="list-group-item">
                                    <b>@lang('profil.Adresse') </b>
                                    <div class="profile-desc-item pull-right">{{ $adresse }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>@lang('profil.Biographie')</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <div class="row text-center m-t-10">
                                <div class="col-md-12">
                                    <p>
                                       {{ $biographie }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="card">
                            <div class="card-topline-aqua">
                                <header></header>
                            </div>
                            {{-- message de succès de la mis à jour des informatons personnelles --}}
                            @if(session()->has('message'))
                                <div wire:poll.5s class="alert alert-success">
                                    <strong>{{ session('message') }}</strong>
                                </div>
                            @endif
                            <div class="white-box">
                                <!-- Nav tabs -->
                                <div class="p-rl-20">
                                    <ul class="nav customtab nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#tab1" class="nav-link active" data-toggle="tab">
                                                @lang('profil.Mon_Profil')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#tab2" class="nav-link"data-toggle="tab">
                                                @lang('profil.info_perso')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="full-width p-rl-20">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="card card-box">
                                                            <div class="card-head">
                                                                <header>@lang('profil.Informations')</header>
                                                            </div>

                                                            <div class="card-body " id="bar-parent6">
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <h4>@lang('profil.Nom') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                                    <input type="text" wire:model='nom' class="form-control @error('nom')is-invalid @enderror" placeholder="Votre nom">
                                                                                        <!-- Message d'erreur du nom -->
                                                                                        @error('nom')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                </div>
                                                                                <br>
                                                                            <h4>@lang('profil.Email') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                                                    <input type="text" wire:model='email' class="form-control @error('email')is-invalid @enderror"  placeholder="Votre E-mail">
                                                                                        <!--Message d'erreur de l'email -->
                                                                                        @error('email')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                </div>
                                                                                <br>
                                                                            <h4>@lang('profil.Telephone') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                                    <input type="text" wire:model='telephone' class="form-control @error('telephone')is-invalid @enderror"
                                                                                          placeholder="Votre numéro de téléphone">
                                                                                    <!--Message d'erreur de l'email -->
                                                                                    @error('telephone')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <br>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <h4>@lang('profil.Prenom') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                                    <input type="text" wire:model='prenom' class="form-control @error('prenom')is-invalid @enderror" placeholder="Votre prénom">
                                                                                    <!--Message d'erreur du prénom -->
                                                                                    @error('prenom')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <br>
                                                                            <h4>@lang('profil.Username') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                                    <input type="text" wire:model='username' class="form-control @error('username')is-invalid @enderror" placeholder="Votre username">
                                                                                    <!--Message d'erreur du username -->
                                                                                    @error('username')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <br>
                                                                            <h4>@lang('profil.Date_naiss') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                                    <input type="date" wire:model='date_naiss' class="form-control @error('date_naiss')is-invalid @enderror"  placeholder="Date de naissance">
                                                                                    <!-- Message d'erreur de la date de naissance -->
                                                                                    @error('date_naiss')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <br>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <h4>@lang('profil.Adresse') *</h4>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                                                                    <input type="text" wire:model='adresse' class="form-control @error('adresse')is-invalid @enderror " placeholder="Votre adresse">
                                                                                    <!-- Message d'erreur de l'adresse -->
                                                                                        @error('adresse')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                </div>
                                                                                <br>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <h4>@lang('profil.civilite') *</h4>
                                                                                <div class="form-group">
                                                                                    <select wire:model='civilite' class="form-control @error('civilite')is-invalid @enderror">
                                                                                    <option value="null" >Choisir ...</option>
                                                                                    <option value="Monsieur">Monsieur</option>
                                                                                    <option value="Madame">Madame</option>
                                                                                    <option value="Mademoiselle">Mademoiselle</option>
                                                                                    </select>
                                                                                    <!-- Message d'erreur de la civilite -->
                                                                                    @error('civilite')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            <br>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for=""><h4>@lang('profil.Description')</h4></label>
                                                                                    <textarea wire:model='biographie' class="form-control @error('biographie')is-invalid @enderror" name="" id="" rows="3" placeholder="Votre biographie"></textarea>
                                                                                    <!-- Message d'erreur de la biographie -->
                                                                                    @error('biographie')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong id="msg_error_profil">{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                        <button wire:click='update_profil' type="button" class="btn btn-primary btn btn-block">@lang('profil.Update')</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div id="biography">
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('profil.Nom')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $nom }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('profil.Prenom')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $prenom }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('profil.Email')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $email }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>@lang('profil.Telephone')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $telephone }}</p>
                                                </div>
                                            </div>
                                                <hr>
                                            <div class="row">
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('profil.Username')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $username }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('profil.Date_naiss')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $date_format }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>@lang('profil.civilite')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $civilite }}</p>
                                                </div>
                                                <div class="col-md-3 col-6"> <strong>@lang('profil.Adresse')</strong>
                                                    <br>
                                                        <p class="text-muted">{{ $adresse }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4 class="font-bold center">@lang('profil.Biographie')</h4>
                                                <hr>
                                                    <p>
                                                        {{ $biographie }} <span class="espace"></span>
                                                    </p>
                                                <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
