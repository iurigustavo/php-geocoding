<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateRoutesAddressesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('routes_addresses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('route_id')->constrained('routes');
                $table->foreignId('client_address_id')->constrained('clients_addresses');
                $table->double('distance')->nullable();
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
            Schema::dropIfExists('routes_addresses');
        }
    }
