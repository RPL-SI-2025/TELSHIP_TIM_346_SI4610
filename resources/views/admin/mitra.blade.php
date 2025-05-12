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
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan ID, nama perusahaan, atau email..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-danger">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('admin.mitra') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </form>
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
                                            <button class="action-btn edit-btn"
                                                data-id="{{ $mtr->id_perusahaan }}"
                                                data-nama_perusahaan="{{ $mtr->nama_perusahaan }}"
                                                data-email="{{ $mtr->email }}"
                                                data-telepon="{{ $mtr->telepon }}"
                                                data-alamat="{{ $mtr->alamat }}"
                                                data-deskripsi_perusahaan="{{ $mtr->deskripsi_perusahaan }}"
                                                data-link_website="{{ $mtr->link_website }}"
                                                data-bs-toggle="modal"
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="edit-nama_perusahaan" class="form-control" required>
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

    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="addModalLabel">Tambah Mitra</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add-form" method="POST" action="{{ url('admin/mitra/store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="add-nama_perusahaan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-email" class="form-label">Email</label>
                            <input type="email" name="email" id="add-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" id="add-telepon" class="form-control" required>
                        </soaldiv>
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
                            location.reload();
                        }, 1000);
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
        });
    </script>
@endsection