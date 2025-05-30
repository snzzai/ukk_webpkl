<?php

namespace App\Livewire\Pkl;

use App\Models\Pkl;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;

    public $numpage = 10;
    public $search;
    public $confirmingDelete = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }

    public function delete($id)
    {
        // Hanya admin yang bisa menghapus
        if (auth()->user()->role !== 'admin') {
            session()->flash('error', 'Hanya admin yang dapat menghapus laporan PKL');
            return;
        }

        Pkl::findOrFail($id)->delete();
        session()->flash('success', 'Data PKL berhasil dihapus');
        $this->confirmingDelete = null;
    }

    public function render()
    {
        $query = Pkl::with(['siswa', 'industri', 'guru']);

        if ($this->search) {
            $query->whereHas('siswa', function($q) {
                    $q->where('nama', 'like', '%'.$this->search.'%');
                })
                ->orWhereHas('industri', function($q) {
                    $q->where('nama', 'like', '%'.$this->search.'%');
                })
                ->orWhereHas('guru', function($q) {
                    $q->where('nama', 'like', '%'.$this->search.'%');
                });
        }

        // Jika siswa, hanya tampilkan PKL miliknya
        if (auth()->user()->role === 'siswa' && auth()->user()->siswa) {
            $query->where('siswa_id', auth()->user()->siswa->id);
        }

        $pklList = $query->paginate($this->numpage);

        return view('livewire.pkl.view', [
            'pklList' => $pklList,
        ]);
    }
}