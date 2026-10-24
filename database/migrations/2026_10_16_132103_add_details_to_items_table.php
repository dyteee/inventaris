<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('location')->default('Gudang Sarpras')->after('condition');
            $table->string('source_fund')->nullable()->default('BOS Reguler')->after('location');
            $table->integer('procurement_year')->nullable()->default(date('Y'))->after('source_fund');
            $table->text('description')->nullable()->after('procurement_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['location', 'source_fund', 'procurement_year', 'description']);
        });
    }
};
