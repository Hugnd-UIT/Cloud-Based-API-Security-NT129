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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('MANV');
            $table->foreign('MANV')->references('MANV')->on('employees');
            $table->integer('THANG');
            $table->integer('NAM');
            $table->decimal('TIENPHAT', 15, 0)->default(0);
            $table->decimal('TIENLUONGCB', 15, 0);
            $table->decimal('TIENTHUONG', 15, 0)->default(0);
            $table->decimal('TIENLUONGTL', 15, 0);
            $table->decimal('SONGAYCONG', 4, 1)->default(26);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
