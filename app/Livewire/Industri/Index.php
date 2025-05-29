<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;

    public $numpage = 10;
    public $search;

    public function updatingNumpage($value)
    {
        $this->resetPage(); // Reset ke halaman pertama saat mengubah jumlah item per halaman
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Industri::findOrFail($id)->delete();
        session()->flash('message', 'Data industri berhasil dihapus.');
    }

    public function render()
{
    $query = Industri::with('guru'); // Pastikan baris ini ada

    if (!empty($this->search)) {
        $query->where('nama', 'like', '%' . $this->search . '%')
              ->orWhereHas('guru', function ($q) {
                  $q->where('nama', 'like', '%' . $this->search . '%');
              });
    }

    $this->industriList = $query->paginate($this->numpage);

    return view('livewire.industri.index', [
        'industriList' => $this->industriList,
    ]);
}


}
