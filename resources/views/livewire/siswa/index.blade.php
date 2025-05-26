<div class="p-4">
    <div class="relative mb-6 w-full grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-6 flex justify-start items-center">
            <a href="{{ route('siswa.create') }}" class="bg-[#FEA1A1] text-[#fdfdfa] px-6 py-3 rounded-md hover:bg-[#FD6F6F] transition duration-200 shadow-[5px_5px_5px_#ECCDB4]">
                Tambah Siswa
            </a>
        </div>
        <div class="col-span-12 md:col-span-6 flex justify-end items-center space-x-4">
            <!-- Search form -->
            <div class="flex items-center space-x-2 shadow-[5px_5px_5px_#ECCDB4] rounded-lg bg-[#F9FBE7]">
                <label for="search" class="text-sm font-medium text-[#FEA1A1] ml-3">Search:</label>
                <input wire:model.live="search" id="search" type="text" placeholder="Search siswa..." class="text-[#e57163] w-full md:w-72 px-4 py-2 border border-[#F0EDD4] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F9FBE7] transition duration-150 ease-in-out ">
            </div>
        </div>
    </div>

    <!-- Pesan Session -->
    @if (session()->has('message'))
        <div class="bg-[#F9FBE7] text-[#FEA1A1] p-2 mb-4 rounded text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-[#F9FBE7] shadow-sm rounded-lg ">
        <table class="w-full text-sm text-left rtl:text-right text-[#333333] dark:text-gray-400 ">
            <thead class="text-xs text-[#fdfdfa] uppercase bg-[#ECCDB4]">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">NIS</th>
                    <th scope="col" class="px-6 py-3">Status PKL</th>
                    <th scope="col" class="px-6 py-3">Kontak</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($siswaList && $siswaList->count())
                    @foreach ($siswaList as $siswa)
                        <tr class="border-b hover:bg-[#F0EDD4] transition duration-200">
                            <td class="px-6 py-3">{{ $siswa->nama }}</td>
                            <td class="px-6 py-3">{{ $siswa->nis }}</td>
                            <td class="px-6 py-3">{{ $this->ketStatusPKL($siswa->status_pkl) }}</td>
                            <td class="px-6 py-3">{{ $siswa->kontak }}</td>
                            <td class="px-6 py-3 text-center">
                                <div x-data="{ open: false }" class="inline-block text-left">
                                    <button @click="open = !open" class="text-[#FEA1A1] hover:text-[#F9FBE7] focus:outline-none transition duration-200">
                                        &#8942;
                                    </button>
                                    <div x-show="open" x-transition @click.away="open = false"
                                        class="absolute right-0 mt-2 w-36 bg-[#F9FBE7] border border-[#F0EDD4] rounded shadow-md z-50">
                                        <a href="{{ route('siswa.show', ['id' => $siswa->id]) }}"
                                        class="block px-4 py-2 text-sm text-[#FEA1A1] hover:bg-[#F0EDD4] transition duration-150">View</a>
                                        <a href="{{ route('siswa.edit', ['id' => $siswa->id]) }}"
                                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-[#F0EDD4] transition duration-150">Edit</a>
                                        <button wire:click="delete({{ $siswa->id }})"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-[#F0EDD4] transition duration-150">Hapus</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center py-4 text-[FEA1A1]">Tidak ada data ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="my-4">
        <!-- Pagination Links -->
        <div class="flex justify-between items-center mb-4">
            <!-- Page Size Selection -->
            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-sm font-medium text-[#FEA1A1]">Tampilkan:</label>
                <select wire:model="numpage" wire:change="updatePageSize($event.target.value)" id="perPage" class="px-3 py-2 border rounded-md bg-[#FEA1A1] text-[#fdfdfa]">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="{{ $siswaList->total() }}">semua</option>
                </select>
                <span class="text-sm text-[#FEA1A1]">data per halaman</span>
            </div>

            <!-- Pagination Controls -->
        <div class="flex justify-end mt-4 text-[FEA1A1]">
            <div class="bg-[#F9FBE7] rounded-md shadow-md p-2">
               {{ $siswaList->links() }}
            </div>
        </div>

        </div>
    </div>
</div>
