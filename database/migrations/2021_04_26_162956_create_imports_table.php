<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateImportsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('imports', function (Blueprint $table) {
                $table->id();
                $table->string('path');
                $table->integer('total_rows')->nullable();
                $table->boolean('processed')->default(0);
                $table->foreignId('user_id')->constrained('users');
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
            Schema::dropIfExists('imports');
        }
    }
