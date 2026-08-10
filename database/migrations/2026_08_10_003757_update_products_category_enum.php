<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Clear existing data so ENUM can be safely changed
        DB::table('products')->truncate();

        // Alter the ENUM column to medicine categories
        DB::statement("ALTER TABLE products MODIFY COLUMN category ENUM(
            'Pain Relievers (Analgesics)',
            'Infection Fighters (Antibiotics)',
            'Stomach Acid Reducers (Antacids)'
        ) NOT NULL");
    }

    public function down(): void
    {
        DB::table('products')->truncate();

        DB::statement("ALTER TABLE products MODIFY COLUMN category ENUM(
            'Electronics',
            'Clothing',
            'Food & Beverages',
            'Health & Beauty',
            'Home & Living',
            'Sports & Outdoors',
            'Books & Media',
            'Toys & Games',
            'Other'
        ) NOT NULL");
    }
};
