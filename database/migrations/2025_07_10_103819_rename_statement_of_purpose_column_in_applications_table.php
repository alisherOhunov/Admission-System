<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStatementOfPurposeColumnInApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('statement_of_purpose', 'motivation_letter');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->renameColumn('motivation_letter', 'statement_of_purpose');
        });
    }
}
