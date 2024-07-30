<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLocationFromStoresTable extends Migration
{
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            if (Schema::hasColumn('stores', 'location')) {
                $table->dropColumn('location');
            }
        });
    }

    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            if (!Schema::hasColumn('stores', 'location')) {
                $table->string('location')->nullable();
            }
        });
    }
}
