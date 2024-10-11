<?php

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
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('detail_product_id')->nullable()->after('id');
            // Tạm thời không thiết lập khóa ngoại
        });

        // Cập nhật giá trị mặc định hoặc phù hợp cho các hàng hiện tại ở đây nếu cần thiết
        DB::statement('UPDATE carts SET detail_product_id = (SELECT id FROM detail_products LIMIT 1) WHERE detail_product_id IS NULL');

        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('detail_product_id')->references('id')->on('detail_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['detail_product_id']);
            $table->dropColumn('detail_product_id');
        });
    }
};
