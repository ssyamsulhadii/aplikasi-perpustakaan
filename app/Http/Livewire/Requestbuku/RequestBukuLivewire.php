<?php

namespace App\Http\Livewire\Requestbuku;

use App\Models\RequestBuku;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class RequestBukuLivewire extends Component
{
    use WithFileUploads;
    public $bukuItem = false;
    public $sampul;
    public $state = [];
    public $rules = [
        'state.sampul' => 'nullable|image|max:5024',
        'state.judul' => 'required|string',
        'state.penulis' => 'required|string',
        'state.penerbit' => 'required|string',
        'state.keterangan' => 'required|string',
    ];
    public function render()
    {
        return view('livewire.requestbuku.request-buku-livewire');
    }
    function store()
    {
        $this->validate();
        if ($this->sampul) {
            $this->state['sampul'] = $this->sampul;
            $this->validate();
            $nama_file = $this->sampul->hashName();
            $this->state['sampul'] = $nama_file;
            $this->sampul->storeAs('request-buku', $nama_file);
        }
        $this->state['user_id'] = auth()->user()->id;
        RequestBuku::create($this->state);
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Request buku berhasil dikiirm. Mohon tunggu, untuk pengadaan buku.",
        ]);
        $this->reset();
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
