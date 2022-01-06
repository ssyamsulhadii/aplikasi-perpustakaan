<?php

namespace App\Http\Livewire\Bukusaya;

use App\Models\Anggota;
use Livewire\Component;

class ListBukuSaya extends Component
{
    public function render()
    {
        $anggota = Anggota::firstWhere('user_id', auth()->user()->id);
        return view('livewire.bukusaya.list-buku-saya', [
            'bukusaya_' => $anggota->peminjaman_,
        ]);
    }
}
