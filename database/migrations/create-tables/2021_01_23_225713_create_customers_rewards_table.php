<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Classes\Schema;

class CreateCustomersRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nexopos_customers_rewards', function (Blueprint $table) {
            $table->id();
            $table->integer( 'customer_id' );
            $table->integer( 'reward_id' );
            $table->string( 'reward_name' );
            $table->float( 'points', 11, 5 );
            $table->float( 'target', 11, 5 );
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
        Schema::dropIfExists('nexopos_customers_rewards');
    }
}
