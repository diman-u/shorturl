<?php

namespace App\Http\Controllers;

use App\Car;

use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function getAll() {

        $cars = Car::all();

        foreach ( $cars as $car) {
            echo $car->title . '<br>';
        }
    }
}
