<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $guru = User::where('email', 'guru@sekolah.sch.id')->first();
        $siswa = User::where('email', 'siswa@sekolah.sch.id')->first();

        $logs = [
            [
                'user_id' => $admin->id,
                'action' => 'create_item',
                'description' => 'Menambahkan data barang baru: Proyektor Epson EB-X500 (AV-001) dengan stok 5 unit.',
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'create_item',
                'description' => 'Menambahkan data barang baru: Mikroskop Binokuler Olympus (LAB-001) dengan stok 8 unit.',
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => $guru->id,
                'action' => 'create_loan',
                'description' => 'Penguji 2 mengajukan peminjaman Proyektor Epson EB-X500 (1 unit) untuk kegiatan KBM Fisika.',
                'created_at' => Carbon::now()->subDays(14),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'verify_loan',
                'description' => 'Admin menyetujui peminjaman ID #1 oleh Penguji 2.',
                'created_at' => Carbon::now()->subDays(14),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'verify_return',
                'description' => 'Admin memverifikasi pengembalian peminjaman ID #1 dengan kondisi baik.',
                'created_at' => Carbon::now()->subDays(11),
            ],
            [
                'user_id' => $siswa->id,
                'action' => 'create_loan',
                'description' => 'Penguji 3 mengajukan peminjaman Bola Basket Molten GG7X (2 unit) untuk latihan ekstrakurikuler.',
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => $admin->id,
                'action' => 'verify_loan',
                'description' => 'Admin menyetujui peminjaman ID #4 oleh Penguji 3.',
                'created_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($logs as $log) {
            ActivityLog::create($log);
        }
    }
}
