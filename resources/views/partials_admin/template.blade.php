@include('partials_admin.header')
<body>
    <div class="d-flex"> <!-- Ini untuk flex container -->
        
        <!-- Sidebar -->
        <div class="d-flex flex-nowrap" style="width: 250px; height: 100vh;">
            @include('partials_admin.sidebar_admin') <!-- Atau sidebar menu kamu -->
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            @yield('main') <!-- Ini yang nanti muncul konten approval lowongan -->
        </div>

    </div>
</body>
