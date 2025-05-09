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
                <h1 class="fw-bold p-4 text-white" style="color: white;">PENGGUNA</h1>
                <img src="{{ asset('assets/images/ft3.svg') }}" alt="Banner" class="position-absolute end-0 top-0 h-100">
            </div>

            <div class="d-flex gap-2 mt-1 p-4">
                <a class="btn fw-semibold" href="{{ url('admin/pengguna') }}"
                    style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">MAHASISWA</a>
                <a href="{{ url('admin/mentor') }}" class="btn btn-outline-secondary text-muted">MENTOR</a>
                <a href="{{ url('admin/mitra') }}" class="btn btn-outline-secondary text-muted">MITRA</a>
            </div>

            <!-- Success or Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Data Table Section -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        {{-- <button class="add-btn mb-3">
                            <i class="fas fa-plus-circle"></i> Tambah Mahasiswa
                        </button> --}}
                    </div>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan NIM, nama, atau email..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-danger">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </form>
                        <a href="{{ route('admin.mahasiswa.export-pdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>No HP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table Rows -->
                            @foreach ($mahasiswa as $mhs)
                                <tr>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama_lengkap }}</td>
                                    <td>{{ $mhs->email }}</td>
                                    <td>{{ $mhs->jurusan }}</td>
                                    <td>{{ $mhs->no_hp }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="action-btn edit-btn" data-id="{{ $mhs->user_id }}"
                                                data-nim="{{ $mhs->nim }}"
                                                data-nama_lengkap="{{ $mhs->nama_lengkap }}"
                                                data-email="{{ $mhs->email }}" data-jurusan="{{ $mhs->jurusan }}"
                                                data-no_hp="{{ $mhs->no_hp }}" data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- <button type="button" class="action-btn delete-btn"
                                                data-id="{{ $mhs->id }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">
                                                <i class="fas fa-trash"></i>
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4 shadow">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title text-white" id="editModalLabel ">Edit Mahasiswa</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="edit-form" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit-nim" class="form-label">NIM</label>
                                                    <input type="text" name="nim" id="edit-nim" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama_lengkap" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap" id="edit-nama_lengkap"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="edit-email"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-jurusan" class="form-label">Jurusan</label>
                                                    <input type="text" name="jurusan" id="edit-jurusan"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-no_hp" class="form-label">No. HP</label>
                                                    <input type="text" name="no_hp" id="edit-no_hp"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Konfirmasi Hapus -->
                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data mahasiswa ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" id="confirmDelete"
                                                class="btn btn-danger">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            @if (count($mahasiswa) == 0)
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data mahasiswa</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination if needed -->
                <nav>
                    {{ $mahasiswa->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var nim = $(this).data('nim');
                var nama_lengkap = $(this).data('nama_lengkap');
                var email = $(this).data('email');
                var jurusan = $(this).data('jurusan');
                var no_hp = $(this).data('no_hp');

                $('#edit-nim').val(nim);
                $('#edit-nama_lengkap').val(nama_lengkap);
                $('#edit-email').val(email);
                $('#edit-jurusan').val(jurusan);
                $('#edit-no_hp').val(no_hp);

                $('#edit-form').attr('action', '/admin/mahasiswa/update/' + id);
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
                        showAlert('success', 'Data mahasiswa berhasil diperbarui.');
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

            var deleteUrl = '';

            // Trigger modal delete
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var id = button.data('id'); // Ambil ID dari data-id
                deleteUrl = "{{ url('admin/mahasiswa/delete/') }}/" +
                    id; // Tentukan URL untuk request DELETE
            });

            // Handle konfirmasi hapus
            $('#confirmDelete').click(function() {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE', // Gunakan metode DELETE
                    data: {
                        _token: '{{ csrf_token() }}', // Kirim CSRF token
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        showAlert('success', 'Data mahasiswa berhasil dihapus');
                        location.reload(); // Reload halaman untuk update data
                    },
                    error: function(response) {
                        $('#deleteModal').modal('hide');
                        showAlert('danger', 'Gagal menghapus data mahasiswa');
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