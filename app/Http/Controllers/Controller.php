<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $styles = ['Maple Select', 'Maple Regular', 'Maple Paint', 'Maple MDF', 'Oak Regular', 'Maple Regular MDF', 'Cherry Regular', 'Walnut Regular', 'MDF'];

    protected $panel = [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'K',
        'R',
        'S',
        '1/4" Ply',
        '1/4" MDF',
        '5/8" MDF A',
        '5/8" MDF B',
        '5/8" MDF C',
        '5/8" MDF D',
        '5/8" MDF E',
        '5/8" MDF F',
        '5/8" MDF G',
        '5/8" MDF H',
        '5/8" MDF I',
        '5/8" MDF K',
        '5/8" MDF R',
        '5/8" MDF S'
    ];
}
