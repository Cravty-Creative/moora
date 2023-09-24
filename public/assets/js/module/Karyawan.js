var table;
var operation = "add";
jQuery(function() {
    
  table = $('#tableKaryawan').DataTable({
    // "responsive": true,
    "processing": true,
    "paging": true,
    "scrollX": true,
    "lengthMenu": [
      [10, 25, 50, -1],
      ['10', '25', '50', 'All']
    ],
    "language": {
      "paginate": {
        "previous": '<i class="fas fa-chevron-left"></i>',
        "next": '<i class="fas fa-chevron-right"></i>'
      }
    },
    "columnDefs": [{
      "orderable": false,
      "targets": 5
    }, ],
    "ajax": {
      "url": $('meta[name="route"]').attr('content') + "/karyawanDT",
      "headers": {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      "type": "GET",
      "contentType": "application/json"
    }
  });
  table.rows({
    page: 'all'
  }).data();

  $('#KaryawanModal').modal({
    backdrop: 'static',
    keyboard: false
  });

  $("#report").on('submit', function (e) {
    e.preventDefault();
    let filter = [];
    if ($('#filternama').val()) filter.push("nama=" + $('#filternama').val());
    if ($('#filternik').val()) filter.push("nik=" + $('#filternik').val());
    if ($('#filterjabatan').val()) filter.push("jabatan=" + $('#filterjabatan').val());
    if ($('#filterdepartemen').val()) filter.push("departemen=" + $('#filterdepartemen').val());
    let params = filter.join('&');
    let url = $('meta[name="route"]').attr('content') + "/karyawanDT?" + params;
    generateTable(url);
  });
});

function ReloadTable() {
  table.ajax.reload(null, false);
}

function generateTable(url) {
  table.ajax.url(url).load(); 
}

$('#KaryawanModal').on('hidden.bs.modal', function () {
  operation = "add";
  $('#username').val('').parent('.input-group').removeClass('is-filled');
  $('#email').val('').parent('.input-group').removeClass('is-filled');
  $('#password').val('').parent('.input-group').removeClass('is-filled');
  $('#nama').val('').parent('.input-group').removeClass('is-filled');
  $('#nik').val('').parent('.input-group').removeClass('is-filled');
  $('#jabatan').val('').parent('.input-group').removeClass('is-filled');
  $('#departemen').val('').parent('.input-group').removeClass('is-filled');
});

$('#btn-add-karyawan').on('click', function(e) {
  e.preventDefault();
  $('#KaryawanModalLabel').text('Input Data Karyawan');
  $('#KaryawanModal').modal('show');
});

function SaveChanges() {
  $('#btn-save').text('Please wait...');
  $('#btn-save').prop('disabled', true);

  let id = 0;
  let editUrl = "";
  if (operation == "edit") {
    id = parseInt($('#id_karyawan').val());
    editUrl = "/" + id;
  }
  let formData = new FormData();

  formData.append('username', $('#username').val());
  formData.append('email', $('#email').val());
  formData.append('password', $('#password').val());
  formData.append('nama', $('#nama').val());
  formData.append('nik', $('#nik').val());
  formData.append('jabatan', $('#jabatan').val());
  formData.append('departemen', $('#departemen').val());

  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url:  "/karyawan" + editUrl,
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        if (data && data.code == 200) {
          ReloadTable();
          $('#KaryawanModal').modal('hide');
          swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: data.message,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
          });
        } else {
          swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: data.message,
            showConfirmButton: false,
          });
        }
      },
      error: function() {
        swal.fire({
          icon: 'error',
          title: 'Internal Server Error',
          text: "Ouch, sistemnya lagi error...",
          showConfirmButton: false,
        });
      },
      complete: function() {
        $('#btn-save').text('Save Changes');
        $('#btn-save').prop('disabled', false);
      }
  });
}

function ShowDetail(obj) {
  operation = "edit";
  let id = parseInt(obj.attributes.data_id.value);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "GET",
    url: "/karyawan/" + id,
    contentType: "application/json",
    success: function(data) {
      console.log(data);
      if (!data.code) {
        $('#id_karyawan').val(data.id);
        $('#email').val(data.user.email);
        $('#email').parent('.input-group').addClass('is-filled');
        $('#username').val(data.user.username);
        $('#username').parent('.input-group').addClass('is-filled');
        $('#nama').val(data.nama);
        $('#nama').parent('.input-group').addClass('is-filled');
        $('#nik').val(data.nik);
        $('#nik').parent('.input-group').addClass('is-filled');
        $('#jabatan').val(data.jabatan);
        $('#jabatan').parent('.input-group').addClass('is-filled');
        $('#departemen').val(data.departemen);
        $('#departemen').parent('.input-group').addClass('is-filled');
        $('#KaryawanModal').modal('show');
      } else {
        swal.fire({
          icon: 'error',
          title: 'No Data',
          text: 'Gagal memuat data',
          showConfirmButton: false,
        });
      }
    },
    error: function() {
      swal.fire({
        icon: 'error',
        title: 'Internal Server Error',
        text: "Ouch, sistemnya lagi error...",
        showConfirmButton: false,
      });
    }
  });
}

function Delete(obj) {
  let id = parseInt(obj.attributes.data_id.value);
  swal.fire({
    title: 'Hapus Data Karyawan',
    text: "Apakah Anda yakin ingin menghapus data ini?",
    icon: 'warning',
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: "/karyawan/" + id,
        contentType: "application/json",
        success: function(data) {
          if (data && data.code == 200) {
            ReloadTable();
            swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: data.message,
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true
            });
          } else {
            swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: data.message,
              showConfirmButton: false,
            });
          }
        },
        error: function() {
          swal.fire({
            icon: 'error',
            title: 'Internal Server Error',
            text: "Ouch, sistemnya lagi error...",
            showConfirmButton: false,
          });
        }
      });
    }
  });
}