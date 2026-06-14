@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h2 class="mb-4">Input Barang Keluar</h2>
            
            <form action="{{ route('barang-keluar.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Pilih Barang:</label>
                    <select name="barang_id" id="barang_id" class="form-control" required onchange="updateStok()">
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}" data-stok="{{ $b->stok_saat_ini }}">
                                {{ $b->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="alert alert-info" id="info-stok" style="display: none;">
                    Sisa stok tersedia: <strong id="jumlah-stok">0</strong>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Keluar:</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tujuan Penggunaan:</label>
                    <select name="tujuan" class="form-control" required>
                        <option value="">-- Pilih Tujuan --</option>
                        <option value="Dapur">Dapur</option>
                        <option value="Bar">Bar</option>
                        <option value="Rusak">Rusak / Tidak Layak</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <button type="submit" class="btn btn-warning w-100">Simpan Barang Keluar</button>
                <a href="{{ route('barang-keluar.index') }}" class="btn btn-secondary">
        Kembali
    </a>
            </form>
        </div>
    </div>
</div>

<script>
function updateStok() {
    const select = document.getElementById('barang_id');
    const infoStok = document.getElementById('info-stok');
    const spanStok = document.getElementById('jumlah-stok');
    const inputJumlah = document.getElementById('jumlah');
    
    const selectedOption = select.options[select.selectedIndex];
    const stok = selectedOption.getAttribute('data-stok');

    if (select.value !== "") {
        infoStok.style.display = 'block';
        spanStok.innerText = stok;
        inputJumlah.setAttribute('max', stok); 
    } else {
        infoStok.style.display = 'none';
    }
}
</script>
@endsection