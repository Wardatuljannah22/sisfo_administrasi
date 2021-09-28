<script>
  //Untuk filter pastikan dropdown dibuat dan di panggil nilainya
  function refresh_table() {
    //Mendapatkan value dari dropdown id=filter_j_kelamin
    var jkelamin = $('#filter_j_kelamin').val();
    $.ajax({
      url: "<?= base_url('admin/biodata_santri/get_all') ?>",
      data: {
        j_kelamin: jkelamin
      },
      success: function(data) {
        $("#tampil").html(data);
        $('#biodata_santri').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#biodata_santri").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Santri',
            filename: 'Data Santri Pesantren Luhur Malang',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Santri',
            filename: 'Data Santri Pesantren Luhur Malang',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },

          }, {
            extend: 'csv',
            filename: 'Data Santri Pesantren Luhur Malang',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
            }
          }, {
            extend: 'print',
            title: '<center>Data Santri Pesantren Luhur Malang</center>',
            text: 'Print',
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
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
    $.ajax({
      url: '<?= site_url('admin/biodata_santri/crud/insert') ?>',
      type: 'POST',
      //  Tambahan Jika dengan file upload agar terbaca
      data: new FormData(this),
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function() {
        swal("Berhasil!", "Data Santri Baru Telah Ditambahkan.", "success");
        form[0].reset();
        modal_tambah.modal('hide');
        $('#biodata_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response) {
        alert(response);
      }
    })
  });

  //Bagian ini dan dibawahnya untuk filter
  $(document).ready(function() {
    //Setiap filter j kelamin diubah nilainya akan melakukan yang di dalam fungsi
    $('#filter_j_kelamin').change(function() {
      //bagian dibawah digunakan untuk memanggil fungsi filter_santri()
      filter_santri();
    });
  });
  //di bawah ini adalah fungsi filter santri
  function filter_santri() {
    //dibawah ini digunakan untuk mendapatkan nilai dari dropdown filter_j_kelamin
    var jkelamin = $('#filter_j_kelamin').val();
    $.ajax({
      url: "<?= base_url('admin/biodata_santri/get_all') ?>",
      //dibawah ini digunakan untuk mengirim value dari var jkelamin ke controller
      data: {
        j_kelamin: jkelamin
      },
      success: function(data) {
        $('#biodata_santri').DataTable().clear().destroy();
        $("#tampil").html(data);
        $('#biodata_santri').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#biodata_santri").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Santri',
            filename: 'Data Santri Pesantren Luhur Malang',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Santri Pesantren Luhur Malang',
            filename: 'Data Santri',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },

          }, {
            extend: 'csv',
            filename: 'Data Santri',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
            }
          }, {
            extend: 'print',
            title: '<center>Data Santri Pesantren Luhur Malang</center>',
            text: 'Print',
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
            }
          }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
      }
    });
  }
</script>