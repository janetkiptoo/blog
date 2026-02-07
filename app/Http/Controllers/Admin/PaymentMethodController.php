<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    public function index()
    {
         $methods = PaymentMethod::latest()->get();
        return view('admin.payment-methods.index', compact('methods'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment-methods.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:20|unique:payment_methods,code',
        ]);

        PaymentMethod::create([
            'name' => $request->name,
            'code' => Str::slug($request->code),
            'requires_reference' => $request->boolean('requires_reference'),
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Payment method added successfully');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
           $paymentMethod = PaymentMethod::findOrFail($id);
           return view('admin.payment-methods.edit', compact('paymentMethod'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod )
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:20|unique:payment_methods,code,' . $paymentMethod->id,
        ]);

        $paymentMethod->update([
            'name' => $request->name,
            'code' => Str::slug($request->code),
            'requires_reference' => $request->boolean('requires_reference'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Payment method updated');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          if ($paymentMethod->payments()->exists()) {
            return back()->with('error', 'Cannot delete payment method in use');
        }

        $paymentMethod->delete();
        return back()->with('success', 'Payment method deleted');
        //
    }
}
