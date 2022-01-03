<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class BukuSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'buku';
        $this->filename = base_path() . '/database/seeders/file_csv/daftarbuku.csv';
        $this->should_trim = true;
        $this->timestamps = true;
        $this->created_at = now();
        $this->updated_at = now();
    }
    public function run()
    {
        parent::run();
    }
}
