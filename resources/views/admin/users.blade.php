@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-blue-800 dark:text-blue-200">Daftar User dan Admin</h1>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-blue-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase">Peran</th>
                    <th clas="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase">Dibuat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($users as $index => $user)
                <tr class="hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                    <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $index+1 }}</td>
                    <td class="px-4 py-3 text-gray-800 dark:text-gray-100 font-medium">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                            @if($user->role === 'admin')
                                bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200
                            @else
                                bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200
                            @endif
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection