<script>
   function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?= base_url('admin/nama_angkatan/get_all') ?>",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#nama_angkatan').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false
          });
        }
      });
    };
    refresh_table();
    $("#form-tambah").submit(function(e) {
      e.preventDefault();
      modal_tambah = $("#modal-tambah");
      form = $(this);
      $.ajax({
       url: '<?=site_url('admin/nama_angkatan/crud/insert')?>',
       type: 'POST',
      //  Tambahan Jika dengan file upload agar terbaca
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:false,
      success: function(){ 
        swal("Berhasil!", "Nama Angkatan Santri Telah Ditambahkan.", "success");
        form[0].reset();
        modal_tambah.modal('hide');
        $('#nama_angkatan').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>

<!-- //fghjkl -->