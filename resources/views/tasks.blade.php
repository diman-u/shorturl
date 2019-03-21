<?
use App\Http\Controllers\TasksController as Task;
$Task = new Task();
?>

@extends('layouts/main')

@section('content')

<div>
    @if(Session::has('taskID'))
        <div>Добавлена задача {{Session::get('taskID')}}</div>
    @endif

    @if(Session::has('update'))
        <div>Задача обновлена</div>
    @endif
</div>

@if (isset($allTask))

    @foreach($allTask as $date=>$items)

        <a href="#" class="titleTask">
            <h2 class="text-center">{{ $Task->getDay($date) }}</h2>
        </a>

        <div class="insideTask">
            @foreach($items as $marka=>$value)

                <h4 class="text-center">
                    {{ $marka }}
                </h4>
                {{--<div class="text-center">Свободные машины</div><br>--}}
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Заявка {{ $Task->getDay($date) }}</th>
                            <th>Диспетчер</th>
                            <th>Заказчик</th>
                            <th>Час/Км</th>
                            <th>Ставка</th>
                            <th>Сумма</th>
                            <th>Деньги</th>
                            <th>!</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($value as $task)
                                <tr class="{{ ($task->status)? 'done' : 'active' }}">
                                    <td>{{ $Task->num++ }}</td>
                                    <td class="text-left">
                                        {{ $Task->formatDateTime("", $task->time) }} - {{  $Task->formatDateTime("", $task->deadline) }}
                                        <br>
                                        {{ $task->path }}, {{ $task->gruz }}, {{ $task->comment }}
                                        <br>
                                        <a href="edit/{{ $task->id }}" >
                                            <input class="btn btn-primary" type="submit" value="Редактировать">
                                        </a>
                                        <a href="zav/{{ $task->id }}" >
                                            <input class="btn btn-primary" type="submit" value="Завершить">
                                        </a>
                                    </td>
                                    <td>{{ $task->disp }}</td>
                                    <td>
                                        {{ $task->zakaz }}<br>
                                        {{ $task->contact }}<br>
                                        <hr>
                                        {{ $task->tel }}
                                        {{ $task->gortel }}
                                    </td>
                                    <td>
                                        @if ($task->ch != 0) {{ $task->ch }} ч. @endif<br>
                                        @if ($task->km != 0) {{ $task->km }} км @endif
                                    </td>
                                    <td>
                                        @if($task->stavkach != 0) {{ $task->stavkach }} ч. @endif<br>
                                        @if($task->stavkakm != 0) {{ $task->stavkakm }} км @endif
                                    </td>
                                    <td>
                                        @if($task->summa != 0) {{ $task->summa }} @endif<br>
                                        @if($task->summa2 != 0) {{ $task->summa2 }} @endif<br>
                                        @if($task->summa2 != 0) {{ $task->summa3 }} @endif
                                    </td>
                                    <td>
                                        {{ $task->money }}<br>
                                        {{ $task->money2 }}<br>
                                        {{ $task->money3 }}
                                    </td>
                                    <td>{{ $task->combuh }}</td>
                                </tr>
                            @endforeach
                            <? $Task->num = 1; ?>
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach
@else
    <p>Список пуст</p>
@endif

@endsection