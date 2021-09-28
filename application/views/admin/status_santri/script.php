<script>
   function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?= base_url('admin/status_santri/get_all') ?>",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#status_santri').DataTable({
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
       url: '<?=site_url('admin/status_santri/crud/insert')?>',
       type: 'POST',
      //  Tambahan Jika dengan file upload agar terbaca
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:false,
      success: function(){ 
        swal("Berhasil!", "Status Santri Telah Ditambahkan.", "success");
        form[0].reset();
        modal_tambah.modal('hide');
        $('#status-santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>

<!-- //fghjkl -->