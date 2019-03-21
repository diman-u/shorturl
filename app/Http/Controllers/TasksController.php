<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Log;
use QueryException;

class TasksController extends Controller
{
    public $num = 1;
    public $prevDate;
    public $prevMarka;
    public $prevMarkaDate;

    public function getUniqDate($dates) {

        foreach ($dates as $item ) {
            $uniqDates[] = $item['date'];
        }

        return view('tasks', ['dates'=>array_unique($uniqDates)]);
    }

    public function getAll() {

        $datePeriod = '2018-09-01';
        $dates = Task::where('date', '>', $datePeriod)->orderBy('date')->orderBy('marka')->orderBy('time')->get();

        foreach ($dates as $items) {

            $allTask[$items['date']][$items['marka']][] = $items;
        }
        return view('tasks', ['allTask'=>$allTask]);
    }

    public function getByDate($date) {

        $tasks = Task::where('date', '=', $date)->orderBy('marka')->orderBy('time')->get();
        return $tasks;
    }

    public function addTask(Request $request) {

        if ($request->isMethod('post')) {

            echo '<pre>';
            print_r($_POST);
            die();

            $taskID = Task::insertGetId([
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'path' => $request->input('path'),
                'gruz' => $request->input('gruz'),
                'zakaz' => $request->input('zakaz')
            ]);

            if (isset($taskID)) {
                return redirect()->route('/')->with('taskID', $taskID);
            }
        }

        return redirect()->route('/', null);
    }

    public function edit(Request $request, $id) {

        if ($request->isMethod('get')) {

            $task = Task::where('id', $id)->first();
            return view('editTask', ['data'=>$task]);
        }

        if ($request->isMethod('post')) {

            $data = $request->all();
            unset($data['_token']);
            Task::where('id', $id)->update($data);

            return redirect()->route('/')->with('update', 'yes');
        }

    }

    public function delTest() {

        die('delTest');
        echo Task::where('path', 'Test')->delete();
    }

    public function delete(Request $request, $id) {

        echo Task::where('path', 'Test')->delete();
    }

    public function zav(Request $request, $id) {

        if ($request->isMethod('get')) {

            $task = Task::find($id);
            $task->status = 1;

            if ($task->save()) {
                return redirect()->route('/');
            } else {
                //Проверка полей
                echo 'Заполнены не все поля';
            }

            return view('zav', ['taskID'=>$id]);
        }
        return view('zav', ['taskID'=>null]);
    }

    public function editForBuh(Request $request, $id) {

        print_r($id); die('editForBuh');

        $task = Task::find($id);
        $task->edit = 1;

        return ($task->save())? redirect()->route('/') : null;
    }

    public function formatDateTime($date="", $time="") {

        if ( !empty($date)) {

            $newDate = explode('-', $date);
            return  implode( '-', array_reverse($newDate));
        }

        if ( !empty($time)) {

            $time = trim($time);
            $pos = strrpos($time, ':');
            $time = substr($time, 0, 5);
            return $time;
        }
    }

    public function groupByMarka($marka) {

        if(empty($this->prevMarka)) {
            $this->prevMarka = $marka;
            return 1;
        }

        if ( $marka == $this->prevMarka ) {

            $this->prevMarka = $marka;
            return 0;
        }

        $this->prevMarka = $marka;

        return 1;
    }

    public function getToday($date) {
        $today = date("Y-m-d");
        if ($date == $today) {
            return 1;
        }
    }

    public function getDay($date) {
        $days = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $num_day = strftime("%w", strtotime($date));
        $name_day = $days[$num_day];
        return $name_day . ', ' . $this->formatDateTime($date);
    }

    public function getCurUser() {
        //return Auth::user()->name;
    }

}
