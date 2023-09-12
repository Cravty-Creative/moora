@props(['activePage'])

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('karyawan') }} ">
      <img src="{{ asset('assets') }}/img/Logo-TanggaraMitrakom.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-2 font-weight-bold text-white">Portal KPI</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Main Menu</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'karyawan' ? 'active bg-gradient-info' : '' }} " href="{{ route('karyawan') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
          </div>
          <span class="nav-link-text ms-1">Karyawan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'penilaian' ? 'active bg-gradient-info' : '' }} " href="{{ route('penilaian') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1.2rem;" class="fas fa-tasks ps-2 pe-2 text-center"></i>
          </div>
          <span class="nav-link-text ms-1">Penilaian</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'ranking' ? 'active bg-gradient-info' : '' }} " href="{{ route('ranking') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1.2rem;" class="fas fa-sort-amount-up-alt ps-2 pe-2 text-center"></i>
          </div>
          <span class="nav-link-text ms-1">Ranking</span>
        </a>
      </li>
    </ul>
  </div>
</aside>