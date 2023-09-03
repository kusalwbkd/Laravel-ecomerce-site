<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

           
            $table->dropColumn('selling_price');
            $table->dropColumn('discount_price');
            $table->dropColumn('short_descp');


           /*  $table->decimal('selling_price',8,2);
            $table->decimal('discount_price',8,2)->nullable();
            $table->text('short_descp');
 */
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
