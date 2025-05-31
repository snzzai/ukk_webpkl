<div class="p-4">
    <div class="relative mb-6 w-full grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-6 flex justify-start items-center">
            <a href="{{ route('guru.create') }}" class="bg-[#FEA1A1] text-[#fdfdfa] px-6 py-3 rounded-md hover:bg-[#FD6F6F] transition duration-200 shadow-[5px_5px_5px_#ECCDB4]">
                Tambah Guru
            </a>
        </div>
        <div class="col-span-12 md:col-span-6 flex justify-end items-center space-x-4">
            <div class="flex items-center space-x-2 shadow-[5px_5px_5px_#ECCDB4] rounded-lg bg-[#F9FBE7]">
                <label for="search" class="text-sm font-medium text-[#FEA1A1] ml-3">Search:</label>
                <input wire:model.live="search" id="search" type="text" placeholder="Search siswa..." class="text-[#e57163] w-full md:w-72 px-4 py-2 border border-[#F0EDD4] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F9FBE7] transition duration-150 ease-in-out ">
            </div>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="bg-[#F9FBE7] text-[#FEA1A1] p-2 mb-4 rounded text-center">
            {{ session('message') }}
        </div>
    @endif
    <div class="overflow-x-auto bg-[#F9FBE7] shadow-sm rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-[#333333] dark:text-gray-400">
            <thead class="text-xs text-[#fdfdfa] uppercase bg-[#ECCDB4]">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">NIP</th>
                    <th scope="col" class="px-6 py-3">Kontak</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                </tr>
            </thead>
            <tbody>
                @if ($guruList && $guruList->count())
                    @foreach ($guruList as $guru)
                    <tr class="border-b hover:bg-[#F0EDD4] transition duration-200">
                        <td class="px-6 py-3">{{ $guru->nama }}</td>
                        <td class="px-6 py-3">{{ $guru->nip }}</td>
                        <td class="px-6 py-3">{{ $guru->kontak }}</td>
                        <td class="px-6 py-3">{{ $guru->email }}</td>
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
                <select wire:model="numpage" id="perPage" 
                    class="px-3 py-2 border rounded-md bg-[#FEA1A1] text-[#fdfdfa]">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="{{ $guruList->total() }}">semua</option>
                </select>
                <span class="text-sm text-[#FEA1A1]">data per halaman</span>
            </div>

            <!-- Pagination Controls -->
            <div class="flex justify-end mt-4">
                <div class="bg-[#F9FBE7] rounded-md shadow-md p-2">
                {{ $guruList->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
