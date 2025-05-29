<div class="max-w-7xl mx-auto p-6">
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tombol Create (hanya untuk siswa tanpa PKL atau admin) -->
    @if(auth()->user()->role !== 'siswa' || (auth()->user()->siswa && !auth()->user()->siswa->pkl))
        <div class="mb-4">
            <a href="{{ route('pkl.create') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Buat Laporan PKL
            </a>
        </div>
    @endif

    <!-- Search dan Pagination -->
    <div class="mb-4 flex justify-between items-center">
        <input type="text" wire:model.live="search" placeholder="Cari..." 
               class="border rounded-lg px-4 py-2 w-64">
        
        <select wire:model.live="numpage" class="border rounded-lg px-4 py-2">
            <option value="10">10 per halaman</option>
            <option value="25">25 per halaman</option>
            <option value="50">50 per halaman</option>
        </select>
    </div>

    <!-- Tabel PKL -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left">Siswa</th>
                    <th class="py-3 px-4 text-left">Industri</th>
                    <th class="py-3 px-4 text-left">Guru</th>
                    <th class="py-3 px-4 text-left">Tanggal Mulai</th>
                    <th class="py-3 px-4 text-left">Tanggal Selesai</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pklList as $pkl)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $pkl->siswa->nama ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $pkl->industri->nama ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $pkl->guru->nama ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $pkl->tanggal_mulai->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">{{ $pkl->tanggal_selesai->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs 
                                {{ $pkl->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($pkl->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($pkl->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('pkl.edit', $pkl->id) }}" 
                               class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                            
                            @if(auth()->user()->role === 'admin')
                                <button wire:click="confirmDelete({{ $pkl->id }})" 
                                        class="text-red-500 hover:text-red-700">
                                    Hapus
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">
                            Tidak ada data PKL ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pklList->links() }}
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @if($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
                <p class="mb-6">Anda yakin ingin menghapus laporan PKL ini?</p>
                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('confirmingDelete', null)" 
                            class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                        Batal
                    </button>
                    <button wire:click="delete({{ $confirmingDelete }})" 
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>