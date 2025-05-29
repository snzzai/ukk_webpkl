<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Laporan PKL</h1>
        <a href="{{ route('pkl.create') }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Laporan
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Search Bar -->
        <div class="p-4 bg-gray-50">
            <input type="text" wire:model.live.debounce.300ms="search" 
                   placeholder="Cari berdasarkan nama siswa, industri, atau guru..."
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Nama Siswa</th>
                        <th class="py-3 px-4 text-left">Industri</th>
                        <th class="py-3 px-4 text-left">Guru Pembimbing</th>
                        <th class="py-3 px-4 text-left">Tanggal Mulai</th>
                        <th class="py-3 px-4 text-left">Tanggal Selesai</th>
                        <th class="py-3 px-4 text-left">Durasi (hari)</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($pklList as $index => $pkl)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $pklList->firstItem() + $index }}</td>
                            <td class="py-3 px-4">{{ $pkl->siswa->nama }}</td>
                            <td class="py-3 px-4">{{ $pkl->industri->nama }}</td>
                            <td class="py-3 px-4">{{ $pkl->guru->nama }}</td>
                            <td class="py-3 px-4">{{ $pkl->tanggal_mulai->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">{{ $pkl->tanggal_selesai->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">
                                {{ $pkl->tanggal_mulai->diffInDays($pkl->tanggal_selesai) }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('pkl.edit', $pkl->id) }}" 
                                       class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <button wire:click="delete({{ $pkl->id }})" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus?')"
                                            class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 px-4 text-center text-gray-500">
                                Belum ada data PKL
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 bg-gray-50 border-t">
            {{ $pklList->links() }}
        </div>
    </div>
</div>