@extends($chemin_theme_actif,['title' => 'Carte'])
    @section('content')
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Carte Scolaire</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">Elèves</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Carte Scolaire</li>
                </ol>
            </div>
        </div>
        <input type="button" class="btn btn-primary" onclick="printDiv('imprime')" value="Imprimer" />
            <div id="imprime">
                <style>
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

                    #couleur{
                        background-image: url('../../asset_badge/image_fond/7.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center center;
                        background-repeat:no-repeat;
                    }

                    #couleur2{
                        background-image: url('../../asset_badge/image_fond/7.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center center;
                        background-repeat:no-repeat;
                    }
                    #taille{

                        width: 1062px;
                    }
                    #title_card{
                        border-bottom: 3px double;
                        border-color: #297529;
                    }
                    .bordure{
                        border: 5px solid;
                        border-radius: 20px;
                        background-color: rgba(123, 209, 106, 0.541);


                    }
                    .inline{
                        font-size: medium;
                    }

                    .bordure{
                        border: 5px solid;
                        border-radius: 20px;
                        background-color: rgba(123, 209, 106, 0.541) !important;


                    }

                    /* pour le badge 2 */
                    #couleur_badge2_header{

                        background-image: url('../../asset_badge/image_fond/2.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center;
                        background-repeat:no-repeat;
                    }

                    #couleur_badge2_content{
                        background-image: url('../../asset_badge/image_fond/20.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center;
                        background-repeat:no-repeat;
                    }

                    #bordure_badge2{
                        border: 5px solid;
                        border-radius: 20px;
                        background-color: rgb(250, 9, 9) !important;
                    }
                    /* pour le badge 3 */
                    /* pour le badge 3 */

                    #couleur_badge3_header{

                        background-image: url('../../asset_badge/image_fond/14.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center;
                        background-repeat:no-repeat;
                    }

                    #couleur_badge3_content{
                        background-image: url('../../asset_badge/image_fond/20.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center;
                        background-repeat:no-repeat;
                    }
                    /* pour le badge 4 */

                    #couleur_badge4_header{

                        background-image: url('../../asset_badge/image_fond/7.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center;
                        background-repeat:no-repeat;
                        /* color: white; */
                    }

                    #couleur_badge4_content{
                        background-image: url('../../asset_badge/image_fond/27.jpg') !important;
                        background-size:cover;
                        -webkit-background-size:cover;
                        background-attachment:scroll;
                        background-position:center;
                        background-repeat:no-repeat;
                        /* color: white; */
                    }

                    #bordure_badge4{
                        border: 5px solid;
                        border-radius: 20px;
                        background-color: rgb(139, 194, 125) !important;
                    }
                </style>
                @foreach ($all_inscrits as $inscrit)
                    @if($inscrit->eleve->photo_profil != 'photo_eleve.png')
                        <div class="row">
                            <div>
                                <div id="taille">
                                    <div class="card flex-row flex-wrap">
                                        <div id="couleur" class="card-header border-0">
                                            <img src="/images/photos/logos/logo_emb.jpg" width="50px" height="50px" alt="">
                                            <br><br>
                                            <img src="/images/photos/eleves/{{ $inscrit->eleve->photo_profil }}" width="200px" height="150px" alt="">
                                        </div>
                                        <div id="couleur2" class="card-block px-5">
                                            <div class="text-center">
                                                <h4 id="title_card"  class="font-bold addr-font-h4">
                                                    Groupe Scolaire Elhadj Moussa Balde
                                                </h4>
                                                <div class="bordure">
                                                    <h5 class="font-bold addr-font-h4">
                                                        Carte De Retrait
                                                    </h5>
                                                </div>
                                            </div>
                                            <h4 class="font-bold addr-font-h4">Matricule:<p class="inline">{{ $inscrit->eleve->matricule }}</p></h4>
                                            <h4 class="font-bold addr-font-h4">Nom:<p class="inline">{{ $inscrit->eleve->nom }}</p></h4>
                                            <h4 class="font-bold addr-font-h4">Prénom(s):<p class="inline">{{ $inscrit->eleve->prenom }}</p></h4>
                                            <h4 class="font-bold addr-font-h4">Classe: <p class="inline">{{ $inscrit->niveau->nom_niveau }}</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quartier: <p class="inline"> {{ $inscrit->eleve->quartier }}</p></h4>
                                            {{-- <h4 class="font-bold addr-font-h4">Quartier: <p class="inline"> Guemer 1</p></h4> --}}
                                            <h4 class="font-bold addr-font-h4">Contact: <p class="inline">{{ $inscrit->eleve->telephone_parent }}</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Année Scolaire: <p class="inline"> 2022-2023</p></h4>
                                            {{-- <h4 class="font-bold addr-font-h4">Année Scolaire: <p class="inline"> 2020-2021</p></h4> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                {{-- <div class="row">
                    <div>
                        <div id="taille">
                            <div class="card flex-row flex-wrap">
                                <div id="couleur" class="card-header border-0">
                                    <img src="/images/photos/logos/logo_emb.jpg" width="50px" height="50px" alt="">
                                    <br><br>
                                    <img src="/assets/asset_principal/img/std/std1.jpg" width="200px" height="200px" alt="">
                                </div>
                                <div id="couleur2" class="card-block px-5">
                                    <div class="text-center">
                                        <h4 id="title_card"  class="font-bold addr-font-h4">
                                            Groupe Scolaire Elhadj Moussa Balde
                                        </h4>
                                        <div class="bordure">
                                            <h5 class="font-bold addr-font-h4">
                                                Carte De Retrait
                                            </h5>
                                        </div>
                                    </div>
                                    <h4 class="font-bold addr-font-h4">Matricule:<p class="inline"> 55555555</p></h4>
                                    <h4 class="font-bold addr-font-h4">Nom:<p class="inline"> Barry</p></h4>
                                    <h4 class="font-bold addr-font-h4">Prénom(s):<p class="inline"> ELhadj Mamadou Diouma</p></h4>
                                    <h4 class="font-bold addr-font-h4">Classe: <p class="inline"> 11ème Science Expérimentale</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quartier: <p class="inline"> Guemer 1</p></h4>
                                    <h4 class="font-bold addr-font-h4">Quartier: <p class="inline"> Guemer 1</p></h4>
                                    <h4 class="font-bold addr-font-h4">Contact: <p class="inline"> 623897708</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Année Scolaire: <p class="inline"> 2020-2021</p></h4>
                                    <h4 class="font-bold addr-font-h4">Année Scolaire: <p class="inline"> 2020-2021</p></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div id="taille">
                            <div class="card flex-row flex-wrap">
                                <div id="couleur" class="card-header border-0">
                                    <img src="/images/photos/logos/logo_emb.jpg" width="50px" height="50px" alt="">
                                    <br><br>
                                    <img src="/assets/asset_principal/img/std/std1.jpg" width="200px" height="200px" alt="">
                                </div>
                                <div id="couleur2" class="card-block px-5">
                                    <div class="text-center">
                                        <h4 id="title_card"  class="font-bold addr-font-h4">
                                            Groupe Scolaire Elhadj Moussa Balde
                                        </h4>
                                        <div class="bordure">
                                            <h5 class="font-bold addr-font-h4">
                                                Carte De Retrait
                                            </h5>
                                        </div>
                                    </div>
                                    <h4 class="font-bold addr-font-h4">Matricule:<p class="inline"> 55555555</p></h4>
                                    <h4 class="font-bold addr-font-h4">Nom:<p class="inline"> Barry</p></h4>
                                    <h4 class="font-bold addr-font-h4">Prénom(s):<p class="inline"> ELhadj Mamadou Diouma</p></h4>
                                    <h4 class="font-bold addr-font-h4">Classe: <p class="inline"> 11ème Science Expérimentale</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quartier: <p class="inline"> Guemer 1</p></h4>
                                    <h4 class="font-bold addr-font-h4">Quartier: <p class="inline"> Guemer 1</p></h4>
                                    <h4 class="font-bold addr-font-h4">Contact: <p class="inline"> 623897708</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Année Scolaire: <p class="inline"> 2020-2021</p></h4>
                                    <h4 class="font-bold addr-font-h4">Année Scolaire: <p class="inline"> 2020-2021</p></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

        {{-- <div class="card">
            <div class="row no-gutters">
                <div class="col-auto">
                    <img src="//placehold.it/200" class="img-fluid" alt="">
                </div>
                <div class="col">
                    <div class="card-block px-2">
                        <h4 class="card-title">Title</h4>
                        <p class="card-text">Description</p>
                        <a href="#" class="btn btn-primary">BUTTON</a>
                    </div>
                </div>
            </div>
            <div class="card-footer w-100 text-muted">
                Footer stating cats are CUTE little animals
            </div>
        </div> --}}


    @endsection
