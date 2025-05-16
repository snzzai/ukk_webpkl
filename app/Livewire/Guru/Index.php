<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;
use Livewire\WithPagination;


class Index extends Component
{
    // Memanggil pagination
    use WithPagination;

    // Function search
    public $search;

    // Tidak pakai numpage, karena data guru hanya sedikit. Memang tetap pakai pagination karena diharuskan dari sananya :)

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Function delete
    public function delete($id)
    {
        Guru::findOrFail($id)->delete();
        session()->flash('message', 'Data guru berhasil dihapus.');
    }

    // Function render
    public function render()
    {
        $query = Guru::query();

        // If there's a search term, filter the records
        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%');
        }

        // Get the results after applying the search filter
        $guruList = $query->get();

        return view('livewire.guru.index', [
            'guruList' => $guruList, // Pass the result to the view
        ]);
    }
    
    // Function gender guru
    public function ketGender($gender)
    {
        if ($gender === 'L') {
            return 'Laki-laki';
        } elseif ($gender === 'P') {
            return 'Perempuan';
        } else {
            return 'Status tidak diketahui';
        }
    }

}
