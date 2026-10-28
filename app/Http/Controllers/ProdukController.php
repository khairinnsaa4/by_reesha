<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Category;

class ProdukController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = Category::withCount('produks')->orderBy('nama')->get();

        $query = Produk::with('category');

        if ($request->filled('q')) {
            $keyword = strtolower(trim($request->input('q')));
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw('LOWER(nama_kue) LIKE ?', ["%{$keyword}%"])
                  ->orWhereRaw('LOWER(COALESCE(sku, \'\')) LIKE ?', ["%{$keyword}%"])
                  ->orWhereRaw('LOWER(COALESCE(deskripsi, \'\')) LIKE ?', ["%{$keyword}%"]);
            });
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'semua') {
            $kat = $request->input('kategori');
            $query->whereHas('category', function ($q) use ($kat) {
                $q->where('slug', $kat)->orWhere('id', $kat);
            });
        }

        $sort = $request->input('sort', 'default');
        if ($sort === 'termurah') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort === 'termahal') {
            $query->orderBy('harga', 'desc');
        } elseif ($sort === 'terbaru') {
            $query->latest();
        } else {
            $query->orderBy('id', 'asc');
        }

        $semua_cake = $query->get();

        return view('katalog', compact('semua_cake', 'categories', 'sort'));
    }

    public function detailProduk($id)
    {
        $cake = Produk::with('category')->findOrFail($id);
        $terkait = Produk::where('id', '!=', $id)
            ->where('category_id', $cake->category_id)
            ->take(4)
            ->get();

        if ($terkait->isEmpty()) {
            $terkait = Produk::where('id', '!=', $id)->take(4)->get();
        }

        return view('detail', compact('cake', 'terkait'));
    }
}
