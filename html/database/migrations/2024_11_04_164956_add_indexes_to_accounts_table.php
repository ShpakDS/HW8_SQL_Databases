<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->index('date_of_birth');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->index('date_of_birth', 'date_of_birth_hash', 'HASH');
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropIndex(['date_of_birth']); // BTREE
            $table->dropIndex('date_of_birth_hash'); // HASH
        });
    }
};
