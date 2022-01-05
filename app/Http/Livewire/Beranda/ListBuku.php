<?php

namespace App\Http\Livewire\Beranda;

use App\Models\Buku;
use Livewire\Component;
use Livewire\WithPagination;

class ListBuku extends Component
{
    use WithPagination;
    public $cari = null;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $buku = Buku::where('judul', 'like', "%$this->cari%")->orderBy('judul')->paginate(9);

        return view('livewire.beranda.list-buku', [
            'buku_' => $buku,
        ]);
    }
    public function updatingCari()
    {
        $this->resetPage();
    }
}
