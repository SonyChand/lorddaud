<div class="wrapper sidebar_minimize">
    <!-- Sidebar -->
    <?php

    if ($user->image == 'default') {
        if ($user->jenis_kelamin == 'L') {
            $fotoprofil = base_url('assets/img/user/default/') . 'L.jpg';
        } else {
            $fotoprofil = base_url('assets/img/user/default/') . 'P.jpg';
        }
    } else {
        $fotoprofil = base_url('assets/img/user/') . $user->image;
    }

    ?>
    <div class="sidebar sidebar-style-2" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="<?= base_url() ?>" class="logo text-white">
                    <!-- <img src="<?= base_url('assets/dash/assets/') ?>img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" /> -->
                    <span>SIAKAD</span>
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <?php
                    $menu = $this->db
                        ->order_by('order', 'ASC')
                        ->join('user_access_menu', 'user_menu.id_menu = user_access_menu.menu_id', 'left')
                        ->get_where('user_menu', [
                            'user_menu.is_active' => '1',
                            'user_access_menu.user_id' => $user->id_user,
                        ])->result();
                    ?>
                    <!-- Nav Item - Dashboard -->
                    <?php foreach ($menu as $row) : ?>
                        <?php
                        $submenu = $this->db
                            ->join('user_access_submenu', 'user_submenu.id_submenu = user_access_submenu.submenu_id', 'left')
                            ->get_where('user_submenu', [
                                'user_submenu.is_active' => "1",
                                'user_submenu.menu_id' => $row->id_menu,
                                'user_access_submenu.user_id' => $user->id_user,
                            ]);
                        ?>
                        <?php if ($submenu->num_rows() == 0) : ?>
                            <?php if ($title == $row->menu) : ?>

                                <li class="nav-item active">
                                    <a href="<?= base_url() . $row->uri; ?>">
                                        <i class="bi <?= $row->icon; ?>"></i>

                                    <?php else : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url() . $row->uri; ?>">
                                        <i class="bi <?= $row->icon; ?>"></i>
                                    <?php endif; ?>
                                    <p><?= $row->menu; ?></p>
                                    </a>
                                <?php else : ?>


                                <li class="nav-item">
                                    <a data-bs-toggle="collapse" href="#menu<?= $row->id_menu; ?>" class="collapsed" aria-expanded="false">
                                        <i class="fa <?= $row->icon; ?>"></i>
                                        <span><?= $row->menu; ?></span>
                                        <span class="caret"></span>
                                    </a>

                                    <div id="menu<?= $row->id_menu; ?>" class="collapse">
                                        <ul class="nav nav-collapse">

                                            <?php foreach ($submenu->result() as $s) : ?>
                                                <?php if ($this->uri->segment(2) == $s->uri2) : ?>
                                                    <li class="active">
                                                        <a href="<?= base_url($s->uri1 . '/' . $s->uri2); ?>">
                                                            <span class="sub-item"><?= $s->submenu; ?></span>
                                                        </a>
                                                    <?php else : ?>
                                                    <li>
                                                        <a href="<?= base_url($s->uri1 . '/' . $s->uri2); ?>">
                                                            <span class="sub-item"><?= $s->submenu; ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    </li>

                                                <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="<?= base_url('assets/dash/assets/') ?>img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="<?= $fotoprofil ?>" alt="..." class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold"><?= $user->name ?></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="<?= $fotoprofil ?>" alt="image profile" class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4><?= $user->name ?></h4>
                                                <p class="text-muted"><?= sumput($user->email) ?></p>
                                                <a href="<?= base_url('profil') ?>" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('profil') ?>">My Profile</a>
                                        <a class="dropdown-item" href="<?= base_url('profil') ?>">Change Password</a>
                                        <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>