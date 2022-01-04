<?php

namespace App\Http\Livewire\Peminjamanbuku;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\Pengembalian;
use App\Models\PengembalianBuku;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListPeminjamanBuku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $peminjamanItem = false;
    public $bulan =  [];
    public $state = [];
    public $stateTanggal = [];
    protected $rules = [
        'state.kode' => 'required|size:3|unique:peminjaman,kode',
        'state.anggota_id' => 'required|exists:anggota,id',
        'state.buku_id' => 'required|exists:buku,id',
        'state.tanggal_pinjam' => 'required|date',
        'state.tanggal_kembali' => 'required|date',
        'state.jumlah_pinjam' => 'required|integer',
    ];

    public function render()
    {
        $tanggal = new Carbon;
        $this->stateTanggal = [
            'tanggal_pinjam' => $tanggal->isoFormat('DD'),
            'bulan_pinjam' => $tanggal->isoFormat('MM'),
            'tahun_pinjam' => $tanggal->isoFormat('YYYY'),
            'tanggal_kembali' => $tanggal->isoFormat('DD'),
            'bulan_kembali' => $tanggal->isoFormat('MM'),
            'tahun_kembali' => $tanggal->isoFormat('YYYY'),
        ];

        $this->bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('livewire.peminjamanbuku.list-peminjaman-buku', [
            'peminjaman_' => Peminjaman::latest()->paginate(5),
            'anggota_' => User::where('level', 'anggota')->get(),
            'buku_' => Buku::where('jumlah', '>', 0)->orderBy('judul')->get(),
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
        $tanggal_pinjam = $this->stateTanggal['tahun_pinjam'] . '-' . $this->stateTanggal['bulan_pinjam'] . '-' . $this->stateTanggal['tanggal_pinjam'];
        $tanggal_kembali = $this->stateTanggal['tahun_kembali'] . '-' . $this->stateTanggal['bulan_kembali'] . '-' . $this->stateTanggal['tanggal_kembali'];
        $this->state['tanggal_pinjam'] = $tanggal_pinjam;
        $this->state['tanggal_kembali'] = $tanggal_kembali;

        $this->validate();

        if ($this->state['jumlah_pinjam'] < 1) {
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Masukkan bilangan positif.",
                'background' => "red",
            ]);
        }

        $buku = Buku::find($this->state['buku_id']); //request data buku untuk mengambil nilai stok buku

        $sisa_buku = $buku->jumlah - $this->state['jumlah_pinjam'];

        if ($sisa_buku >= 0) {
            $buku->update(['jumlah' => $sisa_buku, 'dibaca' => $buku->dibaca + 1]);
            $peminjaman = Peminjaman::create($this->state);
            $pengembalian = new Pengembalian();
            $pengembalian->kode = $this->state['kode'];
            $peminjaman->pengembalian_()->save($pengembalian);

            $this->reset();
            $this->resetValidation();
            $this->emit('hideModal');
            $this->dispatchBrowserEvent('pesan', ['teks' => "Data berhasil ditambahkan."]);
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Data buku berhasil ditambahkan.",
            ]);
        } else {
            $this->dispatchBrowserEvent('pesan', [
                'teks' => "Jumlah pinjam melebihi buku yang tersedia.",
                'background' => "red",
            ]);
        }
    }

    public function distroy(Peminjaman $peminjaman)
    {
        $buku = \App\Models\Buku::find($peminjaman->buku_id);
        $jumlah_buku = $buku->stok + $peminjaman->qty;
        $buku->update(['jumlah' => $jumlah_buku, 'dibaca' => $buku->dibaca - 1]);
        $peminjaman->delete();
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data peminjaman berhasil dihapus.",
        ]);
    }
}
