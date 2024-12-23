<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // First check if the old lowercase columns exist
            if (Schema::hasColumn('tasks', 'category')) {
                // Rename the columns instead of dropping and recreating
                $table->renameColumn('category', 'Category');
            }
            
            if (Schema::hasColumn('tasks', 'priority')) {
                $table->renameColumn('priority', 'Priority');
            }

            // Add EstimatedTime only if it doesn't exist
            if (!Schema::hasColumn('tasks', 'EstimatedTime')) {
                $table->integer('EstimatedTime')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Reverse the renames
            $table->renameColumn('Category', 'category');
            $table->renameColumn('Priority', 'priority');
            
            if (Schema::hasColumn('tasks', 'EstimatedTime')) {
                $table->dropColumn('EstimatedTime');
            }
        });
    }
};