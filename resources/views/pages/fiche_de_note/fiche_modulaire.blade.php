@extends($chemin_theme_actif,['title' => 'Fiche-De-Note'])
@section('content')
<div id="imprime" class="row">
    {{-- utiliser pour l'impression (rendu css) --}}
    <style>
        @media print{
            @page {size: landscape}

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
            #fiche_modulaire
            {
                border: 2px solid black !important;
                line-height: 15px;
                /* font-size: xx-large; */
            }

            #entete_sjckaloum
            {
                margin-top:-10% !important;
            }

        }
    </style>
    <div id="invisible-screens" class="col-md-12">
        <br><br><br>
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="entete_sjckaloum" class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;" id="bordure_table">
                                        <img width="100px" class="rounded mx-auto d-block" src="/images/photos/logos/logo_sjckaloum.jpg" alt="">
                                    </td>
                                    <td id="bordure_table">
                                        <h3 id="nom_ecole" class="text-center">
                                            GS JEUNES FILLES SAINT JOSEPH CLUNY<br>
                                            <u class="rouge">Discipline</u>-<u class="jaune">Travail</u>-<u class="vert">Succès</u>
                                        </h3>
                                        <h4 class="text-center">
                                            ADRESSE: CONAKRY/KALOUM/ALMAMAYA MOSQUEE/ BP: 52
                                        </h4>
                                    </td>
                                    <td style="width: 20%" id="bordure_table">
                                        <h4>
                                            Tel: 622 37 35 83<br>
                                            &emsp;&ensp;&nbsp; 620 47 72 36
                                            sjckaloum@gmail.com

                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row col-md-12 col-sm-12 col-lg-12">
                            <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                    <div class="text-center mx">
                                        <h4 class="text-center font-bold addr-font-h4">
                                            <u class="souligner">Fiche Modulaire Des Elèves De La {{ $niveau_choisi->nom_niveau.' '.$niveau_choisi->options }}</u><br>
                                            <u class="souligner">
                                            @lang('liste_eleve.De') @lang('liste_eleve.Annee_Scolaire'){{ $annee_courante->annee_scolaire }}
                                            </u>
                                        </h4>
                                    </div>
                            </div>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <th id="fiche_modulaire">N°</th>
                                <th id="fiche_modulaire">Prénom Et Nom</th>
                                    @foreach ($liste_des_matieres as $matiere)
                                        <th id="fiche_modulaire">{{ Str::limit($matiere->matiere->nom_matiere,3,'') }}</th>
                                    @endforeach
                                <th id="fiche_modulaire">Moy</th>
                                <th id="fiche_modulaire">Rang</th>
                                <tbody id="fiche_modulaire">
                                    @foreach ($classements as $classement)
                                            <tr>
                                                <td id="fiche_modulaire">{{ $n++ }}</td>
                                                <td id="fiche_modulaire">{{ $classement->eleve->prenom.' '.$classement->eleve->nom }}</td>
                                                {{-- @foreach ($liste_des_matieres as $matiere)
                                                    <td>
                                                        @if($matiere->id == $note->matiere_id)
                                                            @if(is_null($note->nbre_notes))

                                                            @else
                                                                {{ floor(($note->note1 + $note->note2 + $note->note3) / $note->nbre_notes * 100)/100 }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach --}}
                                                @foreach ($notes as $note)
                                                    @if($note->eleve->id == $classement->eleve->id)
                                                    <td id="fiche_modulaire">
                                                        @if(is_null($note->nbre_notes))

                                                            @else
                                                                {{ floor(($note->note1 + $note->note2 + $note->note3) / $note->nbre_notes * 100)/100 }}
                                                            @endif
                                                    </td>
                                                    @endif
                                                @endforeach
                                                <td id="fiche_modulaire">
                                                    {{ floor($classement->moy * 100)/100 }}
                                                </td>
                                                <td id="fiche_modulaire">
                                                    @if ($i == 1 and $classement->eleve->sexe == 'Masculin')
                                                        {{ $i++ }}<sup>er</sup>
                                                    @elseif($i == 1 and $classement->eleve->sexe == 'Feminin')
                                                        {{ $i++ }}<sup>ère</sup>
                                                    @else
                                                        {{ $i++ }}<sup>ème</sup>
                                                    @endif
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
</div>
@endsection
