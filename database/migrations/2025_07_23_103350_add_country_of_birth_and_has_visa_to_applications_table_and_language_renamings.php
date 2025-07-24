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
        Schema::table('applications', function (Blueprint $table) {
            // Add new columns
            $table->string('country_of_birth', 128)->nullable();
            $table->boolean('has_visa')->nullable()->default(null);

            // Rename columns
            $table->renameColumn('english_test_type', 'language_test_type');
            $table->renameColumn('english_test_score', 'language_test_score');
            $table->renameColumn('english_test_date', 'language_test_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop newly added columns
            $table->dropColumn(['country_of_birth', 'has_visa']);

            // Revert renamed columns
            $table->renameColumn('language_test_type', 'english_test_type');
            $table->renameColumn('language_test_score', 'english_test_score');
            $table->renameColumn('language_test_date', 'english_test_date');
        });
    }
};
