@extends('layouts.app')

@section('title', 'Daftar Pengajuan PKL')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Pengajuan PKL</h1>

    <!-- Tabs -->
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabs">
            <li class="mr-2">
                <a href="#individu" class="tab-link inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg dark:text-blue-400 active" onclick="showTab(event, 'individu')">Individu</a>
            </li>
            <li class="mr-2">
                <a href="#kelompok" class="tab-link inline-block p-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 border-b-2 border-transparent rounded-t-lg" onclick="showTab(event, 'kelompok')">Berkelompok</a>
            </li>
        </ul>
    </div>

    <!-- Pengajuan Individu -->
    <div id="individu" class="tab-content mb-10">
        <h2 class="text-lg font-semibold mb-3">Pengajuan Individu</h2>
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">No</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">User</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Sekolah</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <div>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($pengajuanIndividu as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item->user->name }}</td>
                            <td class="px-4 py-2">{{ $item->asal_sekolah ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <x-status-badge :status="$item->status" />
                            </td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex flex-wrap gap-1 justify-center">
                                    <a href="{{ route('admin.pengajuan.show',$item->id) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">Detail</a>
                                    
                                    <form action="{{ route('admin.pengajuan.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.pengajuan.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Tolak</button>
                                    </form>
                                    <form action="{{ route('admin.pengajuan.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="diproses">
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Proses Ulang</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada pengajuan individu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pengajuan Berkelompok -->
    <div id="kelompok" class="tab-content mb-10 hidden">
        <h2 class="text-lg font-semibold mb-3">Pengajuan Berkelompok</h2>
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">No</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Ketua</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Sekolah</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Anggota</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($pengajuanBerkelompok as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->asal_sekolah ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($item->anggota as $anggota)
                                        <li>{{ $anggota->nama }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-2">
                                <x-status-badge :status="$item->status" />
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex flex-wrap gap-1 justify-center">
                                    <a href="{{ route('admin.pengajuan.show',$item->id) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">Detail</a>
                                    
                                    <form action="{{ route('admin.pengajuan.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.pengajuan.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Tolak</button>
                                    </form>
                                    <form action="{{ route('admin.pengajuan.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="diproses">
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Proses Ulang</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada pengajuan berkelompok</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Tab Script --}}
<script>
    function showTab(evt, tabId) {
        evt.preventDefault();
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(tabId).classList.remove('hidden');
        document.querySelectorAll('.tab-link').forEach(el => el.classList.remove('text-blue-600', 'border-blue-600', 'active'));
        evt.target.classList.add('text-blue-600', 'border-blue-600', 'active');
    }
    // Default tab
    document.addEventListener('DOMContentLoaded', function() {
        showTab({preventDefault:()=>{}}, 'individu');
    });
</script>
@endsection