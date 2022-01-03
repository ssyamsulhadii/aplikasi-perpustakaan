<?php

namespace App\Http\Livewire\Pengguna;

use App\Actions\Fortify\UpdateUserPassword;
use Livewire\Component;

class GantiPassword extends Component
{
    public $state = [];
    public function render()
    {
        return view('livewire.pengguna.ganti-password');
    }

    public function updatePassword(UpdateUserPassword $updater)
    {
        $updater->update(
            auth()->user(),
            $attributes = \Illuminate\Support\Arr::only($this->state, ['current_password', 'password', 'password_confirmation'])
        );
        collect($attributes)->map(fn ($value, $key) => $this->state[$key] = '');
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Password kamu berhasil diperbarui",
        ]);
    }
}
