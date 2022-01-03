<?php

namespace App\Http\Livewire\Pengguna;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Livewire\Component;

class Profil extends Component
{
    public $state = [];
    public function render()
    {
        return view('livewire.pengguna.profil');
    }

    public function mount()
    {
        $this->state = auth()->user()->only(['nama', 'email', 'telpon', 'alamat']);
    }

    public function updateProfil(UpdateUserProfileInformation $updater)
    {
        $updater->update(auth()->user(), [
            'nama' => $this->state['nama'],
            'email' => $this->state['email'],
            'telpon' => $this->state['telpon'],
            'alamat' => $this->state['alamat'],
        ]);
        $this->emit('namaBaru', auth()->user()->nama);
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Profil kamu berhasil diperbarui",
        ]);
    }
}
