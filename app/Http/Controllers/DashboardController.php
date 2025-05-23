<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cards = Card::where('user_id', auth()->id())->get();
        return view('dashboard.index', compact('cards'));
    }
}

class CardController extends Controller
{
    public function index()
    {
        return view('cards.index');
    }
}