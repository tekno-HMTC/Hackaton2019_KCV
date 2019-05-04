<form method="POST" action="{{ route('soal.add', $id_room)}}">
    @csrf
    {!! Form::label('PILIH PAKET SOAL') !!} <br/>
    @foreach($pakets as $paket)
    {!! Form::checkbox('paket_id[]', $paket->id, false) !!}
    {!! Form::label($paket->nama_paket) !!} <br/>
    @endforeach
    {!! Form::submit('SUBMIT') !!}
</form>