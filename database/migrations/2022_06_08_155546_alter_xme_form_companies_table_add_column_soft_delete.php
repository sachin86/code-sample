<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterXmeFormCompaniesTableAddColumnSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_companies', function (Blueprint $table) {
            $table->softDeletes('archived_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_companies', function (Blueprint $table) {
            $table->dropColumn('archived_at');
        });
    }
}
