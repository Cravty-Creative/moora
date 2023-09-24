var table;
var operation = "add";
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

$('#PenilaianModal').on('hidden.bs.modal', function () {
  operation = "add";
  // $('#username').val('').parent('.input-group').removeClass('is-filled');
  // $('#email').val('').parent('.input-group').removeClass('is-filled');
  // $('#password').val('').parent('.input-group').removeClass('is-filled');
  // $('#nama').val('').parent('.input-group').removeClass('is-filled');
  // $('#nik').val('').parent('.input-group').removeClass('is-filled');
  // $('#jabatan').val('').parent('.input-group').removeClass('is-filled');
  // $('#departemen').val('').parent('.input-group').removeClass('is-filled');
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
      console.log(data);
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
      console.log(data);
      if (data) {
        let container = $('#penilaian_form_div');
        let formHtml = "";
        data.forEach(kriteria => {
          let h6 = '<h6 id="' + kriteria.kode + '">Nilai ' + kriteria.nama + ' (' + kriteria.kode + ')</h6>';
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
                  '<select class="form-control w-100" id="' + sub_kriteria.kode + '">';
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
  
}