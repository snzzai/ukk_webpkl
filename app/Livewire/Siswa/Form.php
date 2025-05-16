<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Siswa;


class Form extends Component
{
    // Deklarasi variabelnya
    public $id, $nama, $nis, $gender, $alamat, $kontak, $email;
    public $status_pkl = 'no';

    // Mount untuk setiap kolom
    public function mount($id = null)
    {
        if ($id) {
            $siswa = Siswa::findOrFail($id);
            $this->id = $siswa->id;
            $this->nama = $siswa->nama;
            $this->nis = $siswa->nis;
            $this->gender = $siswa->gender;
            $this->alamat = $siswa->alamat;
            $this->kontak = $siswa->kontak;
            $this->email = $siswa->email;
            $this->status_pkl = $siswa->status_pkl;
        }
    }

    // Validasi kolom (yang wajib diisi)
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:siswa,nis,' . $this->id,
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:siswa,email,' . $this->id,
            'status_pkl' => 'required|in:no,yes',
        ];
    }

    // Simpan data
    public function save()
    {
        $this->validate();

        Siswa::updateOrCreate(
            ['id' => $this->id],
            [
                'nama' => $this->nama,
                'nis' => $this->nis,
                'gender' => $this->gender,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'status_pkl' => $this->status_pkl,
            ]
        );

        session()->flash('message', 'Data siswa berhasil disimpan.');

        return redirect()->route('siswa');
    }

    // Render
    public function render()
    {
        return view('livewire.siswa.form');
    }

}
