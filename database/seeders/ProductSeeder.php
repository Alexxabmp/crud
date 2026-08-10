<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            // ─── Pain Relievers (Analgesics) ──────────────────────────
            [
                'name'           => 'Biogesic Paracetamol 500mg',
                'sku'            => 'BIO-PCM-500-100T',
                'category'       => 'Pain Relievers (Analgesics)',
                'description'    => 'Used to relieve mild to moderate pain such as headache, toothache, muscle pain, and fever. Each tablet contains 500mg of Paracetamol.',
                'price'          => 85.00,
                'stock_quantity' => 200,
                'expiry_date'    => '2027-03-31',
                'is_active'      => true,
            ],
            [
                'name'           => 'Alaxan FR (Ibuprofen + Paracetamol)',
                'sku'            => 'ALX-IBU-PCM-10T',
                'category'       => 'Pain Relievers (Analgesics)',
                'description'    => 'Combination of Ibuprofen 200mg and Paracetamol 325mg. Provides fast-acting relief from pain, fever, and inflammation.',
                'price'          => 49.75,
                'stock_quantity' => 150,
                'expiry_date'    => '2026-11-30',
                'is_active'      => true,
            ],
            [
                'name'           => 'Dolfenal Mefenamic Acid 500mg',
                'sku'            => 'DOL-MEF-500-10T',
                'category'       => 'Pain Relievers (Analgesics)',
                'description'    => 'Mefenamic Acid 500mg capsule. Used for relief of mild to moderate pain including dysmenorrhea, dental pain, and post-operative pain.',
                'price'          => 39.50,
                'stock_quantity' => 7,
                'expiry_date'    => '2026-09-30',
                'is_active'      => true,
            ],

            // ─── Infection Fighters (Antibiotics) ──────────────────────
            [
                'name'           => 'Amoxicillin 500mg Capsule',
                'sku'            => 'AMX-500-100C',
                'category'       => 'Infection Fighters (Antibiotics)',
                'description'    => 'Broad-spectrum penicillin antibiotic used to treat bacterial infections including respiratory tract, urinary tract, and skin infections.',
                'price'          => 12.50,
                'stock_quantity' => 500,
                'expiry_date'    => '2027-06-30',
                'is_active'      => true,
            ],
            [
                'name'           => 'Augmentin 625mg (Amoxicillin + Clavulanate)',
                'sku'            => 'AUG-625-14T',
                'category'       => 'Infection Fighters (Antibiotics)',
                'description'    => 'Combines Amoxicillin 500mg and Clavulanic Acid 125mg to fight bacteria resistant to standard penicillin antibiotics.',
                'price'          => 320.00,
                'stock_quantity' => 60,
                'expiry_date'    => '2027-01-31',
                'is_active'      => true,
            ],
            [
                'name'           => 'Azithromycin 500mg Tablet',
                'sku'            => 'AZI-500-3T',
                'category'       => 'Infection Fighters (Antibiotics)',
                'description'    => 'Macrolide antibiotic for community-acquired pneumonia, sinusitis, and sexually transmitted infections. 3-day treatment course.',
                'price'          => 145.00,
                'stock_quantity' => 4,
                'expiry_date'    => '2026-08-31',
                'is_active'      => true,
            ],

            // ─── Stomach Acid Reducers (Antacids) ─────────────────────
            [
                'name'           => 'Kremil-S Antacid Tablet',
                'sku'            => 'KRM-ATC-36T',
                'category'       => 'Stomach Acid Reducers (Antacids)',
                'description'    => 'Contains Aluminum Hydroxide, Magnesium Hydroxide, and Simethicone. Relieves heartburn, hyperacidity, and gas pains.',
                'price'          => 62.00,
                'stock_quantity' => 180,
                'expiry_date'    => '2028-01-31',
                'is_active'      => true,
            ],
            [
                'name'           => 'Omeprazole 20mg Capsule',
                'sku'            => 'OME-20-30C',
                'category'       => 'Stomach Acid Reducers (Antacids)',
                'description'    => 'Proton pump inhibitor that reduces stomach acid. Used for GERD, peptic ulcers, and acid reflux disease. 30-capsule pack.',
                'price'          => 185.00,
                'stock_quantity' => 95,
                'expiry_date'    => '2027-09-30',
                'is_active'      => true,
            ],
            [
                'name'           => 'Gaviscon Double Action Liquid',
                'sku'            => 'GAV-DA-150ML',
                'category'       => 'Stomach Acid Reducers (Antacids)',
                'description'    => 'Sodium Alginate + Sodium Bicarbonate + Calcium Carbonate suspension. Forms a protective raft on top of stomach contents to prevent acid reflux.',
                'price'          => 298.50,
                'stock_quantity' => 0,
                'expiry_date'    => '2026-12-31',
                'is_active'      => false,
            ],
        ];

        foreach ($medicines as $medicine) {
            Product::create($medicine);
        }
    }
}
