<script>
  function refresh_table() {
    var id_hari = $('#filter_jadwal_ngaji').val();
    $.ajax({
      url: "<?= base_url('admin/madin/get_all') ?>",
      data: {
        id_hari: id_hari
      },
      success: function(data) {
        $("#tampil").html(data);
        $('#madin').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#madin").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Jadwal Madin',
            filename: 'Data Jadwal Madin',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Jadwal Madin',
            filename: 'jadwal_madin',
            exportOptions: {
              columns: [0, 1, 2, 3, 4],
            },
            customize: function(xlsx) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              // Loop over the cells
              $('row c', sheet).each(function() {
                //select the index of the row
                var angka = $(this).parent().index();
                var residu = angka % 2;
                if (angka == 1) {
                  $(this).attr('s', '22'); //22 - Bold, blue background
                }
                // else if (angka>1){
                //     if(residu ==0  ){//'is t',
                //     $(this).attr('s','25');//25 - Normal text, fine black border
                //     }else{
                //     $(this).attr('s','32');//32 - Bold, gray background, fine black border
                //     }
                // }
              });
            },

          }, {
            extend: 'csv',
            filename: 'Data Jadwal Madin',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          }, {
            extend: 'print',
            title: '<center>Data Jadwal Madin</center>',
            text: 'Cetak',
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4]
            }
          }]
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
      url: '<?= site_url('admin/madin/crud/insert') ?>',
      type: 'POST',
      //  Tambahan Jika dengan file upload agar terbaca
      data: new FormData(this),
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function() {
        swal("Berhasil!", "Data Jadwal Madin Telah Ditambahkan.", "success");
        form[0].reset();
        modal_tambah.modal('hide');
        $('#madin').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response) {
        alert(response);
      }
    })
  });


  $(document).ready(function() {
    $('#filter_jadwal_ngaji').change(function() {
      filter_madin();
    });
  });

  function filter_madin() {
    var id_hari = $('#filter_jadwal_ngaji').val();
    $.ajax({
      url: "<?= base_url('admin/madin/get_all') ?>",
      data: {
        id_hari: id_hari
      },
      success: function(data) {
        $('#madin').DataTable().clear().destroy();
        $("#tampil").html(data);
        $('#madin').DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "initComplete": function(settings, json) {
            $("#madin").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
          },
          dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Jadwal Madin',
            filename: 'Data Jadwal Madin',
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4]
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center';
            }
          }, {
            extend: 'excel',
            title: 'Data Jadwal Madin',
            filename: 'Data Jadwal Madin',
            exportOptions: {
              columns: [0, 1, 2, 3, 4],
            },

          }, {
            extend: 'csv',
            filename: 'Data Jadwal Madin',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          }, {
            extend: 'print',
            title: '<center>Data Jadwal Madin</center>',
            text: 'Cetak',
            exportOptions: {
              stripHtml: false,
              columns: [0, 1, 2, 3, 4]
            }
          }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
      }
    });
  }
</script>