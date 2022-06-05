<?php

namespace App\Http\Controllers\cetak;

use Spipu\Html2Pdf\Html2Pdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetakKategori()
    {
        $kategori_ = \App\Models\Kategori::withCount('buku_')->when(request('rak') ?? false, function ($query, $rak) {
            return $query->WhereHas('rak', function ($query) use ($rak) {
                $query->where('id', $rak);
            });
        })->orderBy('nama')->get();

        $inst_pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        // $inst_pdf->previewHTML(view('laporan.cetak.kategori', compact('kategori_')));
        $inst_pdf->pdf->SetTitle('Cetak Data Kategori Buku ' . request('rak'));
        $inst_pdf->writeHTML(view('laporan.cetak.kategori', compact('kategori_')));
        $inst_pdf->output("kategori-buku " . request('rak') . ".pdf");
    }
    public function cetakBuku()
    {
        $buku_ = \App\Models\Buku::when(request('kategori') ?? false, function ($query, $kategori) {
            return $query->WhereHas('kategori', function ($query) use ($kategori) {
                $query->where('id', $kategori);
            });
        })->orderBy('judul')->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        // $inst_pdf->previewHTML(view('laporan.cetak.buku', compact('buku_')));
        $inst_pdf->pdf->SetTitle('Cetak Data Buku ' . request('rak') . request('kategori'));
        $inst_pdf->writeHTML(view('laporan.cetak.buku', compact('buku_')));
        $inst_pdf->output("semua-data-buku.pdf");
    }

    public function cetakAnggota()
    {
        $anggota_ = \App\Models\User::where('level_id', 4)->orderBy('nama')->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Anggota');
        $inst_pdf->writeHTML(view('laporan.cetak.anggota', compact('anggota_')));
        $inst_pdf->output("anggota.pdf");
    }
    public function cetakPeminjamanAnggota(\App\Models\User $anggota)
    {
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Peminjaman Anggota');
        $inst_pdf->writeHTML(view('laporan.cetak.peminjaman-anggota', compact('anggota')));
        $inst_pdf->output("peminjaman-anggota.pdf");
    }

    public function cetakPeminjaman(Request $request)
    {
        $request['tanggal_awal'] = $request->tahun_awal . "-" . $request->bulan_awal . "-" . $request->hari_awal;
        $request['tanggal_akhir'] = $request->tahun_akhir . "-" . $request->bulan_akhir . "-" . $request->hari_akhir;
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ], [
            'tanggal_awal.required' => 'Format tanggal awal cetak tidak sesuai.',
            'tanggal_awal.date' => 'Format tanggal awal cetak tidak sesuai.',
            'tanggal_akhir.required' => 'Format tanggal akhir cetak tidak sesuai.',
            'tanggal_akhir.date' => 'Format tanggal akhir cetak tidak sesuai.',
        ]);

        $peminjaman_ = \App\Models\Peminjaman::orderBy('tanggal_pinjam', 'ASC')->whereBetween('tanggal_pinjam', [date($request->tanggal_awal), date($request->tanggal_akhir)])->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Laporan Peminjaman');
        $inst_pdf->writeHTML(view('laporan.cetak.peminjaman', [
            'peminjaman_' => $peminjaman_,
            'tanggal_from' => new Carbon($request->tanggal_awal),
            'tanggal_to' => new Carbon($request->tanggal_akhir),
        ]));
        $inst_pdf->output("cetak-laporan-peminjaman.pdf");
    }
    public function cetakPengembalian(Request $request)
    {
        $request['tanggal_awal'] = $request->tahun_awal . "-" . $request->bulan_awal . "-" . $request->hari_awal;
        $request['tanggal_akhir'] = $request->tahun_akhir . "-" . $request->bulan_akhir . "-" . $request->hari_akhir;
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ], [
            'tanggal_awal.required' => 'Format tanggal awal cetak tidak sesuai.',
            'tanggal_awal.date' => 'Format tanggal awal cetak tidak sesuai.',
            'tanggal_akhir.required' => 'Format tanggal akhir cetak tidak sesuai.',
            'tanggal_akhir.date' => 'Format tanggal akhir cetak tidak sesuai.',
        ]);

        $pengembalian_ = \App\Models\Pengembalian::WhereHas('peminjaman', function ($query) {
            $query->where('status', 1);
        })->orderBy('tanggal_kembali', 'ASC')->whereBetween('tanggal_kembali', [date($request->tanggal_awal), date($request->tanggal_akhir)])->get();

        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Laporan Pengembalian');
        $inst_pdf->writeHTML(view('laporan.cetak.pengembalian', [
            'pengembalian_' => $pengembalian_,
            'tanggal_from' => new Carbon($request->tanggal_awal),
            'tanggal_to' => new Carbon($request->tanggal_akhir),
        ]));
        $inst_pdf->output("cetak-laporan-peminjaman.pdf");
    }

    public function cetakPendaftaranPengguna(Request $request)
    {
        switch (request('opsi')) {
            case 3:
                $str = "di 3 bulan awal $request->tahun";
                break;
            case 6:
                $str = "di 6 bulan awal $request->tahun";
                break;
            default;
                $str = "di Tahun $request->tahun";
                break;
        }
        $opsi = [$request->tahun . '-01-01', $request->tahun . '-' . $request->opsi . '-30'];
        $pengguna_ = \App\Models\User::where('level_id', 4)->whereBetween('created_at', $opsi)->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Pendafataran Pengguna');
        $inst_pdf->writeHTML(view('laporan.cetak.admin.pendaftaran-pengguna', [
            'anggota_' => $pengguna_,
            'str' => $str,
        ]));
        $inst_pdf->output("anggota.pdf");
    }

    public function cetakAnggotaPeminjaman(Request $request)
    {
        $result = User::withCount('peminjaman_')->where('level_id', 4)->whereHas('peminjaman_', function ($query) {
            $query->whereYear('tanggal_pinjam', request('tahun'));
        })->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 5, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Anggota yang Sering Melakukan Peminjaman Buku');
        $inst_pdf->writeHTML(view('laporan.cetak.admin.anggota-peminjaman', compact('result')));
        $inst_pdf->output("anggota-peminjaman.pdf");
    }

    public function cetakAnggotaPengembalianTerlambat(Request $request)
    {
        $result = \App\Models\Pengembalian::whereYear('tanggal_kembali', $request->tahun)->whereNotNull('denda')->orderBy('tanggal_kembali')->get();

        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [0, 5, 0, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Anggota yang Sering Melakukan Keterlambatan Pengembalian Buku');
        $inst_pdf->writeHTML(view('laporan.cetak.admin.anggota-pengembalian-terlambat', compact('result')));
        $inst_pdf->output("anggota-peminjaman.pdf");
    }

    public function cetakBukuFavorite()
    {
        $kategori_ = \App\Models\Kategori::whereHas('buku_', function ($query) {
            $query->where('dibaca', '>', 7);
        })->get()->sortBy('buku_.dibaca');
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [0, 5, 0, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Buku Terfavorite yang Sering dipinjam');
        $inst_pdf->writeHTML(view('laporan.cetak.admin.buku-favorite', compact('kategori_')));
        $inst_pdf->output("data-buku-favorite.pdf");
    }

    public function cetakKartuAnggota(User $user)
    {
        $inst_pdf = new Html2Pdf('L', 'A7', 'en', true, 'UTF-8', [0, 5, 0, 0]);
        $inst_pdf->writeHTML(view('laporan.cetak.kartu-anggota', compact('user')));
        $inst_pdf->pdf->SetTitle('Cetak Data Buku Terfavorite yang Sering dipinjam');
        $inst_pdf->output("kartu-anggota-$user->nama.pdf");
    }
}
