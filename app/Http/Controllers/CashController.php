<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\CashFund;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CashController extends Controller
{
    public function index(): View
    {
        $cashs = Cash::with('cashFunds', 'administrator.division')
            ->get();
        return view("cash.index", compact("cashs"));
    }

    public function history(): View
    {
        $histories = CashFund::with('cash.administrator.division', 'fund')
            ->orderBy('created_at')
            ->paginate(10);
        return view('cash.history', compact('histories'));
    }
}
