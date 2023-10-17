@extends('layouts.auth',['title' => 'mot de passe oublier'])

@section('content')
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
            @endif
            <span class="login100-form-logo">
                <img alt="" src="/assets/asset_auth/images/password.jpg">
            </span>
            <p class="text-center txt-small-heading">
                Votre clé de licence n'est plus valide.Veuillez contactez l'administrateur
                pour activer la licence<br>623-89-77-08</br>666-81-63-30
            </p>
        </div>
    </div>
</div>
@endsection
