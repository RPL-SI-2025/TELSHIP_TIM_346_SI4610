@extends('partials_admin.template')
 
@section('main')
    <style>
        body {
            background-color: white !important;
        }
 
        .table-container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
 
        .action-btn {
            padding: 5px 10px;
            border: none;
            background: transparent;
            cursor: pointer;
        }
 
        .edit-btn {
            color: #007bff;
        }
 
        .delete-btn {
            color: #dc3545;
        }
 
        .table th {
            background-color: #f1f1f1;
            font-weight: 600;
        }
 
        .add-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
 
        .alert {
            margin: 20px;
        }
    </style>
 
    <div class="d-flex" style="min-height: 100vh">
        <div class="flex-grow-1">
            <!-- Banner -->
            <div class="position-relative text-white"
                style="background: linear-gradient(to right, #EC1D24, #A71318); padding-top: 8rem; padding-bottom: 2rem;">
                <h1 class="fw-bold p-4 text-white">PENGGUNA</h1>
                <img src="{{ asset('assets/images/ft3.svg') }}" alt="Banner" class="position-absolute end-0 top-0 h-100">
            </div>
 
            <div class="d-flex gap-2 mt-1 p-4 justify-content-between align-items-center">
                <!-- Menu Box di Pojok Kiri -->
                <div class="d-flex gap-2">
                    <a href="{{ url('admin/pengguna') }}" class="btn btn-outline-secondary text-muted">MAHASISWA</a>
                    <a href="{{ url('admin/mentor') }}" class="btn btn-outline-secondary text-muted">MENTOR</a>
                    <a class="btn fw-semibold" href="{{ url('admin/mitra') }}"
                        style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">MITRA</a>
                </div>
 
                <!-- Add Mitra Button di Pojok Kanan -->
                <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">Tambahkan Mitra</button>
            </div>
            <!-- Success or Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
 
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
 
            <!-- Data Table Section -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">Tambahkan Mitra</button>
                    </div>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.mitra') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan ID, nama perusahaan, atau email..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-danger">Cari</button>
                            @if (request('search'))
                                <a href="{{ route('admin.mitra') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </form>
                        <a href="{{ route('admin.excel.export') }}" class="btn"
                            style="background-color:#EC1D24; color: white;">
                            <i class="fas fa-file-excel me-2"></i> Export Excel
                        </a>
                        <button type="button" style="background-color:#EC1D24; color: white;" class="btn"
                            data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="fas fa-file-excel me-2"></i> Import Excel
                        </button>
                    </div>
                </div>
 
                <div class="table-responsive">
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                                <th>ID Perusahaan</th>
                                <th>Nama Perusahaan</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mitra as $mtr)
                                <tr>
                                    <td>{{ $mtr->id_perusahaan }}</td>
                                    <td>{{ $mtr->nama_perusahaan }}</td>
                                    <td>{{ $mtr->email }}</td>
                                    <td>{{ $mtr->telepon }}</td>
                                    <td>{{ $mtr->alamat }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="action-btn edit-btn" data-id="{{ $mtr->id_perusahaan }}"
                                                data-nama_perusahaan="{{ $mtr->nama_perusahaan }}"
                                                data-email="{{ $mtr->email }}" data-telepon="{{ $mtr->telepon }}"
                                                data-alamat="{{ $mtr->alamat }}"
                                                data-deskripsi_perusahaan="{{ $mtr->deskripsi_perusahaan }}"
                                                data-link_website="{{ $mtr->link_website }}" data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
 
                                            <!-- <form action="{{ url('admin/mitra/delete/' . $mtr->id_perusahaan) }}" method="POST">
                                                                                                                                                                        @csrf
                                                                                                                                                                        @method('DELETE')
                                                                                                                                                                        <button type="submit" class="action-btn delete-btn"
                                                                                                                                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                                                                                                                            <i class="fas fa-trash"></i>
                                                                                                                                                                        </button>
                                                                                                                                                                    </form> -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
 
                            @if (count($mitra) == 0)
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data mitra</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
 
                <!-- Pagination -->
                <nav>
                    {{ $mitra->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
 
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Mitra</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="edit-nama_perusahaan" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" id="edit-telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" id="edit-alamat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-deskripsi_perusahaan" class="form-label">Deskripsi Perusahaan</label>
                            <textarea name="deskripsi_perusahaan" id="edit-deskripsi_perusahaan" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-link_website" class="form-label">Link Website</label>
                            <input type="url" name="link_website" id="edit-link_website" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Button to Download Template -->
                    <a href="{{ route('admin.template.download') }}" class="btn btn-success mb-3">Download Template</a>
 
                    <!-- Form for Importing Excel -->
                    <form id="importForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file_excel" class="form-label">Pilih File Excel</label>
                            <input type="file" name="file_excel" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-danger">Import Excel</button>
                    </form>
 
                    <!-- Result Section (Initially Hidden) -->
                    <div id="importResult" class="mt-3" style="display: none;">
                        <div class="alert" id="importAlert">
                            <div id="importMessage"></div>
                        </div>
 
                        <!-- Error Details Section -->
                        <div id="errorDetails" style="display: none;">
                            <h6 class="mt-3">Detail Error:</h6>
                            <div class="accordion" id="errorAccordion">
                                <!-- Error items will be inserted here dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Result Modal for showing import progress -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Hasil Import</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resultModalBody">
                    <!-- Result content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="addModalLabel">Tambah Mitra</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="add-form" method="POST" action="{{ url('admin/mitra/store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="add-nama_perusahaan" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="add-email" class="form-label">Email</label>
                            <input type="email" name="email" id="add-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" id="add-telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" id="add-alamat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-deskripsi_perusahaan" class="form-label">Deskripsi Perusahaan</label>
                            <textarea name="deskripsi_perusahaan" id="add-deskripsi_perusahaan" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="add-link_website" class="form-label">Link Website</label>
                            <input type="url" name="link_website" id="add-link_website" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Tambah Mitra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Notifikasi Sukses -->
 
    <div class="modal fade" id="successAddedModal" tabindex="-1" aria-labelledby="successAddedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow p-4 text-center"
                style="border: none; max-width: 450px; margin: 0 auto;">
                <div class="modal-body p-0">
                    <!-- Gambar dengan lingkaran merah muda di belakangnya -->
                    <div class="position-relative mb-4" style="width: 200px; height: 150px; margin: 0 auto;">
                        <div class="position-absolute top-0 start-50 translate-middle-x"
                            style="width: 160px; height: 160px; background-color: #FFDDDD; border-radius: 50%; z-index: 0; margin-top: 20px;">
                        </div>
                        <img src="{{ asset('assets/images/OBJECTS.svg') }}" alt="Sukses" class="position-relative"
                            style="width: 180px; max-width: 100%; z-index: 1;">
                    </div>
 
                    <!-- Teks informasi -->
                    <h2 class="fw-bold text-dark fs-4 mb-2">ID Perusahaan Telah Ditambahkan!</h2>
                    <p class="text-muted small mb-4">
                        ID Perusahaan Baru Telah Ditambahkan, Mentor Bisa Menggunakan ID Ini Untuk Mendaftar
                    </p>
 
                    <!-- Tombol berwarna merah dengan sudut melengkung -->
                    <button type="button" class="btn btn-danger w-100 py-2 rounded-pill" data-bs-dismiss="modal"
                        style="background-color: #E61E26; border: none; font-weight: 500;">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
 
 
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var nama_perusahaan = $(this).data('nama_perusahaan');
                var email = $(this).data('email');
                var telepon = $(this).data('telepon');
                var alamat = $(this).data('alamat');
                var deskripsi_perusahaan = $(this).data('deskripsi_perusahaan');
                var link_website = $(this).data('link_website');
 
                $('#edit-nama_perusahaan').val(nama_perusahaan);
                $('#edit-email').val(email);
                $('#edit-telepon').val(telepon);
                $('#edit-alamat').val(alamat);
                $('#edit-deskripsi_perusahaan').val(deskripsi_perusahaan);
                $('#edit-link_website').val(link_website);
 
                $('#edit-form').attr('action', '/admin/mitra/update/' + id);
            });
 
            $('#edit-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = form.serialize();
                var actionUrl = form.attr('action');
 
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        $('#editModal').modal('hide');
                        showAlert('success', 'Data mitra berhasil diperbarui.');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = 'Gagal memperbarui data.';
                        if (errors) {
                            errorMessage = Object.values(errors).join('<br>');
                        }
                        showAlert('danger', errorMessage);
                    }
                });
            });
 
            // Script untuk add
            $('#add-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = form.serialize();
                var actionUrl = form.attr('action');
 
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        $('#addModal').modal('hide');
                        showAlert('success', 'Data mitra berhasil ditambahkan.');
                        setTimeout(function() {
                            $('#successAddedModal').modal('show');
                        }, 500);
                        refreshTable();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = 'Gagal menambahkan data.';
                        if (errors) {
                            errorMessage = Object.values(errors).join('<br>');
                        }
                        showAlert('danger', errorMessage);
                    }
                });
            });
 
            function showAlert(type, message) {
                var alertHtml = '<div class="alert alert-' + type +
                    ' alert-dismissible fade show mt-2" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
 
                $('.table-container').before(alertHtml);
 
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 4000);
            }
            $('#addModal').on('hidden.bs.modal', function() {
                $('#add-form')[0].reset();
            });
            $('#successAddedModal').on('hidden.bs.modal', function() {
                location.reload();
            });
        });
 
        $(document).ready(function() {
            $('#importForm').on('submit', function(e) {
                e.preventDefault();
 
                // Show loading indicator
                $('#importResult').hide();
                $('#importMessage').html(
                    '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );
                $('#importResult').show();
 
                let formData = new FormData(this);
 
                $.ajax({
                    url: "{{ route('admin.excel.import') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success
                        $('#importAlert').removeClass('alert-danger').addClass(
                            'alert-success');
                        $('#importMessage').html(
                            `<strong>Sukses!</strong> ${response.imported} data mitra berhasil diimport.`
                        );
                        $('#errorDetails').hide();
 
                        // Reset form
                        $('#importForm')[0].reset();
                    },
                    error: function(xhr) {
                        // Handle error
                        let response = xhr.responseJSON;
 
                        if (response && response.status === 'partial_success') {
                            $('#importAlert').removeClass('alert-success').addClass(
                                'alert-warning');
                            $('#importMessage').html(
                                `<strong>Hasil :</strong> ${response.imported} data diimport, ada beberapa error.`
                            );
 
                            // Display errors in accordion
                            let errorHtml = '';
                            response.errors.forEach((item, index) => {
                                errorHtml += `
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading${index}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
                                    Error pada baris ${item.row}
                                </button>
                            </h2>
                            <div id="collapse${index}" class="accordion-collapse collapse" aria-labelledby="heading${index}" data-bs-parent="#errorAccordion">
                                <div class="accordion-body">
                                    <strong>Error:</strong>
                                    <ul>
                                        ${item.errors.map(err => `<li>${err}</li>`).join('')}
                                    </ul>
                                    <strong>Data:</strong>
                                    <ul>
                                        <li>Nama Perusahaan: ${item.data.nama_perusahaan || '-'}</li>
                                        <li>Deskripsi: ${item.data.deskripsi_perusahaan || '-'}</li>
                                        <li>Alamat: ${item.data.alamat || '-'}</li>
                                        <li>Email: ${item.data.email || '-'}</li>
                                        <li>Telepon: ${item.data.telepon || '-'}</li>
                                        <li>Website: ${item.data.link_website || '-'}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        `;
                            });
 
                            $('#errorAccordion').html(errorHtml);
                            $('#errorDetails').show();
                        } else {
                            $('#importAlert').removeClass('alert-success').addClass(
                                'alert-danger');
                            $('#importMessage').html(
                                '<strong>Error!</strong> Terjadi kesalahan saat mengimpor data.'
                            );
                            $('#errorDetails').hide();
                        }
 
                        // Reset form
                        $('#importForm')[0].reset();
                    }
                });
            });
        });
    </script>
@endsection