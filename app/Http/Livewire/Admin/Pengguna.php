<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class Pengguna extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {

        return view('livewire.admin.pengguna', [
            'pengguna_' => User::orderBy('level')->latest()->paginate(4)
        ]);
    }

    public function pilihLevel(User $pengguna, $level)
    {
        $validator = Validator::make(['level' => $level], [
            'level' => 'required|in:admin,adminbuku,admintransaksi,anggota',
        ]);
        if ($validator->fails()) {
            if (key_exists('level', $validator->errors()->getMessages())) {
                $this->dispatchBrowserEvent('pesan', [
                    'teks' => "Level pengguna gagal diperbarui.",
                    'background' => "red"
                ]);
            }
        } else {
            $pengguna->update(['level' => $level]);
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Level pengguna  $level  berhasil diperbarui.",
            ]);
        }
    }
}
