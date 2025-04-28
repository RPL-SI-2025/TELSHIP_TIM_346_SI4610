<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Setel Kata Sandi Anda</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #dc3545;">Selamat Datang, {{ $user->name }}!</h2>
        <p>Anda telah ditambahkan sebagai mentor. Silakan setel kata sandi Anda dengan mengklik tombol di bawah ini:</p>
        <p style="text-align: center;">
            <a href="{{ $setupLink }}" style="display: inline-block; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px;">Setel Kata Sandi</a>
        </p>
        <p>Jika tombol tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:</p>
        <p><a href="{{ $setupLink }}">{{ $setupLink }}</a></p>
        <p>Terima kasih,</p>
        <p>Tim Admin</p>
    </div>
</body>
</html>