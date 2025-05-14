@extends('partials_admin.template')

@section('main')
    <style>
        /* Tetap gunakan CSS styling dari mahasiswa */
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
                    <a class="btn fw-semibold" href="{{ url('admin/mentor') }}"
                        style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">MENTOR</a>
                    <a href="{{ url('admin/mitra') }}" class="btn btn-outline-secondary text-muted">MITRA</a>
                </div>

                <!-- Add Mentor Button di Pojok Kanan -->
                <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">Tambahkan Mentor</button>
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
                        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">Tambahkan Mentor</button>
                    </div>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.mentor') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan ID, nama, atau email..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-danger">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('admin.mentor') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                                <th>ID Mentor</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>ID Perusahaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usermentor as $mnt)
                                <tr>
                                    <td>{{ $mnt->id_mentor }}</td>
                                    <td>{{ $mnt->nama_lengkap }}</td>
                                    <td>{{ $mnt->email }}</td>
                                    <td>{{ $mnt->id_perusahaan }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="action-btn edit-btn"
                                                data-id="{{ $mnt->user_id }}"
                                                data-nama_lengkap="{{ $mnt->nama_lengkap }}"
                                                data-email="{{ $mnt->email }}"
                                                data-id_perusahaan="{{ $mnt->id_perusahaan }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- <form action="{{ url('admin/mentor/delete/' . $mnt->id_mentor) }}" method="POST">
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

                            @if (count($usermentor) == 0)
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data mentor</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav>
                    {{ $usermentor->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Mentor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="edit-nama_lengkap" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-id_perusahaan" class="form-label">Nama Perusahaan</label>
                            <select name="id_perusahaan" id="edit-id_perusahaan" class="form-control" required>
                                <option value="">Pilih Perusahaan</option>
                                @foreach ($mitra as $m)
                                    <option value="{{ $m->id_perusahaan }}">{{ $m->nama_perusahaan }}</option>
                                @endforeach
                            </select>
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
                    <h5 class="modal-title text-white" id="addModalLabel">Tambah Mentor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add-form" method="POST" action="{{ url('admin/mentor/store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="add-nama_lengkap" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-email" class="form-label">Email</label>
                            <input type="email" name="email" id="add-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-password" class="form-label">Password</label>
                            <input type="password" name="password" id="add-password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-id_perusahaan" class="form-label">Nama Perusahaan</label>
                            <select name="id_perusahaan" id="add-id_perusahaan" class="form-control" required>
                                <option value="">Pilih Perusahaan</option>
                                @foreach ($mitra as $m)
                                    <option value="{{ $m->id_perusahaan }}">{{ $m->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Tambah Mentor</button>
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
                var nama_lengkap = $(this).data('nama_lengkap');
                var email = $(this).data('email');
                var id_perusahaan = $(this).data('id_perusahaan');

                $('#edit-nama_lengkap').val(nama_lengkap);
                $('#edit-email').val(email);
                $('#edit-id_perusahaan').val(id_perusahaan); // Set nilai dropdown

                $('#edit-form').attr('action', '/admin/mentor/update/' + id);
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
                        showAlert('success', 'Data mentor berhasil diperbarui.');
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
                        showAlert('success', 'Data mentor berhasil ditambahkan.');
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