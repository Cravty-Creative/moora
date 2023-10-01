<x-layout bodyClass="g-sidenav-show  bg-gray-200">

  <x-navbars.sidebar activePage="karyawan"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-navbars.navs.auth titlePage="Data Karyawan"></x-navbars.navs.auth>
    <!-- End Navbar -->

    <!-- Modal Add Karyawan -->
    <div class="modal fade" id="KaryawanModal" tabindex="-1" role="dialog" aria-labelledby="KaryawanModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-normal" id="KaryawanModalLabel"></h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="container">
              <!-- Required Field -->
              <input type="hidden" id="id_karyawan" name="id_karyawan">
              <h6>Data Utama</h6>
              <div class="d-flex gap-3">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Email *</label>
                  <input type="email" class="form-control" id="email" required>
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Username *</label>
                  <input type="text" class="form-control" id="username" required>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Password *</label>
                  <input type="text" class="form-control" id="password" required>
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Nama Karyawan *</label>
                  <input type="text" class="form-control" id="nama" required>
                </div>
              </div>
              <!-- Optional Field -->
              <h6>Data Optional</h6>
              <div class="d-flex gap-3">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">NIK Karyawan</label>
                  <input type="text" class="form-control" id="nik">
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Jabatan Karyawan</label>
                  <input type="text" class="form-control" id="jabatan">
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Departemen Karyawan</label>
                  <input type="text" class="form-control" id="departemen">
                </div>
              </div>
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
                <h6 class="mx-2 px-2">Filter Data Karyawan</h6>
                <!-- Form Filter -->
                <form class="mx-2 px-2 text-start" action="" method="post" id="report">
                  <div class="row mb-3">
                    <div class="col-md-3 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filternama" class="form-label" style="color: grey !important;">Nama Karyawan</label>
                        <input type="text" class="form-control" name="filternama" id="filternama">
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filternik" class="form-label" style="color: grey !important;">NIK</label>
                        <input type="text" class="form-control" name="filternik" id="filternik">
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filterjabatan" class="form-label" style="color: grey !important;">Jabatan</label>
                        <input type="text" class="form-control" name="filterjabatan" id="filterjabatan">
                      </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                      <div class="input-group input-group-outline">
                        <label for="filterdepartemen" class="form-label" style="color: grey !important;">Departemen</label>
                        <input type="text" class="form-control" name="filterdepartemen" id="filterdepartemen">
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
              <a class="btn bg-gradient-success mb-0" href="javascript:;" id="btn-add-karyawan"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah</a>
            </div>
            <div class="card-body mx-4 my-4 px-2 pb-2">
              <table class="table table table-striped w-100" id="tableKaryawan">
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
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      EMAIL</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      DEPARTEMEN</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      ROLE</th>
                    <th scope="col" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                      CREATION DATE
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
  <script src="{{ asset('assets') }}/js/module/Karyawan.js"></script>
  @endpush
</x-layout>