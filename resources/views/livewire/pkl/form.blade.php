<div class="p-6 max-w-3xl mx-auto shadow-lg rounded-lg" style="background: linear-gradient(to right, #F9FBE7, #F0EDD4);">
    <h2 class="text-2xl font-semibold mb-6 text-center">
        {{ $id ? 'Edit Laporan' : 'Lapor PKL' }}
    </h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nama Siswa -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <select wire:model="siswa_id" class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option value="">Cari nama anda</option>
                    @foreach($siswaList as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                    @endforeach
                </select>
                @error('siswa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Industri Tujuan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Industri Tujuan</label>
                <select wire:model="industri_id" class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option value="">Pilih industri tujuan anda</option>
                    @foreach($industriList as $industri)
                        <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                    @endforeach
                </select>
                @error('industri_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Guru Pembimbing -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Guru Pembimbing</label>
                <select wire:model="guru_id" class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option value="">Pilih guru pembimbing yang sesuai</option>
                    @foreach($guruList as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
                @error('guru_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input 
                    type="date" 
                    wire:model="tanggal_mulai" 
                    class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                @error('tanggal_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input 
                    type="date" 
                    wire:model="tanggal_selesai" 
                    class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    min="{{ $tanggal_mulai ? \Carbon\Carbon::parse($tanggal_mulai)->addDays(90)->format('Y-m-d') : '' }}"
                >
                @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                
                <!-- Tampilkan info durasi -->
                @if($tanggal_mulai && $tanggal_selesai)
                    @php
                        $start = \Carbon\Carbon::parse($tanggal_mulai);
                        $end = \Carbon\Carbon::parse($tanggal_selesai);
                        $diff = $start->diffInDays($end);
                    @endphp
                    <p class="text-sm mt-1 {{ $diff < 90 ? 'text-red-500' : 'text-green-500' }}">
                        Durasi: {{ $diff }} hari {{ $diff < 90 ? '(Minimal 90 hari)' : '' }}
                    </p>
                @endif
            </div>
        </div>

        <div class="flex justify-between pt-4">
            <a href="{{ route('pkl') }}" class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
                Batal
            </a>
            <button 
                type="submit" 
                wire:loading.attr="disabled"
                class="bg-[#FEA1A1] text-white px-6 py-3 rounded-md hover:bg-[#fd6f6f] focus:outline-none focus:ring-2 focus:ring-[#fd6f6f] transition"
            >
                <span wire:loading.remove>Simpan</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>