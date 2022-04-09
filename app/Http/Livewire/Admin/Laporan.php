<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Laporan extends Component
{
    public $tahun = null;
    public function render()
    {
        return view('livewire.admin.laporan');
    }
    public function pilihPeriode($value)
    {
        $this->tahun = $value;
    }
}
