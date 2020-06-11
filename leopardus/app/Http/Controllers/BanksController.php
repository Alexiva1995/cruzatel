<?php

namespace App\Http\Controllers;

use App\Banks;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function index()
    {
        $banks = Banks::all();

        return view('bank.index', compact('banks'));
    }
}
