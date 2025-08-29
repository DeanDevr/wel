@php
    $statusMap = [
        'disetujui' => ['label' => 'DITERIMA', 'class' => 'text-green-600 font-bold'],
        'ditolak'   => ['label' => 'DITOLAK', 'class' => 'text-red-600 font-bold'],
        'diproses'  => ['label' => 'SEDANG DIPROSES', 'class' => 'text-yellow-600 font-bold'],
    ];
    $statusInfo = $statusMap[$status] ?? ['label' => strtoupper($status), 'class' => 'text-gray-600 font-bold'];
@endphp

<span class="{{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span>