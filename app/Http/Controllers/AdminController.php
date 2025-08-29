<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function testadmin()
    {
        // Ambil semua pengajuan individu dan kelompok untuk admin
        $pengajuanIndividu = Pengajuan::where('jenis_pengajuan', 'sendiri')->with('user')->latest()->get();
        $pengajuanBerkelompok = Pengajuan::where('jenis_pengajuan', 'kelompok')->with('user', 'anggota')->latest()->get();

        $totalUsers      = User::count();
        $totalPengajuan  = Pengajuan::count();
        $totalDisetujui  = Pengajuan::where('status', 'disetujui')->count();
        $totalDitolak    = Pengajuan::where('status', 'ditolak')->count();

        return view('admin.testadmin', compact(
            'totalUsers',
            'totalPengajuan',
            'totalDisetujui',
            'totalDitolak',
            'pengajuanBerkelompok',
            'pengajuanIndividu'
        ));
    }


    public function show($id)
{
    $pengajuan = Pengajuan::with('user', 'anggota')->findOrFail($id);
    return view('admin.pengajuan.show', compact('pengajuan'));
}




    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

  public function pengajuanIndex()
{
    $pengajuanBerkelompok = Pengajuan::where('jenis_pengajuan', 'kelompok')
        ->with('user', 'anggota')
        ->latest()
        ->paginate(10);

    $pengajuanIndividu = Pengajuan::where('jenis_pengajuan', 'sendiri')
        ->with('user')
        ->latest()
        ->paginate(10);

    return view('admin.pengajuan.index', compact('pengajuanBerkelompok', 'pengajuanIndividu'));
}
    public function updatePengajuanStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,disetujui,ditolak',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}