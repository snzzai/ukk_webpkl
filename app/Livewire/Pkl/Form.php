<?php

namespace App\Livewire\Pkl;

use App\Models\Guru;
use App\Models\Industri;
use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class Form extends Component
{
    public $id, $siswa_id, $industri_id, $guru_id, $tanggal_mulai, $tanggal_selesai;
    public $siswaList = [], $industriList = [], $guruList = [];
    public $confirmingDelete = false;

    public function mount($id = null)
    {
        $user = Auth::user();
        
        // Validasi untuk siswa
        if ($user->role === 'siswa') {
            if (!$user->siswa) {
                session()->flash('error', 'Akun Anda belum terhubung dengan data siswa');
                return redirect()->route('pkl');
            }

            // Jika sudah punya PKL dan bukan mode edit
            if (!$id && $user->siswa->pkl) {
                session()->flash('error', 'Anda sudah membuat laporan PKL sebelumnya');
                return redirect()->route('pkl');
            }
        }

        $this->siswaList = Siswa::all();
        $this->industriList = Industri::all();
        $this->guruList = Guru::all();

        if ($id) {
            $pkl = Pkl::findOrFail($id);
            $this->id = $pkl->id;
            $this->siswa_id = $pkl->siswa_id;
            $this->industri_id = $pkl->industri_id;
            $this->guru_id = $pkl->guru_id;
            $this->tanggal_mulai = $pkl->tanggal_mulai->format('Y-m-d');
            $this->tanggal_selesai = $pkl->tanggal_selesai->format('Y-m-d');
        } elseif ($user->siswa) {
            $this->siswa_id = $user->siswa->id;
        }
    }

    public function rules()
    {
        return [
            'siswa_id' => 'required|exists:siswa,id',
            'industri_id' => 'required|exists:industri,id',
            'guru_id' => 'required|exists:guru,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
                function ($attribute, $value, $fail) {
                    $start = Carbon::parse($this->tanggal_mulai);
                    $end = Carbon::parse($value);
                    if ($start->diffInDays($end) < 90) {
                        $fail('Durasi PKL minimal 90 hari');
                    }
                },
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $user = Auth::user();
            
            // Validasi untuk siswa
            if ($user->role === 'siswa') {
                if (!$user->siswa) {
                    throw new \Exception('Akun Anda belum terhubung dengan data siswa');
                }
                
                // Cek apakah sudah punya PKL (kecuali sedang edit)
                if (Pkl::where('siswa_id', $user->siswa->id)
                    ->where('id', '!=', $this->id)
                    ->exists()) {
                    throw new \Exception('Anda sudah membuat laporan PKL sebelumnya');
                }
                
                $this->siswa_id = $user->siswa->id; // Force set siswa_id
            }

            $pklData = [
                'siswa_id' => $this->siswa_id,
                'industri_id' => $this->industri_id,
                'guru_id' => $this->guru_id,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
                'status' => 'pending'
            ];

            Pkl::updateOrCreate(['id' => $this->id], $pklData);

            DB::commit();
            session()->flash('success', 'Laporan PKL berhasil ' . ($this->id ? 'diperbarui' : 'dikirim'));
            return redirect()->route('pkl');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pkl.form');
    }
}