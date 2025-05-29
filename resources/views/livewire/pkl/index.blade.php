<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Laporan PKL</h1>
        
        @if($isAdmin || ($hasSiswa && !$hasPkl))
            <a href="{{ route('pkl.create') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Laporan
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(auth()->user()->role === 'siswa')
        @if(!$hasSiswa)
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                <p class="text-red-700">Akun Anda belum terhubung dengan data siswa</p>
            </div>
        @elseif(!$hasPkl)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                <p class="text-blue-700">
                    Anda belum membuat laporan PKL. 
                    <a href="{{ route('pkl.create') }}" class="font-medium underline">
                        Buat laporan sekarang
                    </a>
                </p>
            </div>
        @endif
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
                        <th class="py-3 px-4 text-left">Status</th>
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
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$pkl->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($pkl->status) }}
                                </span>
                            </td>
                            <!-- Di bagian tombol aksi -->
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('pkl.edit', $pkl->id) }}" 
                                    class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    
                                    @if(auth()->user()->role === 'siswa')
                                        @if(!$hasSiswa)
                                            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                                                <p class="text-red-700">Anda belum terdaftar sebagai siswa</p>
                                            </div>
                                        @elseif($pklList->isEmpty())
                                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                                                <p class="text-blue-700">
                                                    Anda belum membuat laporan PKL. 
                                                    <a href="{{ route('pkl.create') }}" class="font-medium underline">
                                                        Buat laporan sekarang
                                                    </a>
                                                </p>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-4 px-4 text-center text-gray-500">
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