<div class="left-side-menu">
                <div class="media user-profile mt-2 mb-2">
                    <img src="assets/images/users/avatar-7.jpg" class="avatar-sm rounded-circle mr-2" alt="Shreyu" />
                    <img src="assets/images/users/avatar-7.jpg" class="avatar-xs rounded-circle mr-2" alt="Shreyu" />

                    <div class="media-body">
                        <h6 class="pro-user-name mt-0 mb-0">SI Reservasi</h6>
                        <span class="pro-user-desc">Administrator</span>
                    </div>
                    <div class="dropdown align-self-center profile-dropdown-menu">
                        <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <span data-feather="chevron-down"></span>
                        </a>
                        <div class="dropdown-menu profile-dropdown">
                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                <span>My Account</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                                <span>Settings</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                                <span>Support</span>
                            </a>

                            <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-content">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu" class="slimscroll-menu">
                        <ul class="metismenu" id="menu-bar">
                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="<?= base_url('dashboard') ?>">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url('user') ?>">
                                    <i data-feather="user-check"></i>
                                    <span> User </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url('kabupaten') ?>">
                                    <i data-feather="globe"></i>
                                    <span> Kabupaten </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url('layanan') ?>">
                                    <i data-feather="globe"></i>
                                    <span> Layanan </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url('galeri') ?>">
                                    <i data-feather="globe"></i>
                                    <span> Galeri </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url('reservasi') ?>">
                                    <i data-feather="check-square"></i>
                                    <span class="badge badge-success float-right">1</span>
                                    <span> Reservasi </span>
                                </a>
                            </li>

                            <li>
                                <a href="index.html">
                                    <i data-feather="eye-off"></i>
                                    <span class="badge badge-success float-right">1</span>
                                    <span> Pembatalan </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->

            </div>