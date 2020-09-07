<?php


namespace App\Http\Controllers;
use App\RecalculationHistory;

class RecalculationController extends Controller
{
    public function index()
    {
        $histories = RecalculationHistory::query()->paginate(7);
        return view('index',compact('histories'));
    }
}
