<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration //anonymous class that extends laravel's migration class
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) { // create table named applications
            $table->id();  //auto
            $table->string('company');
            $table->string('role');
            $table->string('status');
            $table->date('applied_date');
            $table->string('salary_range')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps(); //create created_at and updated_at auto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications'); // drop the table if exists
    }
};
