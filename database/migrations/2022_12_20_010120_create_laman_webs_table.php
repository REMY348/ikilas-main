<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laman_webs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('kategori_saluran_id')->nullable();
            $table->integer('kategori_maklumat_id');
            $table->integer('jenis_kemaskini_id');
            $table->integer('jabatan_id')->nullable();
            $table->string('no_rujukan')->nullable();
            $table->string('tajuk');
            $table->text('keterangan');
            $table->string('uploaded_image')->nullable();
            $table->date('tarikh_mula')->nullable();
            $table->date('tarikh_tamat')->nullable();
            $table->text('ulasan')->nullable();
            $table->string('url')->nullable();
            $table->string('status');
            $table->text('perkara')->nullable();
            $table->string('mohon_by')->nullable();
            $table->string('sokong_by')->nullable();
            $table->string('tindakan_by')->nullable();
            $table->string('sesi')->nullable();
            $table->date('tarikh_mohon')->nullable();
            $table->date('tarikh_disokong')->nullable();
            $table->date('tarikh_lulus')->nullable();
            $table->string('lulus_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laman_webs');
    }
};
