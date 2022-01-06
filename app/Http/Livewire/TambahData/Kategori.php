<?php

namespace App\Http\Livewire\TambahData;

use App\Models\Kategori as ModelsKategori;
use Livewire\Component;

class Kategori extends Component
{
    public $kategoriItem = false;
    public $kategori = null;
    public $state = [];

    public function render()
    {
        return view('livewire.tambah-data.kategori', [
            'rak_' => \App\Models\Rak::orderBy('nama')->get(),
            'kategori_' => ModelsKategori::with('buku_')->get()->sortBy('rak.nama'),
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
        $validatedData = $this->validate([
            'state.rak_id' => 'required|exists:rak,id',
            'state.nama' => 'required',
        ], [
            'state.rak_id.required' => 'Rak buku wajib dipilih.',
            'state.nama.required' => 'Nama kategori wajib diisi.'
        ]);
        ModelsKategori::create($validatedData['state']);
        $this->reset();
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data ketegori buku berhasil ditambahkan."]);
    }

    public function updateWithDelete(ModelsKategori $kategori)
    {
        $this->reset();
        $this->resetValidation();
        $this->kategoriItem = true;
        $this->kategori = $kategori;
        $this->state = $kategori->only(['nama', 'rak_id']);
        $this->dispatchBrowserEvent('show-form-modal', ['rakId' => (string) $kategori->rak_id]);
    }
    public function update()
    {
        if (is_array($this->state['rak_id'])) {
            $this->state['rak_id'] = $this->state['rak_id']['value'];
        }
        $validatedData = $this->validate([
            'state.rak_id' => 'required|exists:rak,id',
            'state.nama' => 'required',
        ], [
            'state.nama.required' => 'Nama kategori wajib diisi.'
        ]);

        $this->kategori->update($validatedData['state']);
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data kategori buku berhasil diperbarui."]);
        $this->emit('hideModal');
    }

    public function distroy()
    {
        $this->kategori->delete();
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data kategori buku berhasil dihapus."]);
        $this->emit('hideModal');
    }
}
