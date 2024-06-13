<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon col-1">
                        <i class="fas fa-home"></i>
                    </div>
                    <b>Dashboard</b>
                </a>
                {{-- Dropdown Master Data --}}
                <a href="#" class="nav-link collapsed {{ Request::is('dashboard/data/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#masterDataCollapse" aria-expanded="false">
                    <div class="sb-nav-link-icon col-1">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <b>Master Data</b>
                    <i class="fas fa-caret-down ms-auto"></i>
                </a>
                <div class="collapse {{ Request::is('dashboard/data/*') ? 'show' : '' }}" id="masterDataCollapse"
                    data-bs-parent="#sidenavAccordion">
                    <a class="nav-link {{ Request::is('dashboard/data/kriteria*') ? 'active' : '' }} child"
                        href="{{ route('kriteria.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Data Kriteria
                    </a>
                    <a class="nav-link {{ Request::is('dashboard/data/siswa*') ? 'active' : '' }} child"
                        href="{{ route('siswa.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Data Siswa
                    </a>
                    <a class="nav-link {{ Request::is('dashboard/data/kelas*') ? 'active' : '' }} child"
                        href="{{ route('kelas.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Data Kelas
                    </a>
                    <a class="nav-link {{ Request::is('dashboard/data/alternatif*') ? 'active' : '' }} child"
                        href="{{ route('alternatif.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Data Alternatif
                    </a>
                </div>


                {{-- Dropdown Master SPK --}}
                <a href="#" class="nav-link collapsed {{ Request::is('dashboard/perhitungan*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#masterDataCollapse2" aria-expanded="false">
                    <div class="sb-nav-link-icon col-1">
                        <i class="fas fa-ranking-star"></i>
                    </div>
                    <b>Master SPK</b>
                    <i class="fas fa-caret-down ms-auto"></i>
                </a>
                <div class="collapse {{ Request::is('dashboard/perhitungan*') ? 'show' : '' }}" id="masterDataCollapse2"
                    data-bs-parent="#sidenavAccordion">
                    <a class="nav-link {{ Request::is('dashboard/perhitungan/metode*') ? 'active' : '' }} child"
                        href="{{ route('kombinasi.awal') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Metode SPK
                    </a>
                    @can('admin')
                    <a class="nav-link {{ Request::is('dashboard/perhitungan/setting*') ? 'active' : '' }} child"
                        href="{{ route('kombinasi.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Data Perhitungan
                    </a>
                    
                    
                    
                    @endcan
                </div>

                {{-- Dropdown Master Pengguna --}}
                <a href="#" class="nav-link collapsed {{ Request::is('dashboard/pengguna*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#masterDataCollapse3" aria-expanded="false">
                    <div class="sb-nav-link-icon col-1">
                        <i class="fas fa-user-gear"></i>
                    </div>
                    <b>Master Pengguna</b>
                    <i class="fas fa-caret-down ms-auto"></i>
                </a>
                <div class="collapse {{ Request::is('dashboard/pengguna*') ? 'show' : '' }}" id="masterDataCollapse3"
                    data-bs-parent="#sidenavAccordion">
                    @can('admin')
                    <a class="nav-link {{ Request::is('dashboard/pengguna/users*') ? 'active' : '' }} child"
                        href="{{ route('users.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Data Pengguna
                    </a>
                    @endcan
                    <a class="nav-link {{ Request::is('dashboard/pengguna/profile*') ? 'active' : '' }} child"
                        href="{{ route('profile.index') }}">
                        <div class="sb-nav-link-icon col-1">
                            <i class="fas"></i>
                        </div>
                        Ubah Profil
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
<style>
    .nav-link {
        margin: 0px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .nav-link.active {
        background-color: grey;
    }
    .nav-link.active.child {
        background-color: #343a40;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Keep the active collapse section open
        const urlParams = new URLSearchParams(window.location.search);
        const activeCollapse = urlParams.get('collapse');
        if (activeCollapse) {
            const collapseElement = document.getElementById(activeCollapse);
            if (collapseElement) {
                const bsCollapse = new bootstrap.Collapse(collapseElement);
                bsCollapse.show();
            }
        }
    });
</script>