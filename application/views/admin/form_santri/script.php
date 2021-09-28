<script>
  //Untuk filter pastikan dropdown dibuat dan di panggil nilainya
  function refresh_table() {
    //Mendapatkan value dari dropdown id=filter_j_kelamin
    $.ajax({
      url: "<?= base_url('formsantri/get_all') ?>",
      success: function(data) {
        $("#tampil").html(data);
        $('#biodata_santri').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
        })
      }
    });
  };
  refresh_table();
</script>