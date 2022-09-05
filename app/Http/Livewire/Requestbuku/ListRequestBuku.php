<?php

namespace App\Http\Livewire\Requestbuku;

use App\Models\RequestBuku;
use Livewire\Component;

class ListRequestBuku extends Component
{
    public function render()
    {
        $requestBuku_ = RequestBuku::latest()->paginate(5);
        return view('livewire.requestbuku.list-request-buku', compact('requestBuku_'));
    }

    function confirmation(RequestBuku $buku)
    {
        if ($buku->status == 'Yes') {
            $buku->update(['status' =>  false]);
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Pembatala request berhasil dikonfirmasi.",
            ]);
        } else {
            $buku->update(['status' =>  true]);
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Request buku berhasil dikonfirmasi.",
            ]);
        }
    }
}
