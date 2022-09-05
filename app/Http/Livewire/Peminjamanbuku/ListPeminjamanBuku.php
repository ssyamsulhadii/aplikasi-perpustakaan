<?php

namespace App\Http\Livewire\Peminjamanbuku;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListPeminjamanBuku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $peminjamanItem = false;
    public $peminjaman = null;
    public $state = [];
    public $buku = [];
    public $tanggalPinjam = [];
    public $tanggalKembali = [];
    protected $rules = [
        'state.kode' => 'required|size:3',
        'buku.buku_1' => 'required',
        'state.user_id' => 'required|exists:users,id',
        'state.buku_id' => 'required|exists:buku,id',
        'state.tanggal_pinjam' => 'required|date',
        'state.tanggal_kembali' => 'required|date',
    ];
    protected $messages = [
        'buku.buku_1.required' => 'Bidang ini harus dipilih.',
        'state.user_id.required' => 'Bidang ini harus dipilih.',
        'state.tanggal_pinjam.required' => 'Format tanggal peminjaman tidak sesuai.',
        'state.tanggal_pinjam.date' => 'Format tanggal peminjaman tidak sesuai.',
        'state.tanggal_kembali.required' => 'Format tanggal pengembalian tidak sesuai.',
        'state.tanggal_kembali.date' => 'Format tanggal pengembalian tidak sesuai.',
    ];
    public function propertiReset()
    {
        $this->reset(['peminjamanItem', 'peminjaman', 'state', 'buku', 'tanggalPinjam', 'tanggalKembali', 'rules']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.peminjamanbuku.list-peminjaman-buku', [
            'peminjaman_' => Peminjaman::OrderBy('tanggal_kembali', 'DESC')->paginate(5),
            'anggota_' => User::where('level_id', 4)->latest()->get(),
            'buku_' => Buku::where('jumlah', '>', 0)->orderBy('judul')->get(),
            'waktu_sekarang' => new \Carbon\Carbon(),
        ]);
    }

    public function create()
    {
        $this->propertiReset();
        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function store()
    {
        if (count($this->tanggalPinjam) !== 3) {
            return $this->validate();
        }
        if (count($this->tanggalKembali) !== 3) {
            return $this->validate();
        }

        $this->state['tanggal_pinjam'] = $this->tanggalPinjam['tahun'] . '-' . $this->tanggalPinjam['bulan'] . '-' . $this->tanggalPinjam['hari'];
        $this->state['tanggal_kembali'] = $this->tanggalKembali['tahun'] . '-' . $this->tanggalKembali['bulan'] . '-' . $this->tanggalKembali['hari'];

        $kode = Peminjaman::firstWhere('kode', "PMJ-" . $this->state['kode']);
        if (!is_null($kode)) {
            return $this->addError('state.kode', 'Kode peminjaman sudah ada.');
        }

        $this->state['jumlah_pinjam'] = 1;

        $buku = Buku::find($this->buku['buku_1']); //request data buku untuk mengambil nilai stok buku

        $sisa_buku = $buku->jumlah - $this->state['jumlah_pinjam'];
        if ($sisa_buku >= 0) {
            $buku->update(['jumlah' => $sisa_buku, 'dibaca' => $buku->dibaca + 1]);
            foreach ($this->buku as $value) {
                $this->state['buku_id'] =  $value;
                $peminjaman = Peminjaman::create($this->state);
                $pengembalian = new Pengembalian();
                $pengembalian->kode = $this->state['kode'];
                $peminjaman->pengembalian()->save($pengembalian);
            }

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
        $this->peminjamanItem = true;
        $this->peminjaman = $peminjaman;
        $this->state = $peminjaman->only(['user_id', 'buku_id', 'jumlah_pinjam']);
        $this->state['kode'] = substr($peminjaman->kode, 4);
        $this->tanggalPinjam = [
            'hari' => $peminjaman->tanggal_pinjam->isoFormat('D'),
            'bulan' => $peminjaman->tanggal_pinjam->isoFormat('M'),
            'tahun' => $peminjaman->tanggal_pinjam->isoFormat('YYYY'),
        ];
        $this->tanggalKembali = [
            'hari' => $peminjaman->tanggal_kembali->isoFormat('D'),
            'bulan' => $peminjaman->tanggal_kembali->isoFormat('M'),
            'tahun' => $peminjaman->tanggal_kembali->isoFormat('YYYY'),
        ];
        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function update()
    {
        if (count($this->tanggalPinjam) !== 3) {
            return $this->validate();
        }
        if (count($this->tanggalKembali) !== 3) {
            return $this->validate();
        }

        $this->state['tanggal_pinjam'] = $this->tanggalPinjam['tahun'] . '-' . $this->tanggalPinjam['bulan'] . '-' . $this->tanggalPinjam['hari'];
        $this->state['tanggal_kembali'] = $this->tanggalKembali['tahun'] . '-' . $this->tanggalKembali['bulan'] . '-' . $this->tanggalKembali['hari'];

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
                    $this->peminjaman->pengembalian()->update(['kode' => 'PGN-' . $this->state['kode']]);
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
                $this->peminjaman->pengembalian()->update(['kode' => 'PGN-' . $this->state['kode']]);
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
        $this->peminjaman->pengembalian()->update(['kode' => 'PGN-' . $this->state['kode']]);
        $this->emit('hideModal');
        $this->dispatchBrowserEvent('pesan', [
            'teks' => "Data peminjaman berhasil diperbarui.",
        ]);
    }
}
