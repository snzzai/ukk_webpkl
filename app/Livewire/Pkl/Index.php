<?php

namespace App\Livewire\Pkl;

use App\Models\PKL;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $numpage = 10;
    public $search;
    public $isAdmin = false;

    public function mount()
    {
        $this->isAdmin = auth()->user()->role === 'admin';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        // Hanya admin yang bisa menghapus
        if (auth()->user()->role !== 'admin') {
            session()->flash('error', 'Hanya admin yang dapat menghapus data PKL');
            return;
        }

        PKL::findOrFail($id)->delete();
        session()->flash('success', 'Data PKL berhasil dihapus');
    }

    public function render()
    {
        $query = PKL::query();

        if (!empty($this->search)) {
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

        $user = auth()->user();
        $hasSiswa = $user->siswa !== null;
        $hasPkl = $hasSiswa && $user->siswa->pkl;

        if ($user->role === 'siswa' && $hasSiswa) {
            $query->where('siswa_id', $user->siswa->id);
        }

        $pklList = $query->with(['siswa', 'industri', 'guru'])
                        ->latest('tanggal_mulai')
                        ->paginate($this->numpage);

        return view('livewire.pkl.index', [
            'pklList' => $pklList,
            'isAdmin' => $user->role === 'admin',
            'hasSiswa' => $hasSiswa,
            'hasPkl' => $hasPkl
        ]);
    }
}