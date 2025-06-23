<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = \DB::table('category')->get();
        $barang = \DB::table('item')
            ->join('category', 'item.category_id', '=', 'category.id')
            ->select('item.*', 'category.kategori as category_name')
            ->get(); 

        return view('pages.item', compact('barang', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_barang' => 'required',
            'category_id' => 'required',
            'lokasi' => 'required',
            'qty' => 'required',
        ]);
    
        
        try {
            $item = new Item();
            $item->name = $request->nama_barang;
            $item->category_id = $request->category_id;
            $item->lokasi = $request->lokasi;
            $item->quantity = $request->qty;

            $item->satuan = $request->satuan;
            $item->description = $request->deskripsi;
            $item->penerima = $request->penerima;
            $item->saveOrFail();



            

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
        } catch (\Throwable $e) {
           return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Item::destroy($id);
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
