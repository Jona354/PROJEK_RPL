<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permintaan Barang - SIGURESTO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Form Permintaan Barang</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('permintaan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Barang:</label>
                            <select name="barang_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Barang dari Daftar --</option>
                                @foreach($barangs as $b)
                                    <option value="{{ $b->id }}">
                                        {{ $b->nama}} (Stok saat ini: {{ $b->stok_saat_ini }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah:</label>
                            <input type="number" name="jumlah_diminta" class="form-control" placeholder="Masukkan jumlah" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan (Opsional):</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Untuk keperluan stok dapur siang"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Kirim Permintaan</button>
                            <a href="{{ route('permintaan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<textarea name="keterangan" class="form-control" placeholder="Tulis catatan di sini..."></textarea>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>