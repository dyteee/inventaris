<?php

namespace Database\Seeders;

use App\Models\ReturnLog;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReturnLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $returnLogs = [
            [
                'loan_id' => 1,
                'returned_at' => Carbon::now()->subDays(11)->toDateString(),
                'condition_on_return' => 'baik',
                'notes' => 'Barang kembali lengkap dengan kabel power, kabel HDMI, dan tas bawaan. Kondisi normal.',
            ],
            [
                'loan_id' => 2,
                'returned_at' => Carbon::now()->subDays(7)->toDateString(),
                'condition_on_return' => 'baik',
                'notes' => 'Kedua mikroskop dikembalikan dalam box pelindung dan lensa bersih.',
            ],
            [
                'loan_id' => 3,
                'returned_at' => Carbon::now()->subDays(5)->toDateString(),
                'condition_on_return' => 'rusak ringan',
                'notes' => 'Kamera berfungsi normal, namun penutup lensa (lens cap) hilang saat pemakaian.',
            ],
        ];

        foreach ($returnLogs as $log) {
            ReturnLog::updateOrCreate(['loan_id' => $log['loan_id']], $log);
        }
    }
}
