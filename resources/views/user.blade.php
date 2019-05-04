<form method="POST" action="{{ route('user.create') }}">
    @csrf
    {!! Form::label('username =') !!} {!! Form::text('username') !!} <br/>
    {!! Form::label('koderoom =') !!} {!! Form::text('kode_room') !!}
    {!! Form::submit('SUBMIT') !!}
</form>