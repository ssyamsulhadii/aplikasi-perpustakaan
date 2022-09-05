<?php

namespace App\Http\Livewire\TambahData;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Buku extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $bukuItem = false;
    public $state = [];
    public $buku = null;
    public $sampul;
    public $urlEditSampul;
    public function propertiReset()
    {
        $this->reset(['bukuItem', 'state', 'buku', 'sampul', 'urlEditSampul']);
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.tambah-data.buku', [
            'buku_' => ModelsBuku::latest()->limit(20)->paginate(5),
            'kategori_' => Kategori::has('rak')->get()->sortBy('rak.nama'),
        ]);
    }

    public function create()
    {
        $this->propertiReset();
        $this->dispatchBrowserEvent('show-form-modal');
    }
    public function validatedData()
    {
        $validate = $this->validate([
            'state.kategori_id' => 'required|exists:kategori,id',
            'state.sampul' => 'nullable|image|max:5024',
            'state.judul' => 'required|string',
            'state.penulis' => 'required|string',
            'state.penerbit' => 'required|string',
            'state.dibaca' => 'required|integer',
            'state.jumlah' => 'required|integer',
        ], [
            'state.kategori_id.required' => 'Kategori buku wajib dipilih.',
            'state.judul.required' => 'Judul buku wajib diiisi.',
            'state.penulis.required' => 'Nama penulis wajib diisi.',
            'state.penerbit.required' => 'Tempat penerbit wajib diisi.',
            'state.jumlah.required' => 'Jumlah buku wajib diisi.',
            'state.jumlah.integer' => 'Jumlah buku harus berupa angka.',
            'state.dibaca.required' => 'Buku dibaca wajib diisi.',
            'state.dibaca.integer' => 'Buku dibaca harus berupa angka.',
        ]);
        return $validate['state'];
    }
    public function store()
    {
        if ($this->sampul) {
            $this->state['sampul'] = $this->sampul;
            $validatedData =  $this->validatedData();
            $nama_file = $this->sampul->hashName();
            $validatedData['sampul'] = $nama_file;
            $this->sampul->storeAs('sampul', $nama_file);
        } else {
            $validatedData = $this->validatedData();
        }
        ModelsBuku::create($validatedData);
        $this->propertiReset();
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data buku berhasil ditambahkan."]);
    }

    public function edit(ModelsBuku $buku)
    {

        $this->propertiReset();
        $this->bukuItem = true;
        $this->buku = $buku;
        $this->dispatchBrowserEvent('show-form-modal');
        $this->state = $buku->only(['kategori_id', 'judul', 'penulis', 'penerbit', 'jumlah', 'dibaca', 'sampul']);
        if ($buku->sampul === null) {
            $this->urlEditSampul =  asset('storage/sampul/default.jpg');
        } else {
            $this->urlEditSampul =  asset('storage/sampul/' . $buku->sampul);
        }
    }

    public function update()
    {
        if ($this->sampul) {
            Storage::delete('sampul/' . $this->buku->sampul); //hapus photo lama
            $this->state['sampul'] = $this->sampul;
            $validatedData =  $this->validatedData();
            $nama_file = $this->sampul->hashName();
            $validatedData['sampul'] = $nama_file;
            $this->sampul->storeAs('sampul', $nama_file);
        } else {
            $validatedData = $this->validatedData();
        }
        $this->buku->update($validatedData);
        $this->propertiReset();
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', ['teks' => "Data buku berhasil diperbarui."]);
    }

    public function distroy(ModelsBuku $buku)
    {
        $buku->delete();
        $this->dispatchBrowserEvent('pesan', ['teks' => "Buku $buku->judul berhasil dihapus."]);
    }

    protected function cleanupOldUploads()
    {
        $storage = Storage::disk('public');
        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            if (!$storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subSeconds(5)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }
}
