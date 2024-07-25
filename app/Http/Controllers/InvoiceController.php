<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    function list(Request $request)
    {
        $invoices = Invoice::where('user_id', $request->user()->id)->get();
        return view('invoice.list', ['invoices' => $invoices]);
    }

    function view(string $id, Request $request)
    {
        $invoice = Invoice::where('id', $id)->firstOrFail();
        return view('invoice.view', ['invoice' => $invoice]);
    }

    function create(Request $request)
    {
        $items = ShoppingCart::where('user_id', $request->user()->id)->get();

        if ($items->isEmpty()) return back();

        return DB::transaction(function() use ($request, $items) {
            $total = 0;
            foreach ($items as $item) {
                $total += $item->product->price * $item->quantity;
            }

            $invoice = Invoice::create([
                'user_id' => $request->user()->id,
                'total' => $total
            ]);

            foreach ($items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity
                ]);

                $item->delete();
            }

            // lihat isi dari mailable
            // return new \App\Mail\CheckoutMail($items, $request->user());

            // kirim mailable
            $user = $request->user();
            // Mail::to($user)
            //     ->send(new \App\Mail\CheckoutMail($items, $request->user()));
            $user->notify(new \App\Notifications\CheckoutNotification($invoice));

            return redirect()->route('invoice.view', ['id' => $invoice->id]);
        });

        return back();
    }
}