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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable()->after('customer_id');
            // Tạm thời không thiết lập khóa ngoại
        });

        // Cập nhật giá trị mặc định hoặc phù hợp cho các hàng hiện tại ở đây nếu cần thiết
        DB::statement('UPDATE orders SET employee_id = (SELECT id FROM employees LIMIT 1) WHERE employee_id IS NULL');

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
        });
    }
};
