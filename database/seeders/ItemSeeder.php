<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lab = Category::where('name', 'Alat Laboratorium IPA')->first();
        $multimedia = Category::where('name', 'Peralatan Multimedia & Audio Visual')->first();
        $olahraga = Category::where('name', 'Peralatan Olahraga')->first();
        $sarpras = Category::where('name', 'Perlengkapan Sarana & Prasarana')->first();

        $items = [
            // Lab IPA
            [
                'category_id' => $lab->id,
                'name' => 'Mikroskop Binokuler Olympus CX23',
                'code' => 'LAB-001',
                'stock' => 8,
                'condition' => 'baik',
                'location' => 'Laboratorium Biologi & IPA',
                'source_fund' => 'BOS Kinerja',
                'procurement_year' => 2024,
                'description' => 'Pembesaran 40x - 1000x, lensa objektif plan achromat, lampu LED 0.5W terintegrasi.',
            ],
            [
                'category_id' => $lab->id,
                'name' => 'Set Tabung Reaksi Pyrex 150mm',
                'code' => 'LAB-002',
                'stock' => 50,
                'condition' => 'baik',
                'location' => 'Laboratorium Kimia',
                'source_fund' => 'BOS Reguler',
                'procurement_year' => 2024,
                'description' => 'Kaca borosilikat tahan panas, termasuk rak kayu kapasitas 12 tabung.',
            ],
            [
                'category_id' => $lab->id,
                'name' => 'Neraca Ohaus 4 Lengan 311g',
                'code' => 'LAB-003',
                'stock' => 4,
                'condition' => 'rusak ringan',
                'location' => 'Laboratorium Fisika',
                'source_fund' => 'DAK Pendidikan',
                'procurement_year' => 2023,
                'description' => 'Ketelitian 0.01g, jarum penunjuk sedikit goyang perlu kalibrasi ulang.',
            ],
            // Multimedia
            [
                'category_id' => $multimedia->id,
                'name' => 'Proyektor Epson EB-X500 3600 Lumens',
                'code' => 'AV-001',
                'stock' => 5,
                'condition' => 'baik',
                'location' => 'Ruang Multimedia & Audio Visual',
                'source_fund' => 'BOS Kinerja',
                'procurement_year' => 2024,
                'description' => 'Resolusi XGA, port HDMI/VGA, dilengkapi tas pembungkus dan kabel 5m.',
            ],
            [
                'category_id' => $multimedia->id,
                'name' => 'Layar Proyektor Tripod 70 Inch',
                'code' => 'AV-002',
                'stock' => 4,
                'condition' => 'baik',
                'location' => 'Gudang Sarpras Utama',
                'source_fund' => 'BOS Reguler',
                'procurement_year' => 2023,
                'description' => 'Ukuran 178 x 178 cm, bahan matte white dengan kaki tripod besi kokoh.',
            ],
            [
                'category_id' => $multimedia->id,
                'name' => 'Speaker Wireless Portable Fleco 12 Inch',
                'code' => 'AV-003',
                'stock' => 3,
                'condition' => 'baik',
                'location' => 'Ruang Tata Usaha & Guru',
                'source_fund' => 'Komite Sekolah',
                'procurement_year' => 2024,
                'description' => 'Dilengkapi 2 mic wireless UHF, bluetooth 5.0, roda troli untuk upacara & rapat.',
            ],
            [
                'category_id' => $multimedia->id,
                'name' => 'Kamera DSLR Canon EOS 3000D Kit',
                'code' => 'AV-004',
                'stock' => 2,
                'condition' => 'rusak ringan',
                'location' => 'Studio Humas & Multimedia',
                'source_fund' => 'BOS Kinerja',
                'procurement_year' => 2023,
                'description' => 'Lensa kit 18-55mm III, baterai cadangan 1 unit, penutup lensa retak ringan.',
            ],
            // Olahraga
            [
                'category_id' => $olahraga->id,
                'name' => 'Bola Basket Molten GG7X Original',
                'code' => 'OLR-001',
                'stock' => 12,
                'condition' => 'baik',
                'location' => 'Gudang Olahraga & Lapangan',
                'source_fund' => 'BOS Reguler',
                'procurement_year' => 2024,
                'description' => 'Ukuran 7 standar FIBA, bahan kulit sintetis komposit untuk lapangan outdoor/indoor.',
            ],
            [
                'category_id' => $olahraga->id,
                'name' => 'Bola Voli Mikasa MVA 300',
                'code' => 'OLR-002',
                'stock' => 8,
                'condition' => 'rusak ringan',
                'location' => 'Gudang Olahraga & Lapangan',
                'source_fund' => 'BOS Reguler',
                'procurement_year' => 2023,
                'description' => 'Standar FIVB 8 panel, pentil bola 1 pcs agak kendor saat dipompa tinggi.',
            ],
            [
                'category_id' => $olahraga->id,
                'name' => 'Raket Badminton Yonex Carbonex 8000',
                'code' => 'OLR-003',
                'stock' => 16,
                'condition' => 'baik',
                'location' => 'Gudang Olahraga & Lapangan',
                'source_fund' => 'BOS Reguler',
                'procurement_year' => 2024,
                'description' => 'Tarikan senar 24 lbs, frame graphite kuat, grip terbungkus rapi.',
            ],
            // Sarpras
            [
                'category_id' => $sarpras->id,
                'name' => 'Mesin Pemotong Rumput Gendong Honda',
                'code' => 'SPR-001',
                'stock' => 1,
                'condition' => 'rusak berat',
                'location' => 'Bengkel Sarpras & Kebersihan',
                'source_fund' => 'Komite Sekolah',
                'procurement_year' => 2022,
                'description' => 'Mesin 4 tak UMK435T, karburator buntu dan tali penarik putus, butuh servis resmi.',
            ],
            [
                'category_id' => $sarpras->id,
                'name' => 'Tangga Lipat Teleskopik Aluminium 3.8 Meter',
                'code' => 'SPR-002',
                'stock' => 2,
                'condition' => 'baik',
                'location' => 'Gudang Sarpras Utama',
                'source_fund' => 'BOS Reguler',
                'procurement_year' => 2024,
                'description' => 'Daya tampung 150 kg, 13 anak tangga dengan sistem pengunci otomatis per tingkat.',
            ],
        ];

        foreach ($items as $item) {
            Item::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}
