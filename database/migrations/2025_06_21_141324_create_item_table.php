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
        Schema::create('item', function (Blueprint $table) {
            $table->id(); // BIGINT unsigned auto-increment primary key
            $table->string('name'); // VARCHAR nama barang
            $table->foreignId('category_id')->constrained("category")->onDelete('cascade'); // foreign key ke categories.id
           $table->string('lokasi'); 
            $table->integer('quantity'); // jumlah barang
            $table->string('satuan')->nullable(); // satuan barang, nullable
            $table->text('description')->nullable(); // keterangan tambahan, nullable
            $table->text('penerima')->nullable(); // keterangan tambahan, nullable
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
 // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
