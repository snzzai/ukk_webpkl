<?php

namespace App\Livewire\Pkl;

use App\Models\Guru;
use App\Models\Industri;
use App\Models\PKL;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class Form extends Component
{
    public $id, $siswa_id, $industri_id, $guru_id, $tanggal_mulai, $tanggal_selesai;
    public $siswaList = [];
    public $industriList = [];
    public $guruList = [];
    public $userMail;

    public function mount($id = null)
    {
        $user = auth()->user();
        $this->userMail = $user->email;

        // Validasi untuk siswa
        if ($user->role === 'siswa') {
            if (!$user->siswa) {
                session()->flash('error', 'Akun Anda belum terhubung dengan data siswa');
                return redirect()->route('pkl');
            }

            if (!$id && $user->siswa->pkl) {
                session()->flash('error', 'Anda sudah membuat laporan PKL sebelumnya');
                return redirect()->route('pkl');
            }
        }

        $this->siswaList = Siswa::all();
        $this->industriList = Industri::all();
        $this->guruList = Guru::all();

        if ($id) {
            $pkl = PKL::findOrFail($id);
            $this->id = $pkl->id;
            $this->siswa_id = $pkl->siswa_id;
            $this->industri_id = $pkl->industri_id;
            $this->guru_id = $pkl->guru_id;
            $this->tanggal_mulai = $pkl->tanggal_mulai->format('Y-m-d');
            $this->tanggal_selesai = $pkl->tanggal_selesai->format('Y-m-d');
        } else {
            // Auto-set siswa yang login jika ada
            if ($user->siswa) {
                $this->siswa_id = $user->siswa->id;
            }
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
                'after:tanggal_mulai',
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
        $this->validate([
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
                function ($attribute, $value, $fail) {
                    $start = \Carbon\Carbon::parse($this->tanggal_mulai);
                    $end = \Carbon\Carbon::parse($value);
                    if ($start->diffInDays($end) < 90) {
                        $fail('Durasi PKL minimal 90 hari');
                    }
                }
            ],
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user();
            
            // Validasi untuk siswa yang sudah memiliki PKL
            if ($user->role === 'siswa') {
                if (!$user->siswa) {
                    throw new \Exception('Akun Anda belum terhubung dengan data siswa');
                }
                
                if (PKL::where('siswa_id', $user->siswa->id)
                    ->where('id', '!=', $this->id)
                    ->exists()) {
                    throw new \Exception('Anda sudah membuat laporan PKL sebelumnya');
                }
                
                $this->siswa_id = $user->siswa->id; // Otomatis set siswa_id
            }

            $pklData = [
                'siswa_id' => $this->siswa_id,
                'industri_id' => $this->industri_id,
                'guru_id' => $this->guru_id,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
                'status' => 'pending'
            ];

            PKL::updateOrCreate(['id' => $this->id], $pklData);

            DB::commit();
            session()->flash('success', 'Laporan PKL berhasil dikirim');
            return redirect()->route('pkl');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan: '.$e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.pkl.form');
    }
}