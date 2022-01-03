<?php

namespace App\Http\Livewire\TambahData;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use App\Models\Rak;
use Livewire\Component;
use Livewire\WithPagination;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $bukuItem = false;
    public $state = [];
    public $buku = null;
    public function render()
    {
        return view('livewire.tambah-data.buku', [
            'buku_' => ModelsBuku::latest()->limit(20)->paginate(5),
            'kategori_' => Kategori::has('rak')->get()->sortBy('rak.nama'),
        ]);
    }

    public function create()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatchBrowserEvent('show-form-modal');
    }
    public function validatedData()
    {
        $validate = $this->validate([
            'state.kategori_id' => 'required|exists:kategori,id',
            'state.judul' => 'required|string',
            'state.penulis' => 'required|string',
            'state.penerbit' => 'required|string',
            'state.dibaca' => 'required|integer',
            'state.jumlah' => 'required|integer',
        ], [
            'state.judul.required' => 'Judul buku wajib diiisi.',
            'state.penulis.required' => 'Nama penulis wajib diisi.',
            'state.penerbit.required' => 'Tempat penerbit wajib diisi.',
        ]);
        return $validate['state'];
    }
    public function store()
    {
        $validatedData = $this->validatedData();
        ModelsBuku::create($validatedData);
        $this->reset();
        $this->resetValidation();
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data buku berhasil ditambahkan."]);
    }

    public function edit(ModelsBuku $buku)
    {
        $this->reset();
        $this->resetValidation();
        $this->bukuItem = true;
        $this->buku = $buku;
        $this->dispatchBrowserEvent('show-form-modal');
        $this->state = $buku->only(['kategori_id', 'judul', 'penulis', 'penerbit', 'jumlah', 'dibaca', 'sampul']);
    }

    public function update()
    {
        $validatedData = $this->validatedData();
        $this->buku->update($validatedData);
        $this->reset();
        $this->resetValidation();
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data buku berhasil diperbarui."]);
    }

    public function distroy(ModelsBuku $buku)
    {
        $buku->delete();
        $this->dispatchBrowserEvent('pesan', ['teks' => "Buku $buku->judul berhasil dihapus."]);
    }
}
