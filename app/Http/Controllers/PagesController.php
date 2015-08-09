<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about()
    {
        /**
         * first
         */
        // $name = 'Rudo <span style="color: red;">Rufu</span>';
        // return view('pages.about')->with('name', $name);

        /**
         * second
         */
        // return view('pages.about')->with([
        //     'first' => 'Rudo',
        //     'last'  => 'Rufu'
        // ]);

        /**
         * third (CI style)
         */
        // $data['first'] = 'Rudo';
        // $data['last'] = 'Rufu';
        // return view('pages.about', $data);

        /**
         * fourth
         */
        // $first = 'Rudo';
        // $last = 'Rufu';
        // return view('pages.about', compact('first', 'last'));

        $name = 'Rudo Rufu';
        $peoples = [
            'Taylor Otwell',
            'Dayle Rees',
            'Eric Barnes',
        ];
        return view('pages.about', compact('name', 'peoples'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function index()
    {
        return view('welcome');
    }
}
