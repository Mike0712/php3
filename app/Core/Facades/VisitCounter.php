<?php


namespace App\Core\Facades;


use Illuminate\Support\Facades\Facade;

class VisitCounter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'visit_counter';
    }
}