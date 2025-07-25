<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositFund;
use App\Models\DepositPenalty;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepositController extends Controller
{
    public function index(): View
    {
        $deposits = Deposit::with(["administrator.division", "depositPenalties", "depositFunds"])->get();
        // dd($deposits);

        return view("deposit.index", compact('deposits'));
    }

    public function history(): View
    {
        $histories = DepositFund::with("deposit.administrator.division", 'fund')
            ->orderBy('created_at')
            ->paginate(10);

        $penaltyHistories = DepositPenalty::with('deposit.administrator.division')
            ->orderBy('created_at')
            ->paginate(10);

        return view('deposit.history', compact('histories', 'penaltyHistories'));
    }
}
