<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    public function purchaseWithUser(int $id)
    {
        $user = User::findOrFail($id);

        $allPurchases = Purchase::with(['user'])->orderBy('purchase_id', 'desc')->get();
        $purchases = $allPurchases->where('user_id', $id);

        return view('users.purchases', [

            'purchases' => $purchases,
            'user' => $user
        ]);

    }

    public function myProfilePurchase(int $id)
    {
        $user = User::findOrFail($id);

        $allPurchases = Purchase::with(['user'])->orderBy('purchase_id', 'desc')->get();
        $purchases = $allPurchases->where('user_id', $id);

        return view('users.profile.purchases', [

            'purchases' => $purchases,
            'user' => $user
        ]);
    }
}
