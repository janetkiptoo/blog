<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterItem;


class FooterItemController extends Controller
{
    public function index()
    {
        $items = FooterItem::orderBy('section')
            ->orderBy('sort_order')
            ->get();

        return view('admin.footer.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'label'   => 'required|string',
            'value'   => 'nullable|string',
            'url'     => 'nullable|string',
            'icon'    => 'nullable|string',
        ]);

        FooterItem::create($request->all());

        return back()->with('success', 'Footer item added');
    }

    public function edit(FooterItem $footer)
    {
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request, FooterItem $footer)
    {
        $footer->update($request->all());

        return redirect()
            ->route('admin.footer.index')
            ->with('success', 'Footer item updated');
    }

    public function destroy(FooterItem $footer)
    {
        $footer->delete();

        return back()->with('success', 'Footer item deleted');
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
   

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    
}
