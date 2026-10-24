<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guru = User::where('email', 'guru@sekolah.sch.id')->first();
        $siswa = User::where('email', 'siswa@sekolah.sch.id')->first();

        $proyektor = Item::where('code', 'AV-001')->first();
        $mikroskop = Item::where('code', 'LAB-001')->first();
        $kamera = Item::where('code', 'AV-004')->first();
        $basket = Item::where('code', 'OLR-001')->first();
        $speaker = Item::where('code', 'AV-003')->first();
        $raket = Item::where('code', 'OLR-003')->first();

        $loans = [
            // Loan 1 (sudah dikembalikan)
            [
                'id' => 1,
                'user_id' => $guru->id,
                'item_id' => $proyektor->id,
                'quantity' => 1,
                'loan_date' => Carbon::now()->subDays(14)->toDateString(),
                'due_date' => Carbon::now()->subDays(11)->toDateString(),
                'status' => 'dikembalikan',
            ],
            // Loan 2 (sudah dikembalikan)
            [
                'id' => 2,
                'user_id' => $siswa->id,
                'item_id' => $mikroskop->id,
                'quantity' => 2,
                'loan_date' => Carbon::now()->subDays(10)->toDateString(),
                'due_date' => Carbon::now()->subDays(7)->toDateString(),
                'status' => 'dikembalikan',
            ],
            // Loan 3 (sudah dikembalikan)
            [
                'id' => 3,
                'user_id' => $guru->id,
                'item_id' => $kamera->id,
                'quantity' => 1,
                'loan_date' => Carbon::now()->subDays(8)->toDateString(),
                'due_date' => Carbon::now()->subDays(5)->toDateString(),
                'status' => 'dikembalikan',
            ],
            // Loan 4 (sedang dipinjam - masih dalam batas waktu)
            [
                'id' => 4,
                'user_id' => $siswa->id,
                'item_id' => $basket->id,
                'quantity' => 2,
                'loan_date' => Carbon::now()->subDays(2)->toDateString(),
                'due_date' => Carbon::now()->addDays(2)->toDateString(),
                'status' => 'dipinjam',
            ],
            // Loan 5 (terlambat - due_date sudah lewat belum kembali)
            [
                'id' => 5,
                'user_id' => $guru->id,
                'item_id' => $speaker->id,
                'quantity' => 1,
                'loan_date' => Carbon::now()->subDays(7)->toDateString(),
                'due_date' => Carbon::now()->subDays(2)->toDateString(),
                'status' => 'terlambat',
            ],
            // Loan 6 (sedang dipinjam)
            [
                'id' => 6,
                'user_id' => $siswa->id,
                'item_id' => $raket->id,
                'quantity' => 2,
                'loan_date' => Carbon::now()->subDay()->toDateString(),
                'due_date' => Carbon::now()->addDays(3)->toDateString(),
                'status' => 'dipinjam',
            ],
        ];

        foreach ($loans as $loanData) {
            Loan::updateOrCreate(['id' => $loanData['id']], $loanData);
        }
    }
}
