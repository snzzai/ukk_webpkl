<div class="p-4">
    <div class="relative mb-6 w-full grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-6 flex justify-start items-center">
            <a href="{{ route('pkl.create') }}" class="bg-[#FEA1A1] text-[#fdfdfa] px-6 py-3 rounded-md hover:bg-[#FD6F6F] transition duration-200 shadow-[5px_5px_5px_#ECCDB4]">
                Tambah PKL
            </a>
        </div>
        <div class="col-span-12 md:col-span-6 flex justify-between items-center space-x-4">
        <!-- Pagination Links -->
        <div class="flex justify-between items-center mb-4">
            <!-- Page Size Selection -->
            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-sm font-medium text-[#FEA1A1]">Tampilkan:</label>
                <select wire:model="numpage" wire:change="updatePageSize($event.target.value)" id="perPage" class="px-3 py-2 border rounded-md bg-[#FEA1A1] text-[#fdfdfa]">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="{{ $pklList->total() }}">semua</option>
                </select>
                <span class="text-sm text-[#FEA1A1]">data per halaman</span>

            </div>
            
            <!-- Pagination Controls -->
            <div class="flex justify-end mt-4 text-[FEA1A1]">
                {{ $pklList->links() }}
            </div>
        </div>
    </div>
</div>
