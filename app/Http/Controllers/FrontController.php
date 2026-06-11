<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('kategori')
            ->where('status', 'tersedia')
            ->latest()
            ->take(3)
            ->get();
            
        return view('welcome', compact('kendaraans'));
    }

    public function katalog(Request $request)
    {
        $query = Kendaraan::with('kategori');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'termurah') {
            $query->orderBy('harga_sewa', 'asc');
        } elseif ($sort == 'termahal') {
            $query->orderBy('harga_sewa', 'desc');
        } else {
            $query->latest();
        }

        $kendaraans = $query->paginate(12);
        $kategoris = Kategori::all();

        return view('katalog', compact('kendaraans', 'kategoris'));
    }

    public function detail($id)
    {
        $kendaraan = Kendaraan::with('kategori')->findOrFail($id);
        
        $relatedCars = Kendaraan::with('kategori')
            ->where('status', 'tersedia')
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();
            
        return view('detail', compact('kendaraan', 'relatedCars'));
    }
}
