<script>
   function refresh_table() {
    var jkelamin = $('#filter_j_kelamin').val();
    $.ajax({
        url: "<?= base_url('admin/majelis_santri/get_all') ?>",
        data: {
          j_kelamin : jkelamin
        },
        success: function(data) {
          $("#tampil").html(data);
          $('#majelis_santri').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "initComplete": function (settings, json) {  
            $("#majelis_santri").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },
          dom: 
          "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Majelis Santri Pesantren Luhur Malang',
            filename: 'Majelis Santri', 
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
                stripHtml: false,
                columns: [0,1,2,3,4,5,6,7] 
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center'; 
             }  
            }, {
            extend: 'excel',
            title: 'Data Majelis Santri Pesantren Luhur Malang',
            filename: 'Majelis Santri',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7],
            },
            customize: function(xlsx) {
            var sheet = xlsx.xl.worksheets['sheet1.xml'];
            // Loop over the cells
            $('row c', sheet).each(function() {
            //select the index of the row
            var angka=$(this).parent().index() ;
            var residu = angka%2;
            if (angka==1){           
                $(this).attr('s','22');//22 - Bold, blue background
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
            filename: 'Data Majelis Santri Pesantren Luhur Malang',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7] 
            }
          },{
            extend: 'print',
            title: '<center>Data Majelis Santri Pesantren Luhur Malang</center>',
            text: 'Print',
            exportOptions: 
            {
              stripHtml: false,
              columns: [0,1,2,3,4,5,6,7] 
            }
          },]
          }).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
        }
      });
    };
    $('#nistbh').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Santri"
    });
    $('#jabatantbh').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Jabatan"
    });
    refresh_table();
    $("#form-tambah").submit(function(e) {
      e.preventDefault();
      modal_tambah = $("#modal-tambah");
      form = $(this);
      $.ajax({
       url: '<?=site_url('admin/majelis_santri/crud/insert')?>',
       type: 'POST',
      //  Tambahan Jika dengan file upload agar terbaca
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:true,
      success: function(){ 
        swal("Berhasil!", "Data Majelis Santri Telah Ditambahkan.", "success");
        form[0].reset();
        modal_tambah.modal('hide');
        $('#majelis_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });

    $(document).ready(function() {
        $('#filter_j_kelamin').change(function() {
         filter_majelis_santri();
        });
      });
      
    function filter_majelis_santri() {
    var jkelamin = $('#filter_j_kelamin').val();
    $.ajax({
      url: "<?= base_url('admin/majelis_santri/get_all') ?>",
      data: {
        j_kelamin : jkelamin
      },
      success: function(data) {
        $('#majelis_santri').DataTable().clear().destroy();
        $("#tampil").html(data);
          $('#majelis_santri').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "initComplete": function (settings, json) {  
            $("#majelis_santri").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },
          dom: 
          "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          // "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          // "<'row'<'col-sm-12'tr>>" +
          // "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          buttons: [{
            extend: 'pdf',
            title: 'Data Santri',
            filename: 'Data Majelis Santri Pesantren Luhur Malang', 
            pageSize: 'A4',
            // customize: function (doc) {
            //                doc.defaultStyle.fontSize = 10; //2, 3, 4,etc
            //                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            //                doc.content[1].table.widths = [ '14%',  '14%', '14%', '0%', '14%', 
            //                                                '15%', '15%', '15%'];
            //            },
            exportOptions: {
                stripHtml: false,
                columns: [0,1,2,3,4,5,6,7] 
            },
            customize: function(doc) {
              doc.styles.tableBodyEven.alignment = 'center';
              doc.styles.tableBodyOdd.alignment = 'center'; 
             }  
            }, {
            extend: 'excel',
            title: 'Data Majelis Santri Pesantren Luhur Malang',
            filename: 'Data Majelis Santri Pesantren Luhur Malang',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7],
            },

           }, {
            extend: 'csv',
            filename: 'Data Majelis Santri Pesantren Luhur Malang',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7] 
            }
          },{
            extend: 'print',
            title: '<center>Data Majelis Santri Pesantren Luhur Malang</center>',
            text: 'Print',
            exportOptions: 
            {
              stripHtml: false,
              columns: [0,1,2,3,4,5,6,7] 
            }
          },]
          }).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
        }
      });
  }
  function myNisTbh()
    { 
      let nis = $("#nistbh").val();
      $.ajax({
        url: '<?=site_url('admin/majelis_santri/get_biodata')?>',
        type: 'GET',
        dataType: 'json',
        data: {nis: nis},
        success: function(data) {
          $("#jk_tbh").val(data.object.jenis_kelamin);
          $("#angkatan_tbh").val(data.object.nama_angk);
          $("#universitas_tbh").val(data.object.nama_univ);
        },
        error: function (request, status, error) {
          alert('Tidak tersedia');
        }
      })
    }
</script>