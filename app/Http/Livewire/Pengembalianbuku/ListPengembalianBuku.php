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
    public $state = [];
    public $tanggalKembali = [];
    public $tanggalKembaliOver = [];
    public $tanggal = false;
    public function render()
    {
        return view('livewire.pengembalianbuku.list-pengembalian-buku', [
            'pengembalian_' => Pengembalian::latest()->OrderBy('tanggal_kembali', 'DESC')->paginate(5),
        ]);
    }
    public function propertiReset()
    {
        $this->reset(['pengembalian', 'state', 'tanggalKembali', 'tanggalKembaliOver', 'tanggal']);
        $this->resetValidation();
    }
    public function konfirmasi(Pengembalian $pengembalian)
    {
        $this->propertiReset();
        $this->pengembalian = $pengembalian;
        // tanggal sekarang
        $tanggalSekarang = new Carbon;
        // $tanggal = new Carbon('06-06-2025');
        if ($tanggalSekarang > $pengembalian->peminjaman->tanggal_kembali) {
            $this->tanggal = true;
            $this->tanggalKembali = [
                'hari' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('D'),
                'bulan' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('M'),
                'tahun' => $pengembalian->peminjaman->tanggal_kembali->isoFormat('YYYY'),
            ];
            $this->tanggalKembaliOver = [
                'hari' => $tanggalSekarang->isoFormat('D'),
                'bulan' => $tanggalSekarang->isoFormat('M'),
                'tahun' => $tanggalSekarang->isoFormat('YYYY'),
            ];
        } else {
            $this->tanggalKembali = [
                'hari' => $tanggalSekarang->isoFormat('D'),
                'bulan' => $tanggalSekarang->isoFormat('M'),
                'tahun' => $tanggalSekarang->isoFormat('YYYY'),
            ];
        }
        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function prosesKonfirmasi()
    {
        $this->state['tanggal_kembali'] = $this->tanggalKembali['tahun'] . '-' . $this->tanggalKembali['bulan'] . '-' . $this->tanggalKembali['hari'];
        if ($this->tanggal) {
            $rule = 'required';
            $this->state['tanggal_kembali_over'] = $this->tanggalKembaliOver['tahun'] . '-' . $this->tanggalKembaliOver['bulan'] . '-' . $this->tanggalKembaliOver['hari'];
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
