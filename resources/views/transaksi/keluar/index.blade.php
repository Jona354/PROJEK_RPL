@extends('layouts.app')

@section('content')
<style>
    /* Styling Header Halaman */
    .page-header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .page-title-wrapper h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px 0;
    }
    .page-title-wrapper p {
        color: #6b7280;
        margin: 0;
        font-size: 0.95rem;
    }

    /* Styling Wadah Tabel */
    .table-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    /* Styling Tabel Utama */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    /* Header Tabel Biru (Sesuai Referensi) */
    .custom-table thead {
        background-color: #2563eb; /* Warna biru cerah */
        color: #ffffff;
    }
    .custom-table th {
        padding: 16px 20px;
        font-weight: 600;
        font-size: 0.95rem;
        white-space: nowrap;
    }

    /* Baris Tabel */
    .custom-table td {
        padding: 16px 20px;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.95rem;
        vertical-align: middle;
    }
    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Styling Elemen Badge */
    .badge-tujuan {
        background-color: #e5e7eb; /* Abu-abu seperti No Faktur di gambar */
        color: #374151;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    .badge-jumlah {
        background-color: #dcfce7; /* Hijau muda */
        color: #166534; /* Hijau tua */
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-block;
        text-align: center;
        min-width: 24px;
    }

    /* Tombol Hapus Merah Solid */
    .btn-hapus-solid {
        background-color: #ef4444; /* Merah solid */
        color: #ffffff;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        text-decoration: none;
    }
    .btn-hapus-solid:hover {
        background-color: #dc2626;
    }
</style>

<div class="page-header-container">
    <div class="page-title-wrapper">
        <h2>Riwayat Barang Keluar</h2>
        <p>Kelola seluruh transaksi barang keluar dari gudang.</p>
    </div>
</div>

<div class="table-card">
    <table class="custom-table">
        <thead>
            <tr>
                <th>Tanggal Keluar</th>
                <th>Tujuan</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
<tbody>
    @if(isset($barangKeluar) && $barangKeluar->count() > 0)
        @foreach($barangKeluar as $item)
            <tr>
                {{-- Membaca kolom 'tanggal' dan memformatnya jadi DD-MM-YYYY --}}
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>

                {{-- Membaca tujuan --}}
                <td>
                    <span class="badge-tujuan">{{ ucfirst($item->tujuan) }}</span>
                </td>

                {{-- Membaca nama barang melalui relasi model --}}
                <td>{{ $item->barang->nama ?? 'Barang Tidak Ditemukan' }}</td>

                {{-- Membaca jumlah keluar --}}
                <td>
                    <span class="badge-jumlah">{{ $item->jumlah }}</span>
                </td>

                {{-- Tombol aksi Hapus dinamis --}}
                <td>
                    <form action="{{ route('barang-keluar.destroy', $item->id) }}"
      method="POST"
      class="form-delete"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button type="button" class="btn-hapus-solid">
        Hapus
    </button>

</form>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" style="text-align: center; color: #6b7280; padding: 24px;">
                Belum ada data barang keluar yang tercatat.
            </td>
        </tr>
    @endif
</tbody>    </table>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-delete').forEach(function(form){

        form.querySelector('.btn-hapus-solid').addEventListener('click', function(e){

            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Hapus Barang Keluar?',
                text: 'Data transaksi yang dihapus tidak dapat dikembalikan.',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true

            }).then((result)=>{

                if(result.isConfirmed){

                    Swal.fire({
                        title:'Menghapus Data...',
                        text:'Harap tunggu sebentar',
                        allowOutsideClick:false,
                        didOpen:()=>{
                            Swal.showLoading();
                        }
                    });

                    form.submit();

                }

            });

        });

    });

});
</script>
@endsection
