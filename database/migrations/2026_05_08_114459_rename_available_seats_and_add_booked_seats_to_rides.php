<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->renameColumn('available_seats', 'total_seats');
        });

        Schema::table('rides', function (Blueprint $table) {
            $table->integer('booked_seats')->default(0)->after('total_seats');
        });
    }

    public function down(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->dropColumn('booked_seats');
        });

        Schema::table('rides', function (Blueprint $table) {
            $table->renameColumn('total_seats', 'available_seats');
        });
    }
};
