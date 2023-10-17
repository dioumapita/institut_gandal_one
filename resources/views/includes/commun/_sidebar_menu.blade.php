<!-- start sidebar menu -->
			<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll" class="left-sidemenu">
						<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
							data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							<li class="sidebar-user-panel">
								<div class="user-panel">
									<div class="pull-left image">
										<img src="/images/photos/avatars/{{ $avatar }}" class="img-circle user-img-circle"
											alt="Photo_profil" width="250px" height="80px" />
									</div>
									<div class="pull-left info">
										<p>{{ $nom }}</p>
										<a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline">
												En ligne</span></a>
									</div>
								</div>
							</li>
							<li class="nav-item {{ set_active_route('home') }}">
								<a href="{{ route('home') }}" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
									<span class="title">Menu principal</span>
								</a>
							</li>
							<li class="nav-item {{ set_active_route('liste_des_themes') }}">
								<a href="{{ route('liste_des_themes') }}" class="nav-link nav-toggle"> <i class="material-icons">color_lens</i>
									<span class="title">Thèmes</span>
								</a>
							</li>
							<!-- Start Elèves -->
								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
										<span class="title">@lang('home.Eleves')</span><span class="arrow"></span></a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="{{ route('eleve.create') }}" class="nav-link ">
												<span class="title">@lang('home.Inscription')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('eleve_reinscription') }}" class="nav-link ">
												<span class="title">@lang('home.Reinscription')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('eleve.index') }}" class="nav-link ">
												<span class="title">@lang('home.Listes')</span>
											</a>
										</li>
									</ul>
								</li>
							<!-- End Elèves -->
							<!-- Start Notes -->
								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle"> <i class="material-icons">note_add</i>
										<span class="title">@lang('note.Notes')</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="{{ route('liste_des_notes') }}" class="nav-link ">
												<span class="title">@lang('note.GestionDesNotes')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('config_moyenne.index') }}" class="nav-link ">
												<span class="title">@lang('home.Config_Moyenne')</span>
											</a>
										</li>
									</ul>
								</li>
							<!-- End Notes -->
							<!-- Start Enseignants -->
								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle"> <i class="material-icons">person</i>
										<span class="title">@lang('home.Enseignants')</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="{{ route('enseignant.create') }}" class="nav-link ">
												<span class="title">@lang('home.Inscription')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('enseignant.index') }}" class="nav-link ">
												<span class="title">@lang('home.Listes')</span>
											</a>
										</li>
									</ul>
								</li>
							<!-- End Enseignants -->
							<!-- Start Matières -->
								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle"> <i class="material-icons">local_library</i>
										<span class="title">@lang('home.Matieres')</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="{{ route('matiere.create') }}" class="nav-link ">
												<span class="title">@lang('home.Ajout')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('matiere.index') }}" class="nav-link ">
												<span class="title">@lang('home.Listes')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('config_matiere') }}" class="nav-link ">
												<span class="title">@lang('home.Configurations')</span>
											</a>
										</li>
									</ul>
								</li>
							<!-- End Matières -->
							<!-- Start Emplois Du Temps -->
								<li class="nav-item">
									<a href="#" class="nav-link nav-toggle"> <i class="material-icons">event</i>
										<span class="title">@lang('home.EmploisDeTemps')</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li class="nav-item">
											<a href="#" class="nav-link ">
												<span class="title">@lang('home.planification')</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="{{ route('attribution.index') }}" class="nav-link ">
												<span class="title">@lang('home.AttributionMatiere')</span>
											</a>
										</li>
									</ul>
								</li>
							<!-- End Emplois Du Temps -->
							<!-- Start Personnel -->
							<li class="nav-item">
								<a href="#" class="nav-link nav-toggle"> <i class="material-icons">supervisor_account</i>
									<span class="title">@lang('home.Personnels')</span> <span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="{{ route('Personnel.create') }}" class="nav-link ">
											<span class="title">@lang('home.Ajout')</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('Personnel.index') }}" class="nav-link">
											<span class="title">@lang('home.Listes')</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('creditpersonnel.index') }}" class="nav-link ">
											<span class="title">@lang('home.AvanceDeSalaire')</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('paiement_personnel.index') }}" class="nav-link ">
											<span class="title">@lang('home.Paiements')</span>
										</a>
									</li>
								</ul>
							</li>
						    <!-- End Personnel -->
                        @role('Superviseur')
                            <!-- Start Compte -->
                            <li class="nav-item">
                                <a href="{{ route('compte_user') }}" class="nav-link nav-toggle"> <i class="material-icons">supervisor_account</i>
                                    <span class="title">@lang('home.Compte')</span>
                                </a>
                            </li>
                            <!-- Start Permission -->
                            <li class="nav-item">
                                <a href="{{ route('privilege.index') }}" class="nav-link nav-toggle"> <i class="material-icons">supervisor_account</i>
                                    <span class="title">@lang('home.Privilege')</span>
                                </a>
                            </li>
                        @endrole
                        <!-- Start Trimestre -->
                        <li class="nav-item">
                            <a href="{{ route('config_trimestre') }}" class="nav-link nav-toggle"> <i class="material-icons">settings_input_component</i>
                                <span class="title">@lang('home.Trimestre')</span>
                            </a>
                        </li>
                        <!-- End Trimestre -->
						<!-- Start Etablissement -->
							{{-- <li class="nav-item">
								<a href="#" class="nav-link nav-toggle">
									<i class="material-icons">account_balance</i>
									<span class="title">Etablissement</span>
									<span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item {{ set_active_route('etablissement_infos_general') }}">
										<a href="{{ route('etablissement_infos_general') }}" class="nav-link ">
											<span class="title">Informations Générales</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="email_view.html" class="nav-link ">
											<span class="title">En-tête Des Rapports</span>
										</a>
									</li>
									<li class="nav-item {{ set_active_route('annee_scolaire.index') }}">
										<a href="{{ route('annees.index') }}" class="nav-link ">
											<span class="title">Année Scolaire</span>
										</a>
									</li>
								</ul>
							</li> --}}
						<!-- End Etablissement -->
						</ul>
					</div>
				</div>
			</div>
<!-- end sidebar menu -->
<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">

