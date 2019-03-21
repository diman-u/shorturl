<h1>Редактировать задачу</h1>

<form action="{{ $data['id'] }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    <input type="text" name="date" value="{{ $data['date'] }}"><br>
    <input type="text" name="time" value="{{ $data['time'] }}"><br>
    <input type="text" name="path" value="{{ $data['path'] }}"><br>
    <input type="text" name="gruz" value="{{ $data['gruz'] }}"><br>
    <input type="text" name="zakaz" value="{{ $data['zakaz'] }}"><br>
    <input type="submit" value="Изменить">
</form>