<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateClientsAddressesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('clients_addresses', function (Blueprint $table) {
                $table->id();
                $table->string('street_address', 200);
                $table->string('number', 20)->nullable();
                $table->string('complement', 200)->nullable();
                $table->string('neighborhood', 200)->nullable();
                $table->string('zipcode', 20);
                $table->string('city', '100');
                $table->string('state', '20');
                $table->double('lat')->nullable();
                $table->double('lng')->nullable();
                $table->longText('place_id')->nullable();
                $table->foreignId('client_id')->constrained('clients');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('clients_addresses');
        }
    }
