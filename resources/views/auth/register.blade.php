<form action="/register" method="POST">
    @csrf
    <label>Pilih Role:</label>
    <select name="role" required>
        <option value="admin">Admin Gudang</option>
        <option value="chef">Chef</option>
        <option value="owner">Owner</option>
    </select>
    
    <button type="submit">Daftar</button>
</form>