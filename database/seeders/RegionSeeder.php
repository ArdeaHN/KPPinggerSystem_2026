<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opds = [
            'Sekretariat Daerah',
            'Sekretariat DPRD',
            'Inspektorat Daerah',
            'Dinas Pendidikan Pemuda dan Olah Raga',
            'Dinas Kesehatan',
            'Dinas Pekerjaan Umum Perumahan dan Kawasan Permukiman',
            'Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak',
            'Dinas Pemberdayaan Masyarakat dan Kalurahan Pengendalian Penduduk dan Keluarga Berencana',
            'Dinas Pertanian dan Pangan',
            'Dinas Pertanahan dan Tata Ruang ( Kundha Niti Mandala Sarta Tata Sasana )',
            'Dinas Tenaga Kerja',
            'Dinas Kependudukan dan Pencatatan Sipil',
            'Dinas Perindustrian Koperasi Usaha Kecil dan Menengah',
            'Dinas Pariwisata',
            'Dinas Kelautan dan Perikanan',
            'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
            'Dinas Perdagangan',
            'Dinas Lingkungan Hidup',
            'Dinas Perhubungan',
            'Dinas Komunikasi dan Informatika',
            'Dinas Kebudayaan ( Kundha Kabudayan )',
            'Dinas Perpustakaan dan Kearsipan',
            'Satuan Polisi Pamong Praja',
            'Badan Perencanaan Pembangunan Riset dan Inovasi Daerah',
            'Badan Keuangan dan Aset Daerah',
            'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',
            'Badan Kesatuan Bangsa dan Politik',
            'Kapanewon Temon',
            'Kapanewon Wates',
            'Kapanewon Panjatan',
            'Kapanewon Galur',
            'Kapanewon Lendah',
            'Kapanewon Sentolo',
            'Kapanewon Pengasih',
            'Kapanewon Kokap',
            'Kapanewon Girimulyo',
            'Kapanewon Nanggulan',
            'Kapanewon Kalibawang',
            'Kapanewon Samigaluh',
            'Badan Penanggulangan Bencana Daerah',
            'RSUD Wates Dinas Kesehatan',
            'RSUD Nyi Ageng Serang Dinas Kesehatan',
        ];

        foreach ($opds as $opd) {
            Region::firstOrCreate([
                'name' => $opd
            ]);
        }
    }
}