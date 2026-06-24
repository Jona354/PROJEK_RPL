@extends('layouts.app')

@section('content')
<style>
    .card-modern {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        max-width: 600px;
        margin: 0 auto;
        overflow: hidden;
        border: 1px solid #f3f4f6;
    }
    .card-header-modern {
        background: #1e3a8a; /* Warna biru senada dengan Siguresto */
        color: white;
        padding: 20px 24px;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .card-body-modern {
        padding: 24px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        color: #1f2937;
        transition: all 0.3s ease;
        box-sizing: border-box;
        background-color: #f9fafb;
    }
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
    .btn-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 30px;
    }
    .btn-submit {
        background: #2563eb;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
    }
    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }
    .btn-back {
        background: #6b7280;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        text-decoration: none;
        width: 100%;
        box-sizing: border-box;
    }
    .btn-back:hover {
        background: #4b5563;
    }
</style>

<div class="card-modern">
    <div class="card-header-modern">
        Form Permintaan Barang
    </div>
    
    <div class="card-body-modern">
        @if(session('error'))
            <div style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 12px; border-radius: 8px; margin-bottom: 16px; font-weight: 600;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('permintaan.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Pilih Barang:</label>
                <select name="barang_id" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Barang dari Daftar --</option>
                    @if(isset($barangs) && $barangs->count() > 0)
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama }} (Stok: {{ $b->stok_saat_ini ?? 0 }})
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>Gagal memuat data / Data barang kosong</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah:</label>
                <input type="number" name="jumlah_diminta" class="form-control" placeholder="Masukkan jumlah" value="{{ old('jumlah_diminta') }}" required min="1">
            </div>

            <div class="form-group">
                <label class="form-label">Catatan (Opsional):</label>
                <textarea name="keterangan" class="form-control" placeholder="Contoh: Untuk keperluan stok dapur siang">{{ old('keterangan') }}</textarea>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-submit">
                    Kirim Permintaan
                </button>
                <a href="{{ route('permintaan.index') }}" class="btn-back">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection