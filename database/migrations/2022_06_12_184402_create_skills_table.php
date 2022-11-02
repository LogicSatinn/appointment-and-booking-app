<?php

use App\States\Skill\Draft;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('skills', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->longText('mode_of_delivery');
            $table->longText('prerequisite');
            $table->longText('suitable_for');
            $table->string('status')->default(Draft::class);
            $table->string('image_path')->nullable();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('created_by')
                ->constrained('users');
            $table->foreignId('last_modified_by')
                ->nullable()
                ->constrained('users');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
