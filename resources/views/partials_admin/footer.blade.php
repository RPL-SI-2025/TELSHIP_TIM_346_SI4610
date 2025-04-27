<!-- Footer -->

<style>
    /* Footer Styling */
    .footer {
        background-color: #B2181C;
        /* Warna merah footer */
        color: white;
        text-align: center;
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    /* Container untuk semua elemen */
    .footer-container {
        max-width: 600px;
        margin: 0 auto;
    }

    /* Logo */
    .logo {
        width: 120px;
        margin-bottom: 15px;
    }

    /* Judul */
    .title {
        font-size: 18px;
        font-weight: bold;
        color: white;
        /* Warna putih */
        margin-bottom: 20px;
    }


    /* Form Subscribe */
    .subscribe {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    /* Input Email */
    .email-input {
        width: 250px;
        padding: 10px 15px;
        border-radius: 20px;
        border: 1px solid #ddd;
        outline: none;
    }

    /* Tombol Kirim */
    .send-button {
        background-color: #D32F2F;
        /* Warna merah gelap */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: bold;
    }

    .send-button:hover {
        background-color: #A21616;
    }

    /* Copyright */
    .copyright {
        font-size: 14px;
        opacity: 0.8;
    }

    /* Ornamen */
    .ornamen {
        position: absolute;
        top: 0;
        height: 100%;
        width: auto;
    }

    .ornamen-left {
        left: 0;
    }

    .ornamen-right {
        right: 0;
    }
</style>

<footer class="footer">
    <div class="footer-container">
        <!-- Logo -->
        <img src="{{ asset('assets/images/ft1.svg') }}" alt="Telship" class="logo">

        <!-- Text -->

        <!-- Copyright -->
        <p class="copyright">&copy; 2025 Telship. Seluruh Hak Cipta Dilindungi.</p>
    </div>

    <!-- Ornamen Kiri & Kanan -->
    <img src="{{ asset('assets/images/ft2.svg') }}" class="ornamen ornamen-left">
    <img src="{{ asset('assets/images/ft3.svg') }}" class="ornamen ornamen-right">
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->
<!-- </div> -->

<!--/ Layout container -->
</div>
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>

<!--/ Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ url('app-assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ url('app-assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/node-waves/node-waves.js') }}"></script>

<script src="{{ url('app-assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<script src="{{ url('app-assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ url('app-assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/dropzone/dropzone.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/pickr/pickr.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/tagify/tagify.js') }}"></script>

<!-- Main JS -->
<script src="{{ url('app-assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ url('app-assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ url('app-assets/js/forms-selects.js') }}"></script>
<script src="{{ url('app-assets/js/forms-tagify.js') }}"></script>
<script src="{{ url('app-assets/js/form-wizard-numbered.js') }}"></script>
<script src="{{ url('app-assets/js/form-wizard-validation.js') }}"></script>
<script src="{{ url('app-assets/js/form-wizard-icons.js') }}"></script>
<script src="{{ url('app-assets/js/ui-carousel.js') }}"></script>
<script src="{{ url('app-assets/js/forms-file-upload.js') }}"></script>
<script src="{{ url('app-assets/js/forms-pickers.js') }}"></script>
<script src="{{ url('js/content.js') }}"></script>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>

@yield('page_script')
</body>

</html>
