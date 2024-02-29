<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('spreadsheet_links', function (Blueprint $table) {
            $table->string('link')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('spreadsheet_links', function (Blueprint $table) {
            $table->string('link')->nullable(false)->change();
        });
    }
};
