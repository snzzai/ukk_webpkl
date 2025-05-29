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
    public $pklList = [];
    public $siswaList = [];
    public $industriList = [];
    public $guruList = [];
    public $userMail;

    public function mount($id = null)
    {
        $this->userMail = Auth::user()->email;

        $this->pklList = PKL::all();
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
        $this->validate();

        DB::beginTransaction();

        try {
            $siswa = Siswa::where('email', $this->userMail)->first();

            if ($siswa && PKL::where('siswa_id', $siswa->id)->exists() && !$this->id) {
                DB::rollBack();
                session()->flash('error', 'Anda sudah pernah melaporkan PKL.');
                return;
            }

            PKL::updateOrCreate(
                ['id' => $this->id],
                [
                    'siswa_id' => $this->siswa_id,
                    'industri_id' => $this->industri_id,
                    'guru_id' => $this->guru_id,
                    'tanggal_mulai' => $this->tanggal_mulai,
                    'tanggal_selesai' => $this->tanggal_selesai
                ]
            );

            DB::commit();
            session()->flash('success', 'Laporan PKL berhasil disimpan.');
            return redirect()->route('pkl');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: '.$e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.pkl.form');
    }
}