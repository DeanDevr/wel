@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Pengajuan</h1>
    <div class="mb-4">
        <strong>Nama:</strong> {{ $pengajuan->nama ?? '-' }}<br>
        <strong>Sekolah:</strong> {{ $pengajuan->asal_sekolah ?? '-' }}<br>
        <strong>Jurusan:</strong> {{ $pengajuan->jurusan ?? '-' }}<br>
         <p><strong>Tanggal PKL:</strong> {{ $pengajuan->tanggal_mulai->format('d M Y') }} - {{ $pengajuan->tanggal_selesai->format('d M Y') }}</p>
        <strong>Status:</strong> <x-status-badge :status="$pengajuan->status" /><br>
        @if($pengajuan->surat_pengantar)
            <strong>Surat Pengantar:</strong>
            <a href="{{ asset('storage/' . $pengajuan->surat_pengantar) }}" target="_blank" class="text-blue-600 underline ml-2">Lihat Surat</a>
        @endif
    </div>
    @if($pengajuan->jenis_pengajuan === 'kelompok')
        <div class="mb-4">
            <strong>Anggota Kelompok:</strong>
            <ul class="list-disc list-inside">
                @forelse($pengajuan->anggota as $anggota)
                    <li>{{ $anggota->nama }} ({{ $anggota->nisn }})</li>
                @empty
                    <li>-</li>
                @endforelse
            </ul>
        </div>
    @endif
    <a href="{{ url()->previous() }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kembali</a>
</div>
@endsection