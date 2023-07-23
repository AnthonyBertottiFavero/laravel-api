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
        Schema::table('portfolios', function (Blueprint $table) {
            // creare la colonna della chiave esterna
            $table->unsignedBigInteger('type_id')->after('id');

            // definire la colonna come chiave esterna
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // eliminare la chiave esterna
            $table->dropForeign('portfolios_type_id_foreign');

            // eliminare la colonna
            $table->dropColumn('type_id');
        });
    }
};
