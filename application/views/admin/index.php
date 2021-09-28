<!-- Begin Page Content -->
<div class="container-fluid">
    <?php foreach ($biodata->result() as $row){
        $nama = $row->nama_santri;
        $foto = $row->foto;
    }
    ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card mb-3 col-lg-6">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/uploads/foto_santri/'.$foto.'')?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php if($nama==null){echo 'Belum ada biodata';}else{echo $nama;}  ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Admin since <?= date('d F Y', $user['date_created']); ?></small></p>
                    <!-- d tanggal, F bulan, Y tahun -->
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->