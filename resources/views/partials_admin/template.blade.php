@include('partials_admin.header')

<div class="d-flex">
    <!-- Sidebar -->
    <div style="width: 250px; height: 100vh;">
    <!-- isi sidebar -->
    @include('partials_admin.sidebar_admin')
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4" style="background-color: #f8f9fa;"> <!-- kasih padding biar ga mepet -->
        @yield('main')
    </div>
</div>
