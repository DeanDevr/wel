@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Sidebar Admin -->
    <aside class="w-64 bg-white dark:bg-gray-800 border-r">
        <div class="p-6 text-center text-xl font-bold text-blue-600 dark:text-white">
            <a href="#">ADMIN PANEL</a>
        </div>
        <nav class="px-4 space-y-2 mt-4">
            <a href="{{ route('admin.testadmin') }}" class="block px-4 py-2 rounded bg-blue-500 text-white">
                Dashboard
            </a>
            <a href="{{ route('admin.pengajuan.index') }}" class="block px-4 py-2 rounded hover:bg-blue-500 hover:text-white">
                Semua Pengajuan
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-blue-500 hover:text-white">
                Data Users
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Dashboard Admin</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Total Pengajuan</h2>
                <p class="mt-2 text-2xl text-blue-600 font-bold">{{ $totalPengajuan }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Disetujui</h2>
                <p class="mt-2 text-2xl text-green-600 font-bold">{{ $totalDisetujui }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Ditolak</h2>
                <p class="mt-2 text-2xl text-red-600 font-bold">{{ $totalDitolak }}</p>
            </div>
        </div>

     <!-- Riwayat Pengajuan Berkelompok -->
<div class="mb-8">
    <h2 class="text-lg font-semibold mb-4 text-white">Riwayat Pengajuan Berkelompok</h2>
    <!-- Table Berkelompok -->
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-700 text-white">
            <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="px-4 py-2 text-left text-sm">No</th>
                    <th class="px-4 py-2 text-left text-sm">User</th>
                    <th class="px-4 py-2 text-left text-sm">Sekolah</th>
                    <th class="px-4 py-2 text-left text-sm">Anggota</th>
                    <th class="px-4 py-2 text-left text-sm">Status</th>
                    <th class="px-4 py-2 text-left text-sm">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($pengajuanBerkelompok as $index => $item)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->user->name }}</td>
                        <td class="px-4 py-2">{{ $item->asal_sekolah ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @foreach($item->anggota as $anggota)
                                {{ $anggota->nama }}@if (!$loop->last), @endif
                            @endforeach
                        </td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'diproses')
                                @elseif($item->status == 'disetujui')
                                @elseif($item->status == 'ditolak') 
                                @endif">
                              <x-status-badge :status="$item->status" />
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Riwayat Pengajuan Individu -->
<div>
    <h2 class="text-lg font-semibold mb-4 text-white">Riwayat Pengajuan Individu</h2>
    <!-- Table Individu -->
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-700 text-white">
            <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="px-4 py-2 text-left text-sm">No</th>
                    <th class="px-4 py-2 text-left text-sm">User</th>
                    <th class="px-4 py-2 text-left text-sm">Sekolah</th>
                    <th class="px-4 py-2 text-left text-sm">Status</th>
                    <th class="px-4 py-2 text-left text-sm">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($pengajuanIndividu as $index => $item)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->user->name }}</td>
                        <td class="px-4 py-2">{{ $item->asal_sekolah ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'diproses') 
                                @elseif($item->status == 'disetujui') 
                                @elseif($item->status == 'ditolak') 
                                @endif">
                              <x-status-badge :status="$item->status" />
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    </main>
</div>
@endsection