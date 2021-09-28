<script>
  function refresh_table() {
    var jkelamin = $('#filter_j_kelamin').val();
    $.ajax({
      url: "<?= base_url('admin/data_kamar/get_all') ?>",
      data: {
        j_kelamin: jkelamin
      },
      success: function(data) {
        $("#tampil").html(data);
        $('#data_kamar').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#data_kamar").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Kamar Santri',
            filename: 'Data Kamar Santri',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Kamar Santri',
            filename: 'Data Kamar Santri',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6],
            },

          }, {
            extend: 'csv',
            filename: 'Data Kamar Santri',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6]
            }
          }, {
            extend: 'print',
            title: '<center>Data Kamar Santri</center>',
            text: 'Cetak',
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6]
            }
          }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
      }
    });
  };
  refresh_table();
  $("#form-tambah").submit(function(e) {
    e.preventDefault();
    modal_tambah = $("#modal-tambah");
    form = $(this);
    if (parseInt($('#kuota_tbh3').val()) < parseInt($('#kuota_ka_tbh').val())) {
      swal("Gagal!", "Kuota orang melebihi kuota yang tersedia.", "warning");
    } else if (parseInt($('#kuota_tbh3').val()) >= parseInt($('#kuota_ka_tbh').val())) {
      $.ajax({
        url: '<?= site_url('admin/data_kamar/crud/insert') ?>',
        type: 'POST',
        //  Tambahan Jika dengan file upload agar terbaca
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function() {
          swal("Berhasil!", "Data Kamar Santri Baru Telah Ditambahkan.", "success");
          form[0].reset();
          modal_tambah.modal('hide');
          $('#data_kamar').DataTable().clear().destroy();
          refresh_table();
        },
        error: function(response) {
          alert(response);
        }
      })
    }
  });
  $(document).ready(function() {
    $('#filter_j_kelamin').change(function() {
      filter_kamar();
    });
  });

  function filter_kamar() {
    var jkelamin = $('#filter_j_kelamin').val();
    $.ajax({
      url: "<?= base_url('admin/data_kamar/get_all') ?>",
      data: {
        j_kelamin: jkelamin
      },
      success: function(data) {
        $('#data_kamar').DataTable().clear().destroy();
        $("#tampil").html(data);
        $('#data_kamar').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#data_kamar").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Kamar Santri',
            filename: 'Data Kamar Santri',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Kamar Santri',
            filename: 'Data Kamar Santri',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6],
            },

          }, {
            extend: 'csv',
            filename: 'Data Kamar Santri',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6]
            }
          }, {
            extend: 'print',
            title: '<center>Data Kamar Santri</center>',
            text: 'Print',
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6]
            }
          }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
      }
    });
  }

  function myKuota() {
    let id_ka = $("#id_ka_tbh").val();
    $.ajax({
      url: '<?= site_url('admin/data_kamar/get_kuota') ?>',
      type: 'GET',
      dataType: 'json',
      data: {
        id_ka: id_ka
      },
      success: function(data) {
        $("#sisa_k").val(data.object.kuota_kamar + " Orang");
        $("#kuota_tbh3").val(data.object.kuota_kamar);
      },
      error: function(request, status, error) {
        alert('Tidak tersedia');
      }
    })
  }
</script>