<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LTPLM<sup>88</sup></div>
    </a>
    <?php foreach ($role_check->result() as $result) : ?>
        <?php $role = $result->role_id ?>
    <?php endforeach; ?>
    <?php if ($role == 1) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Sekretaris
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('admin/admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Manajemen Santri
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-id-card"></i>
                <span> Data Santri</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub Menu Data Santri :</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/biodata_santri') ?>">Biodata Santri</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/data_kamar') ?>">Data Kamar</a>

                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Data Pengurus</span>
            </a>
            <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub Menu Data Pengurus :</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/majelis_santri') ?>">Majelis Santri</a>
                    <!-- <a class="collapse-item" href="<?php echo base_url('admin/masa_jabatan') ?>">Masa Jabatan</a>
                         -->
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-school"></i>
                <span> Data Pesantren</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub Menu Data Pesantren :</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/dewan_kyai') ?>">Dewan Kyai</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/nama_angkatan') ?>">Nama Angkatan</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/status_santri') ?>">Status Santri</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/nama_kamar') ?>">Nama Kamar</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/jumlah_santri') ?>">Jumlah Santri</a>
                </div>
            </div>
        </li>



    <?php endif; ?>
    <!-- Divider -->
    <?php if ($role == 2) : ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Peribadatan
        </div>
        <hr class="sidebar-divider  mt-3">


        <!-- Heading -->
        <div class="sidebar-heading pb-0">
            Manajemen Jadwal
        </div>


        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-book-reader"></i>
                <span> Kegiatan Pengajian</span>
            </a>
            <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sub-Menu Kegiatan :</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/pengajian') ?>">Pengajian Harian</a>
                    <a class="collapse-item" href="<?php echo base_url('admin/madin') ?>">Madrasah Diniyah</a>

                </div>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($role == 2 || $role == 1 || $role = 3) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider  mt-3">

        <!-- Heading -->
        <div class="sidebar-heading">
            User
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('user'); ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>My Profile</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <!-- <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('user/edit'); ?>">
                <i class="fas fa-fw fa-user-edit"></i>
                <span>Edit Profile</span></a>
        </li> -->

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('user/changepassword'); ?>">
                <i class="fas fa-fw fa-key"></i>
                <span>Change Password</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('formsantri'); ?>">
                <i class="fas fa-fw fa-id-card"></i>
                <span>Form Santri</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider mt-3">
    <?php endif; ?>
    <!-- Nav Item - Charts -->
    <li class="nav-item ">
        <a class="nav-link pb-0 mb-4" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>





    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->