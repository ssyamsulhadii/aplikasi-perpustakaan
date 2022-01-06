<?php

namespace App\Http\Livewire\TambahData;

use App\Models\Rak as ModelsRak;
use Livewire\Component;

class Rak extends Component
{
    public $nama;
    public $rak = null;
    public $rakItem = false;
    public function render()
    {
        return view('livewire.tambah-data.rak', [
            'rak_' => ModelsRak::with('kategori_')->orderBy('nama')->get(),
        ]);
    }
    public function create()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function store()
    {
        ModelsRak::create(
            $this->validate([
                'nama' => 'required|string'
            ], [
                'nama.required' => 'Nama rak buku wajib diiisi.'
            ])
        );
        $this->reset();
        $this->resetValidation();
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data rak buku berhasil ditambahkan."]);
    }

    public function editWithDelete(ModelsRak $rak)
    {
        $this->reset();
        $this->resetValidation();
        $this->rakItem = true;
        $this->dispatchBrowserEvent('show-form-modal');
        $this->rak = $rak;
        $this->nama = $rak->nama;
    }
    public function update()
    {
        $this->rak->update(
            $this->validate([
                'nama' => 'required|string'
            ], [
                'nama.required' => 'Nama rak buku wajib diiisi.'
            ])
        );
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data rak buku berhasil diperbarui."]);
        $this->emit('hideModal');
    }

    public function distroy()
    {
        $this->rak->delete();
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data rak buku berhasil dihapus."]);
        $this->emit('hideModal');
    }
}
