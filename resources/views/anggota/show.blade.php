<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Anggota - {{ $anggota['nama'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-middle">
                        <h5 class="mb-0">Detail Lengkap Anggota</h5>
                        <span class="badge {{ $anggota['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ $anggota['status'] }}
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 35%">Kode Anggota</th>
                                <td>: <span class="fw-bold text-primary">{{ $anggota['kode'] }}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>: {{ $anggota['nama'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $anggota['email'] }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>: {{ $anggota['telepon'] }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>: {{ $anggota['alamat'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer bg-white d-grid">
                        <a href="{{ url('/anggota') }}" class="btn btn-secondary">
                            &larr; Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>