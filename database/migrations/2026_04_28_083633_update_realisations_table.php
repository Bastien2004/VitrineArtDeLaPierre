<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('realisations', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('realisations', function (Blueprint $table) {
            $table->dropColumn('before_image');
            $table->dropColumn('after_image');
            $table->string('slug');
        });
    }
};
