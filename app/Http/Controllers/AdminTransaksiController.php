<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Storage\AlertSessionStore;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'title'     =>  'Manajemen Transaksi',
            'transaksi'  =>  Transaksi::orderBy('created_at', 'DESC')->paginate(10),
            'content'   =>  'admin/transaksi/index'
        ];
        return view('admin/layouts/wrapper', $data); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data   = [
            'user_id'   => auth()->user()->id,
            'kasir_name'     => auth()->user()->name,
            'total'     => 0,
        ];
        $transaksi = Transaksi::create($data);
        return redirect('admin/transaksi/'.$transaksi->id.'/edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        //
        $produk = Produk::get();

        $produk_id = request('produk_id');
        $p_detail = Produk::find($produk_id);

        $transaksi_detail = TransaksiDetail::whereTransaksiId($id)->get();

        $act = request('act');
        $qty=request('qty');
        if ($act=='min') {
            if($qty<=1) {
                $qty=1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }
        $subtotal = 0;
        if($p_detail) {
            $subtotal = $qty * $p_detail->harga;
        }
        
        $transaksi = Transaksi::find($id);
        $dibayarkan = request('dibayarkan');
        $kembalian = $dibayarkan - $transaksi->total;

        $data = [
            'title'     =>  'Tambah Transaksi',
            'produk'    =>  $produk,
            'p_detail'  =>  $p_detail,
            'qty'       =>  $qty,
            'subtotal'  =>  $subtotal,
            'transaksi_detail'  =>  $transaksi_detail,
            'transaksi'     =>$transaksi,
            'kembalian'     => $kembalian,
            'content'   =>  'admin/transaksi/create'
        ];
        return view('admin/layouts/wrapper', $data); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $transaksi = Transaksi::find($id);
        TransaksiDetail::where('transaksi_id', $id)->delete();
        $transaksi->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->back();
    }
}
