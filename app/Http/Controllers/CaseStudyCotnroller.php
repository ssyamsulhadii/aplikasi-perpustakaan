<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class CaseStudyCotnroller extends Controller
{
    public function index()
    {
        return view('case-study.index', ['rak_' => Rak::latest()->get()]);
    }

    public function create()
    {
        return view('case-study.create');
    }

    public function store(Request $request)
    {
        Rak::create($request->only('nama'));
        return redirect(route('case-study.index'))->with('pesan', 'Data berhasil ditambahkan.');
    }


    public function edit(Rak $case_study)
    {
        return view('case-study.edit', ['rak' => $case_study]);
    }

    public function update(Request $request, Rak $case_study)
    {
        $case_study->update($request->only('nama'));
        return redirect(route('case-study.index'))->with('pesan', 'Data berhasil diperbarui.');
    }


    public function destroy(Rak $case_study)
    {
        $case_study->delete();
        return redirect(route('case-study.index'))->with('pesan', 'Data berhasil dihapus.');
    }
}
