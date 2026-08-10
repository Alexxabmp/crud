<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                          // INT UNSIGNED AUTO_INCREMENT PK
            $table->string('name', 150);                          // VARCHAR(150)
            $table->string('sku', 50)->unique();                  // VARCHAR(50) UNIQUE
            $table->enum('category', [                            // ENUM
                'Pain Relievers (Analgesics)',
                'Infection Fighters (Antibiotics)',
                'Stomach Acid Reducers (Antacids)',
            ]);
            $table->text('description')->nullable();              // TEXT
            $table->decimal('price', 10, 2);                     // DECIMAL(10,2) — float/double
            $table->integer('stock_quantity')->default(0);       // INT
            $table->date('expiry_date')->nullable();             // DATE
            $table->boolean('is_active')->default(true);        // TINYINT(1) — BOOLEAN
            $table->timestamps();                                // DATETIME (created_at, updated_at)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
