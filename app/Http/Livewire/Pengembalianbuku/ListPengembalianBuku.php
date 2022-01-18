<?php

namespace App\Http\Livewire\Pengembalianbuku;

use App\Models\Pengembalian;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListPengembalianBuku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pengembalian = null;
    public $bulan = [];
    public $state = [];
    public $stateTanggal = [];
    public $tanggal_kembali_over = false;
    public function render()
    {
        $this->bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('livewire.pengembalianbuku.list-pengembalian-buku', [
            'pengembalian_' => Pengembalian::OrderBy('tanggal_kembali', 'DESC')->paginate(5),
            'waktu_sekarang' => new \Carbon\Carbon(),
        ]);
    }
    public function propertiReset()
    {
        $this->reset(['pengembalian', 'bulan', 'state', 'stateTanggal', 'tanggal_kembali_over']);
        $this->resetValidation();
    }
    public function konfirmasi(Pengembalian $pengembalian)
    {
        $this->propertiReset();

        $this->bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $this->pengembalian = $pengembalian;

        // tanggal sekarang
        $tanggal = new Carbon;
        // $tanggal = new Carbon('08-01-2022');
        if ($tanggal > $pengembalian->peminjaman->tanggal_kembali) {
            $this->tanggal_kembali_over = true;
            $this->stateTanggal = [
                'tanggal_kembali' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('DD'),
                'bulan_kembali' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('MM'),
                'tahun_kembali' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('YYYY'),
                'tanggal_kembali_over' => $tanggal->isoFormat('DD'),
                'bulan_kembali_over' => $tanggal->isoFormat('MM'),
                'tahun_kembali_over' => $tanggal->isoFormat('YYYY'),
            ];
        } else {
            $this->stateTanggal = [
                'tanggal_kembali' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('DD'),
                'bulan_kembali' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('MM'),
                'tahun_kembali' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('YYYY'),
            ];
        }
        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function prosesKonfirmasi()
    {
        $tanggal_kembali = $this->stateTanggal['tahun_kembali'] . '-' . $this->stateTanggal['bulan_kembali'] . '-' . $this->stateTanggal['tanggal_kembali'];
        $this->state['tanggal_kembali'] = $tanggal_kembali;

        if ($this->tanggal_kembali_over) {
            $rule = 'required';
            $tanggal_kembali_over = $this->stateTanggal['tahun_kembali_over'] . '-' . $this->stateTanggal['bulan_kembali_over'] . '-' . $this->stateTanggal['tanggal_kembali_over'];
            $this->state['tanggal_kembali_over'] = $tanggal_kembali_over;
        } else {
            $rule = 'sometimes';
        }
        $validatedData = $this->validate([
            'state.denda' => $rule . '|integer',
            'state.tanggal_kembali' => 'sometimes|date',
            'state.tanggal_kembali_over' => 'sometimes|date',
        ]);
        $this->pengembalian->update($validatedData['state']);
        $this->pengembalian->peminjaman->update([
            'status' => 1
        ]);
        $buku = \App\Models\Buku::find($this->pengembalian->peminjaman->buku->id);
        $buku->update(['jumlah' => $buku->jumlah + $this->pengembalian->peminjaman->jumlah_pinjam]);
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data peminjaman buku berhasil dikonfirmasi.",
        ]);
        $this->emit('hideModal');
    }

    public function pesan()
    {
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data peminjaman sudah terkonfirmasi.",
        ]);
    }

    public function pulihkan(Pengembalian $pengembalian)
    {
        $pengembalian->update([
            'denda' => null,
            'tanggal_kembali' => null,
            'tanggal_kembali_over' => null,
        ]);
        $pengembalian->peminjaman->update([
            'status' => 0
        ]);
        $buku = \App\Models\Buku::find($pengembalian->peminjaman->buku->id);
        $buku->update(['jumlah' => $buku->jumlah - $pengembalian->peminjaman->jumlah_pinjam]);
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data pengembalian berhasil dipulihkan.",
        ]);
    }
}
