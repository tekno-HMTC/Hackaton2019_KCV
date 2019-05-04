<form method="POST" action="{{ route('room.store')}}">
    @csrf
    <input type="text" name="kode">
    <input type="submit" value="submit"><br>
</form>