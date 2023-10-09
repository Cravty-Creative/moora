var table;
var operation = "add";
var kriteria;
jQuery(function() {
  table = $('#tablePenilaian').DataTable({
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
      "url": $('meta[name="route"]').attr('content') + "/penilaianDT",
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

  $('#PenilaianModal').modal({
    backdrop: 'static',
    keyboard: false
  });

  RenderSelectKaryawan();
  RenderFormNilai();

  $("#report").on('submit', function (e) {
    e.preventDefault();
    let filter = [];
    if ($('#filternama').val()) filter.push("nama=" + $('#filternama').val());
    if ($('#filterbulan').val()) filter.push("bulan=" + $('#filterbulan').val());
    if ($('#filtertahun').val()) filter.push("tahun=" + $('#filtertahun').val());
    if ($('#filterdepartemen').val()) filter.push("departemen=" + $('#filterdepartemen').val());
    let params = filter.join('&');
    let url = $('meta[name="route"]').attr('content') + "/penilaianDT?" + params;
    generateTable(url);
  });
});

function ReloadTable() {
  table.ajax.reload(null, false);
}

function generateTable(url) {
  table.ajax.url(url).load(); 
}

$('#PenilaianModal').on('hidden.bs.modal', function () {
  operation = "add";
  $('#karyawan').attr('disabled', false);
  $('#bulan').attr('disabled', false);
  $('#tahun').attr('disabled', false);
  $('#karyawan').val('');
  $('#bulan').val('');
  $('#tahun').val('');
  kriteria.forEach(item => {
    item.sub_kriteria.forEach(sub => {
      let select = $('#' + sub.kode.replace(".", "_"));
      select.val('50');
    });
  });
});

$('#btn-add-penilaian').on('click', function(e) {
  e.preventDefault();
  $('#PenilaianModalLabel').text('Input Nilai Karyawan');
  $('#PenilaianModal').modal('show');
});

function RenderSelectKaryawan() {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "GET",
    url: "/karyawanall",
    contentType: "application/json",
    success: function(data) {
      // console.log(data);
      if (data) {
        let select = $('#karyawan');
        let option = "";
        data.forEach(e => {
          option += '<option value="' + e.user_id + '">' + e.nama + ' (' + e.kode + ')</option>';
        });
        select.append(option);
      }
    },
    error: function() {
      swal.fire({
        icon: 'error',
        title: 'Internal Server Error',
        text: "Gagal render form penilaian",
        showConfirmButton: false,
      });
    }
  });
}

function RenderFormNilai() {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "GET",
    url: "/kriteriawithsubpoin",
    contentType: "application/json",
    success: function(data) {
      // console.log(data);
      if (data) {
        kriteria = data;
        let container = $('#penilaian_form_div');
        let formHtml = "";
        data.forEach(kriteria => {
          let h6 = '<h6>Nilai ' + kriteria.nama + ' (' + kriteria.kode + ')</h6>';
          let inputs = '<div class="d-flex gap-3">';
          let elem = 1;
          kriteria.sub_kriteria.forEach(sub_kriteria => {
            if (elem > 3) {
              inputs += '</div>';
              inputs += '<div class="d-flex gap-3">';
              elem = 1;
            }
            let input_sub = '<div class="input-group input-group-outline my-3 flex-column">' +
                  '<label class"form-label ms-0">' + sub_kriteria.nama + ' (' + sub_kriteria.kode + ') *</label>' +
                  '<select class="form-control w-100" id="' + sub_kriteria.kode.replace('.', '_') + '">';
            sub_kriteria.poin.forEach(poin => {
              let option = '<option value="' + poin.poin +'">' + poin.keterangan + '</option>';
              input_sub += option;
            });
            input_sub += '</select></div>';
            inputs += input_sub;
            elem++;
          });
          inputs += '</div>';
          formHtml += (h6 + inputs);
        });
        container.html(formHtml);
      }
    },
    error: function() {
      swal.fire({
        icon: 'error',
        title: 'Internal Server Error',
        text: "Gagal render form penilaian",
        showConfirmButton: false,
      });
    }
  });
}

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
  formData.append('user_id', $('#karyawan').val());
  formData.append('bulan', $('#bulan').val());
  formData.append('tahun', $('#tahun').val());

  kriteria.forEach(item => {
    formData.append(item.kode + "_id", item.id);
    item.sub_kriteria.forEach(sub => {
      let select = $('#' + sub.kode.replace(".", "_"));
      // console.log('#' + sub.kode.replace(".", "_"));
      // console.log(select.val());
      formData.append(sub.kode.replace('.', '_') + "_id", sub.id);
      formData.append(sub.kode.replace('.', '_') + "_nilai", select.val());
    });
    formData.append(item.kode + "_length", item.sub_kriteria.length);
  });

  // Debug
  console.log(kriteria);
  ShowFormDataEntries(formData);

  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url:  "/penilaian" + editUrl,
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        if (data && data.code == 200) {
          ReloadTable();
          $('#PenilaianModal').modal('hide');
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
  $('#PenilaianModalLabel').text('Edit Nilai Karyawan');
  let id = parseInt(obj.attributes.data_id.value);
  let periode = obj.attributes.data_periode.value;
  let data = { "id": id, "periode": periode };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: "/showpenilaian",
    contentType: "application/json",
    data: JSON.stringify(data),
    success: function(data) {
      console.log(data);
      if (!data.code) {
        $('#id_karyawan').val(data.karyawan.id);
        $('#karyawan').val(data.karyawan.user_id);
        const fullPeriode = data.penilaian[0].periode.split(" ");
        let periode = fullPeriode[0];
        let tahun = fullPeriode[1];
        $('#bulan').val(periode);
        $('#tahun').val(tahun);
        let i = 1;
        data.penilaian.forEach(item => {
          let j = 1;
          item.sub_penilaian.forEach(sub => {
            $('#C' + i + "_" + j).val(sub.nilai);
            j++;
          });
          i++;
        });
        $('#karyawan').attr('disabled', true);
        $('#bulan').attr('disabled', true);
        $('#tahun').attr('disabled', true);
        $('#PenilaianModal').modal('show');
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
  let periode = obj.attributes.data_periode.value;
  swal.fire({
    title: 'Hapus Data Penilaian Karyawan',
    text: "Apakah Anda yakin ingin menghapus data nilai karyawan ini pada periode " +  periode + "?",
    icon: 'warning',
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      let formData = new FormData();
      formData.append('id_karyawan', id);
      formData.append('periode', periode);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/deletepenilaian",
        data: formData,
        processData: false,
        contentType: false,
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