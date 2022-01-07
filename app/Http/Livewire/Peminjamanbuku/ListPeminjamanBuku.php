<?php

namespace App\Http\Livewire\Peminjamanbuku;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;

class ListPeminjamanBuku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $peminjamanItem = false;
    public $peminjaman = null;
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
    public function propertiReset()
    {
        $this->reset(['peminjamanItem', 'peminjaman', 'bulan', 'state', 'stateTanggal', 'rules']);
        $this->resetValidation();
    }

    public function render()
    {
        $this->bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('livewire.peminjamanbuku.list-peminjaman-buku', [
            'peminjaman_' => Peminjaman::latest()->paginate(5),
            'anggota_' => User::where('level', 'anggota')->get(),
            'buku_' => Buku::where('jumlah', '>', 0)->orderBy('judul')->get(),
            'waktu_sekarang' => new \Carbon\Carbon(),
        ]);
    }

    public function create()
    {
        $this->propertiReset();
        $tanggal = new Carbon;
        $this->stateTanggal = [
            'tanggal_pinjam' => $tanggal->isoFormat('DD'),
            'bulan_pinjam' => $tanggal->isoFormat('MM'),
            'tahun_pinjam' => $tanggal->isoFormat('YYYY'),
            'tanggal_kembali' => $tanggal->isoFormat('DD'),
            'bulan_kembali' => $tanggal->isoFormat('MM'),
            'tahun_kembali' => $tanggal->isoFormat('YYYY'),
        ];
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

            $this->propertiReset();
            $this->emit('hideModal');
            $this->dispatchBrowserEvent('pesan', ['teks' => "Data buku berhasil ditambahkan."]);
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
        $jumlah_buku = $buku->jumlah + $peminjaman->jumlah_pinjam;
        $buku->update(['jumlah' => $jumlah_buku, 'dibaca' => $buku->dibaca - 1]);
        $peminjaman->delete();
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data peminjaman berhasil dihapus.",
        ]);
    }

    public function edit(Peminjaman $peminjaman)
    {
        $this->propertiReset();
        $this->dispatchBrowserEvent('show-form-modal');
        $this->peminjamanItem = true;
        $this->peminjaman = $peminjaman;
        $this->state = $peminjaman->only(['anggota_id', 'buku_id', 'jumlah_pinjam']);
        $this->state['kode'] = substr($peminjaman->kode, 4);
        $this->stateTanggal = [
            'tanggal_pinjam' => $peminjaman->tanggal_pinjam->isoFormat('DD'),
            'bulan_pinjam' => $peminjaman->tanggal_pinjam->isoFormat('MM'),
            'tahun_pinjam' => $peminjaman->tanggal_pinjam->isoFormat('YYYY'),
            'tanggal_kembali' => $peminjaman->tanggal_kembali->isoFormat('DD'),
            'bulan_kembali' => $peminjaman->tanggal_kembali->isoFormat('MM'),
            'tahun_kembali' => $peminjaman->tanggal_kembali->isoFormat('YYYY'),
        ];
    }

    public function update()
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

        $buku_baru = \App\Models\Buku::find($this->state['buku_id']);
        $buku_lama = \App\Models\Buku::find($this->peminjaman->buku_id);
        if ($buku_baru == $buku_lama) {
            // tidak mengganti buku
            if ($this->peminjaman->jumlah_pinjam != $this->state['jumlah_pinjam']) {
                // jika mengganti jumlah pinjam
                $jumlah_buku = $this->peminjaman->jumlah_pinjam + $buku_lama->jumlah; //mengetahui jumlah buku baru
                $sisa_buku = $jumlah_buku - $this->state['jumlah_pinjam']; //mengetahui sisa buku
                // jika sisa buku kurang dari 0, artinya si peminjam melakukan peminjaman buku, lebih dari buku yang tersedia.
                if ($sisa_buku < 0) {
                    $this->dispatchBrowserEvent('pesan', [
                        'teks' => "Jumlah pinjam melebihi buku yang tersedia.",
                        'background' => "red",
                    ]);
                    return false;
                } else {
                    // lakukan update nilai jumlah buku
                    $buku_lama->update(['jumlah' => $sisa_buku]);
                    $this->peminjaman->pengembalian_()->update(['kode' => 'PGN-' . $this->state['kode']]);
                    $this->peminjaman->update($this->state);
                    $this->emit('hideModal');
                    $this->dispatchBrowserEvent('pesan', ['teks' => "Data peminjaman berhasil diperbarui."]);
                    return false;
                }
            }
        } else {
            // melakukan pergantian buku
            $sisa_buku = $buku_baru->jumlah - $this->state['jumlah_pinjam'];
            if ($sisa_buku >= 0) {
                $buku_lama->update([
                    'jumlah' => $buku_lama->jumlah + $this->peminjaman->jumlah_pinjam,
                    'dibaca' => $buku_lama->dibaca - 1,
                ]);
                $buku_baru->update([
                    'jumlah' => $buku_baru->jumlah - $this->state['jumlah_pinjam'],
                    'dibaca' => $buku_baru->dibaca + 1,
                ]);
                $this->peminjaman->update($this->state);
                $this->peminjaman->pengembalian_()->update(['kode' => 'PGN-' . $this->state['kode']]);
                $this->emit('hideModal');
                $this->dispatchBrowserEvent('pesan', ['teks' => "Data peminjaman berhasil diperbarui.",]);
                return false;
            } else {
                $this->dispatchBrowserEvent('pesan', [
                    'teks' => "Jumlah pinjam melebihi buku yang tersedia.",
                    'background' => "red",
                ]);
                return false;
            }
        }

        $this->peminjaman->update($this->state);
        $this->peminjaman->pengembalian_()->update(['kode' => 'PGN-' . $this->state['kode']]);
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data peminjaman berhasil diperbarui.",
        ]);
    }
}
