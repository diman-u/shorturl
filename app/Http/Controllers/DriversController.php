<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;

class DriversController extends Controller
{
    public function index() {
        return 'Список водителей';
    }

    public function getAll() {

        $drivers = Driver::all();

        foreach ( $drivers as $driver) {

            echo $driver->name . '<br>';
        }
    }
}
