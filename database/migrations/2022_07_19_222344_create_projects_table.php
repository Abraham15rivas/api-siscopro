<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('general_objective');
            $table->longText('scope');
            $table->longText('justification');
            $table->longText('observations')->nullable();
            $table->decimal('requested_amount');
            $table->text('execution_time');
            $table->jsonb('actors');
            $table->longText('productive_engine');
            $table->longText('product_project');
            $table->longText('project_impact');
            $table->longText('direct_benefits');
            $table->longText('investment_line')->nullable();

            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('SET NULL')
                ->onDelete('SET NULL');

            $table->foreignId('institution_id')
                ->constrained()
                ->onUpdate('SET NULL')
                ->onDelete('SET NULL');

            $table->foreignId('project_type_id')
                ->constrained()
                ->onUpdate('SET NULL')
                ->onDelete('SET NULL');

            $table->foreignId('project_status_id')
                ->constrained()
                ->onUpdate('SET NULL')
                ->onDelete('SET NULL');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
