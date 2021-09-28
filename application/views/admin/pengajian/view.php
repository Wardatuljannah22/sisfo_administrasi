<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Kegiatan Pengajian Bersama Dewan Kyai </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tabel Pengajian Harian</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<a  data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Tambah Data</span>
				</a>

				&nbsp;
				<a data-toggle="modal" data-target="#modal-upload" class="btn btn-info btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-file-import"></i>
					</span>
					<span class="text">Import Excel</span>
				</a>


				</br>
				</br>
				<div class="col-md-3 form-group">
                  <select class="form-control select2" name="filter_waktu" id="filter_waktu" style="width: 100%;">
                    <option value="0">Perlihatkan Semua</option>
                    <?php foreach($waktu as $row) : ?>
                      <option value="<?php echo $row->id_w ?>"><?php echo $row->waktu_p ?></option>
                    <?php endforeach ?>
                  </select>
                 </div>
				<!-- Ganti div dengan table lood ajax -->
				<div id="tampil">
					<!-- Data tampil disini -->
				</div>
			</div>

			<!-- modal tambah data -->
			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Form Tambah Pengajian</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-tambah" method="post">
							<div class="form-group">
								<label>DEWAN KYAI</label>
								<select name="id_kyai" id="id_kyai" class="form-control">
									<option value="">Pilih Dewan Kyai</option>
									<?php foreach ($kyai as $y) : ?>
										<option value="<?php echo $y->id_kyai ?>"><?php echo $y->nama_kyai ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label>NAMA KITAB </label>
								<select name="id_kitab" id="id_kitab" class="form-control">
									<option value="">Pilih Kitab</option>
									<?php foreach ($kitab as $t) : ?>
										<option value="<?php echo $t->id_kitab ?>"><?php echo $t->nama_kitab ?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group">
								<label>HARI</label>
								<select name="id_hari" id="id_hari" class="form-control">
									<option value="">Pilih Hari</option>
									<?php foreach ($hari as $h) : ?>
										<option value="<?php echo $h->id_hari ?>"><?php echo $h->nama_hari ?></option>
									<?php endforeach ?>
								</select>
								<!-- <input type="text" class="form-control" id="nama_s" name="nama_santri" style="background:#d5d8eb;color: #000000;"> -->
							</div>

							<div class="form-group">
								<label>WAKTU</label>
								<select name="id_w" id="id_w" class="form-control">
									<option value="">Pilih Waktu</option>
									<?php foreach ($waktu as $w) : ?>
										<option value="<?php echo $w->id_w ?>"><?php echo $w->waktu_p ?></option>
									<?php endforeach ?>
								</select>
								<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>