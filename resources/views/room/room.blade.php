@foreach ($kumpulan_soal as $soal)
    <form method="POST" action="{{ route('room.submit', ['id_room'=>$id_room])}}">
        @csrf
        <input type="hidden" name="soal_id" value={{$soal['soal_id']}}>
        <input type="hidden" name="user_id" value={{session('user_id')}}>
        <input type="hidden" name="elapsed_time" value="5">
        <input type="hidden" name="id_room" value={{$id_room}}>
        <input type="hidden" name="jawaban" value="0">
        <button class="button" type="submit" value="submit">
    </form>
@endforeach