<x-layout bodyClass="g-sidenav-show  bg-gray-200">

  <x-navbars.sidebar activePage="penilaian"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-navbars.navs.auth titlePage="Data Penilaian"></x-navbars.navs.auth>
    <!-- End Navbar -->

    <!-- Modal Add Penilaian -->
    <div class="modal fade" id="PenilaianModal" tabindex="-1" role="dialog" aria-labelledby="PenilaianModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-normal" id="PenilaianModalLabel"></h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="container">
              <!-- Karyawan -->
              <input type="hidden" id="id_karyawan" name="id_karyawan">
              <h6>Pilih Karyawan dan Periode</h6>
              <div class="d-flex gap-3">
                <div class="input-group input-group-outline my-3 flex-column">
                  <label class="ms-0">Karyawan *</label>
                  <select class="form-control w-100" id="karyawan">
                    <option value="">Pilih Karyawan</option>
                  </select>
                </div>
                <div class="input-group input-group-outline my-3 flex-column">
                  <label class="ms-0">Periode Bulan *</label>
                  <select class="form-control w-100" id="bulan">
                    <option value="">Pilih Bulan</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="July">July</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                  </select>
                </div>
                <div class="input-group input-group-outline my-3 flex-column">
                  <label class="ms-0">Periode Tahun *</label>
                  <input type="tel" class="form-control w-100" id="tahun" placeholder="2023" required>
                </div>
              </div>
              <!-- Penilaian -->
              <div id="penilaian_form_div"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn bg-gradient-info" id="btn-save" onclick="SaveChanges()">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Card Table -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <!-- Header Filter -->
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-white shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="mx-2 px-2">Filter Data Nilai Karyawan</h6>
                <!-- Form Filter -->
                <form class="mx-2 px-2 text-start" action="" method="post" id="report">
                  <div class="row mb-3">
                    <div class="col-md-3 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filternama" class="form-label" style="color: grey !important;">Nama Karyawan</label>
                        <input type="text" class="form-control" name="filternama" id="filternama">
                      </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filterdepartemen" class="form-label" style="color: grey !important;">Departemen</label>
                        <input type="text" class="form-control" name="filterdepartemen" id="filterdepartemen">
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="input-group input-group-outline">
                        <select class="form-control" name="filterbulan" id="filterbulan">
                          <option value="">Pilih Periode Bulan</option>
                          <option value="Januari">Januari</option>
                          <option value="Februari">Februari</option>
                          <option value="Maret">Maret</option>
                          <option value="April">April</option>
                          <option value="Mei">Mei</option>
                          <option value="Juni">Juni</option>
                          <option value="July">July</option>
                          <option value="Agustus">Agustus</option>
                          <option value="September">September</option>
                          <option value="Oktober">Oktober</option>
                          <option value="November">November</option>
                          <option value="Desember">Desember</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filtertahun" class="form-label" style="color: grey !important;">Tahun</label>
                        <input type="tel" class="form-control w-100" id="filtertahun" required>
                      </div>
                    </div>
                    <div class="col-md-1 col-xs-12 my-auto">
                      <button id="submit" type="submit" class="btn bg-gradient-info text-white form-control" style="margin-bottom: 0;">Cari</button>
                    </div>
                  </div>
                </form>
                <!-- / Form -->
              </div>
            </div>
            <!-- / Header Filter -->
            <div class=" me-3 my-3 text-end">
              <a class="btn bg-gradient-success mb-0" href="javascript:;" id="btn-add-penilaian"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah</a>
            </div>
            <div class="card-body mx-4 my-4 px-2 pb-2">
              <table class="table table table-striped w-100" id="tablePenilaian">
                <thead>
                  <tr>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      NO
                    </th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      ID
                    </th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                      NAMA</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                      DEPARTEMEN</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      NILAI C1</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      NILAI C2</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      NILAI C3
                    </th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      NILAI C4
                    </th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      ACTION
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Body table di generate oleh DataTable -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <x-footers.auth></x-footers.auth>
    </div>
  </main>
  <x-plugins></x-plugins>
  @push('js')
  <script src="{{ asset('assets') }}/js/module/Penilaian.js"></script>
  @endpush
</x-layout>