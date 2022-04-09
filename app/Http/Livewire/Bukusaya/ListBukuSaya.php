<?php

namespace App\Http\Livewire\Bukusaya;

use Livewire\Component;

class ListBukuSaya extends Component
{
    public function render()
    {
        $anggota = \App\Models\User::find(auth()->user()->id);
        return view('livewire.bukusaya.list-buku-saya', [
            'bukusaya_' => $anggota,
        ]);
    }
}
