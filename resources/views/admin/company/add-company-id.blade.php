<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah ID Perusahaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Segoe UI", sans-serif;
        }

        .modal-box {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 80px auto;
        }

        .form-control {
            border-radius: 12px;
            padding: 14px;
        }

        .form-label {
            font-weight: 600;
            margin-top: 12px;
        }

        .btn-lanjut {
            background-color: #e50914;
            color: white;
            border-radius: 10px;
            padding: 12px;
            margin-top: 25px;
        }

        .btn-lanjut:hover {
            background-color: #b20710;
        }

        .modal-title {
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }

        .modal-subtitle {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<div class="modal-box">
    <h3 class="modal-title">Menambahkan Mitra / ID Perusahaan</h3>
    <p class="modal-subtitle">Lengkapi kolom berikut untuk menambahkan ID Perusahaan</p>

    <form action="{{ route('id-perusahaan.store') }}" method="POST" enctype="multipart/form-data">

        <label class="form-label" for="company_id">ID Perusahaan</label>
        <input type="text" class="form-control" name="company_id" id="company_id" placeholder="Ketik disini" required>

        <label class="form-label" for="company_logo">Logo Perusahaan</label>
        <input type="file" class="form-control" name="company_logo" id="company_logo" required>

        <label class="form-label" for="company_name">Nama Perusahaan</label>
        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Ketik disini" required>

        <label class="form-label" for="company_description">Deskripsi Perusahaan</label>
        <textarea class="form-control" name="company_description" id="company_description" placeholder="Ketik disini" rows="4" required></textarea>

        <button type="submit" class="btn btn-lanjut w-100">Lanjut</button>
    </form>
</div>

</body>
</html>
