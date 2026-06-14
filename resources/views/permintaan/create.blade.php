<form action="{{ route('permintaan.store') }}" method="POST">
    @csrf
    <select name="barang_id">
        @foreach($barang as $b)
            <option value="{{ $b->id }}">{{ $b->nama }}</option>
        @endforeach
    </select>
    <input type="number" name="jumlah" placeholder="Jumlah">
    <button type="submit">Kirim ke Gudang</button>
</form>