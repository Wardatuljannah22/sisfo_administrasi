<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Status Santri</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tabel Status Santri</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<!-- data-toggle="modal" : Mengarahkan ke modal 
				data-target :"#modal-tambah" : buka modal dengan id='modal_tambah' 
				untuk edit sesuaikan-->
				<a data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Tambah Data</span>
				</a>
				&nbsp;

				</br>
				</br>
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
							<h5 class="modal-title" id="exampleModalLabel">Tambah Status Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="form-tambah" method='POST' enctype='multipart/form-data'>
								<!-- <div class="form-group">
							<label >ID STATUS </label>	
									<input type="text" class="form-control" id="id_st" name="id_status" style="background:#d5d8eb;color: #000000;">
							</div> -->

								<div class="form-group">
									<label>STATUS SANTRI</label>
									<input type="text" class="form-control" id="status_s" name="nama_status" style="background:#d5d8eb;color: #000000;">
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
	</div>
</div>