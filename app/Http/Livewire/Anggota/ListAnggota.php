<?php

namespace App\Http\Livewire\Anggota;

use App\Models\User;
use Livewire\Component;

class ListAnggota extends Component
{
    public function render()
    {
        return view('livewire.anggota.list-anggota', [
            'anggota_' => User::where('level', 'anggota')->paginate()
        ]);
    }
}
