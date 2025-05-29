<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center">
        {{ $id ? 'Edit Laporan PKL' : 'Buat Laporan PKL' }}
    </h2>

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

    <!-- Info untuk siswa -->
    @if(auth()->user()->role === 'siswa')
        <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
            <p class="text-blue-700">
                Anda membuat laporan sebagai: 
                <strong>{{ auth()->user()->siswa->nama ?? 'N/A' }}</strong>
            </p>
            @if(auth()->user()->siswa->pkl && !$id)
                <p class="mt-2 text-yellow-700">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Anda sudah memiliki laporan PKL. Hubungi admin untuk perubahan.
                </p>
            @endif
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Field siswa (hanya untuk admin) -->
            @if(auth()->user()->role !== 'siswa')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                    <select wire:model="siswa_id" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Siswa</option>
                        @foreach($siswaList as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                        @endforeach
                    </select>
                    @error('siswa_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            @endif

            <!-- Industri -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Industri Tujuan</label>
                <select wire:model="industri_id" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Industri</option>
                    @foreach($industriList as $industri)
                        <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                    @endforeach
                </select>
                @error('industri_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Guru Pembimbing -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Guru Pembimbing</label>
                <select wire:model="guru_id" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Guru</option>
                    @foreach($guruList as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
                @error('guru_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" wire:model="tanggal_mulai" 
                       min="{{ now()->format('Y-m-d') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('tanggal_mulai') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" wire:model="tanggal_selesai" 
                       min="{{ $tanggal_mulai ? \Carbon\Carbon::parse($tanggal_mulai)->addDay()->format('Y-m-d') : '' }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('tanggal_selesai') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                
                <!-- Info Durasi -->
                @if($tanggal_mulai && $tanggal_selesai)
                    @php
                        $start = \Carbon\Carbon::parse($tanggal_mulai);
                        $end = \Carbon\Carbon::parse($tanggal_selesai);
                        $diff = $start->diffInDays($end);
                    @endphp
                    <p class="text-sm mt-2 {{ $diff < 90 ? 'text-red-500' : 'text-green-500' }}">
                        Durasi: {{ $diff }} hari {{ $diff < 90 ? '(Minimal 90 hari)' : '' }}
                    </p>
                @endif
            </div>
        </div>

        <div class="flex justify-between pt-6">
            <a href="{{ route('pkl') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                Kembali
            </a>
            
            @if(!(auth()->user()->role === 'siswa' && auth()->user()->siswa->pkl && !$id))
                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">
                    <span wire:loading.remove>{{ $id ? 'Update' : 'Simpan' }}</span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...
                    </span>
                </button>
            @endif
        </div>
    </form>
</div>