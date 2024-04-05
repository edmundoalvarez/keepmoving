<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        $purchases = Purchase::selectRaw('MONTH(created_at) as month')
                ->selectRaw('SUM(total) as total')
                ->groupBy('month')
                ->orderBy('total', 'desc')
                ->get();

        foreach ($purchases as $purchase) {
            $purchase->month = ucfirst(Date::createFromFormat('!m', $purchase->month)->monthName);
        }

        return view('admin.index', [
            'purchases' => $purchases
        ]);
    }
}
