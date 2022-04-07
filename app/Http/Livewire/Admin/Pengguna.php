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
        $level_ = \App\Models\Level::all();
        return view('livewire.admin.pengguna', [
            'pengguna_' => User::orderBy('level_id')->latest()->paginate(4),
            'level_' => $level_
        ]);
    }

    public function pilihLevel(User $pengguna, $level_id)
    {
        $validator = Validator::make(['level_id' => $level_id], [
            'level_id' => 'required|exists:level,id',
        ]);
        if ($validator->fails()) {
            if (key_exists('level', $validator->errors()->getMessages())) {
                $this->dispatchBrowserEvent('pesan', [
                    'teks' => "Level pengguna gagal diperbarui.",
                    'background' => "red"
                ]);
            }
        } else {
            $pengguna->update(['level_id' => $level_id]);
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Level Pengguna $pengguna->nama  berhasil diperbarui.",
            ]);
        }
    }
}
