<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('dashboard.index') }}">
        
        {{ auth()->user()->level }}
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <?php
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false || strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false){}else{?>
        {{-- Jam --}}
        <div class="text-white" style="font-family: 'Times New Roman', Times, serif">
            <?php
                date_default_timezone_set("Asia/Jakarta");
                $namaHari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
                $indeksHari = date('w');
                $tanggal = date('d/m/y');
                $jam = date('H:i:s');
            ?>
            {{ $namaHari[$indeksHari] }}, {{ $tanggal }} || <span id="jam" style="font-size:24"></span>
            <script type="text/javascript">
                window.onload = function () {
                    jam();
                }
                function jam() {
                    var e = document.getElementById('jam'),
                        d = new Date(),
                        h, m, s;
                    h = d.getHours();
                    m = set(d.getMinutes());
                    s = set(d.getSeconds());
                    e.innerHTML = h + ':' + m + ':' + s;
                    setTimeout('jam()', 1000);
                }
                function set(e) {
                    e = e < 10 ? '0' + e : e;
                    return e;
                }
            </script>
        </div>
    <?php } ?>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <span class="mr-2 d-none d-lg-inline text-white small">
            {{ auth()->user()->name }}
        </span>
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item btnLogout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>