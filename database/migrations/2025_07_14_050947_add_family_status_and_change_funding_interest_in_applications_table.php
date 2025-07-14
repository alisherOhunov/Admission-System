<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->smallInteger('family_status')->nullable()->after('gender');
            $table->renameColumn('funding_interest', 'needs_dormitory');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('family_status');
            $table->renameColumn('needs_dormitory', 'funding_interest');
        });
    }
};
