var table;
jQuery(function() {
    
  table = $('#tableRanking').DataTable({
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