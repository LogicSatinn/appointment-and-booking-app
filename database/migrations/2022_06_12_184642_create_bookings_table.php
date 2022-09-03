<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('reference_code')->unique();
            $table->decimal('paid_amount', 8, 2)->default(0);
            $table->decimal('total_amount', 8, 2);
            $table->decimal('due_amount', 8, 2)->default(0);
            $table->string('booking_method')->nullable();
            $table->string('status');

            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('timetable_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('reservation_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('last_modified_by')
                ->nullable()
                ->constrained('users');

            $table->timestamp('booked_at');
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
        Schema::dropIfExists('bookings');
    }
}
