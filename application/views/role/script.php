<script>
    function refresh_table() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('role/daftar_role/get_all') ?>",
            cache: false,
            success: function(data) {
                $("#tampil").html(data);
                $('#daftar_role').DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false
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
            url: '<?= site_url('role/daftar_role/crud/insert') ?>',
            type: 'POST',
            //  Tambahan Jika dengan file upload agar terbaca
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function() {
                swal("Berhasil!", "Role Baru Telah Ditambahkan.", "success");
                form[0].reset();
                modal_tambah.modal('hide');
                $('#daftar_role').DataTable().clear().destroy();
                refresh_table();
            },
            error: function(response) {
                alert(response);
            }
        })
    });
</script>

<!-- //fghjkl -->