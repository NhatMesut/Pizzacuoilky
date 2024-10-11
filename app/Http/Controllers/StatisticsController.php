<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DetailOrder;
use App\Models\Employee;
use Psy\Readline\Hoa\Console;

class StatisticsController extends Controller
{
    public function index(){
        if(auth()->user()->role_id == 1){
            // Ngày hiện tại
            $todayRevenue = Order::whereDate('created_at', Carbon::today())
                ->where('status', 3)
                ->sum('total_amount');

            // Trong tuần này
            $weekRevenue = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', 3)
                ->sum('total_amount');

            // Trong tháng này
            $monthRevenue = Order::whereMonth('created_at', Carbon::now()->month)
                ->where('status', 3)
                ->sum('total_amount');

            // Tổng số hóa đơn (count) theo ngày hiện tại, trong tuần này, và trong tháng này
            $todayOrdersCount = Order::whereDate('created_at', Carbon::today())
                ->count();

            $weekOrdersCount = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->count();

            $monthOrdersCount = Order::whereMonth('created_at', Carbon::now()->month)
                ->count();
            
            // Số khách hàng mới ngày hôm nay
            $newCustomersToday = Customer::whereDate('created_at', Carbon::today())->count();

            // Tổng số sản phẩm
            $totalProducts = Product::count();

            // Tính tổng quantity trong tuần này
            $weekQuantity = DetailOrder::whereHas('order', function ($query) {
                $query->where('status', 3)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })->sum('quantity');

            // Tính tổng quantity trong tháng này
            $monthQuantity = DetailOrder::whereHas('order', function ($query) {
                $query->where('status', 3)
                    ->whereMonth('created_at', Carbon::now()->month);
            })->sum('quantity');

            return response()->json([
                'todayRevenue' => $todayRevenue,
                'weekRevenue' => $weekRevenue,
                'monthRevenue' => $monthRevenue,
                'todayOrdersCount' => $todayOrdersCount,
                'weekOrdersCount' => $weekOrdersCount,
                'monthOrdersCount' => $monthOrdersCount,
                'newCustomersToday' => $newCustomersToday,
                'totalProducts' => $totalProducts,
                'weekQuantity' => $weekQuantity,
                'monthQuantity' => $monthQuantity,
            ]);
        }else{
            if(auth()->user()->role_id == 3){
                return response()->json("Unauthorized");
            }

            $employee = auth()->user()->employee->id;
            // Ngày hiện tại
            $todayRevenue = Order::whereDate('created_at', Carbon::today())
                ->where('status', 3)
                 ->where('employee_id', $employee)
                ->sum('total_amount');

            // Trong tuần này
            $weekRevenue = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', 3)
                ->where('employee_id', $employee)
                ->sum('total_amount');

            // Trong tháng này
            $monthRevenue = Order::whereMonth('created_at', Carbon::now()->month)
                ->where('status', 3)
                ->where('employee_id', $employee)
                ->sum('total_amount');

            // Tổng số hóa đơn (count) theo ngày hiện tại, trong tuần này, và trong tháng này
            $todayOrdersCount = Order::whereDate('created_at', Carbon::today())
                ->where('employee_id', $employee)
                ->count();

            $weekOrdersCount = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', 3)
                ->where('employee_id', $employee)
                ->count();

            $monthOrdersCount = Order::whereMonth('created_at', Carbon::now()->month)
                ->where('status', 3)
                ->where('employee_id', $employee)
                ->count();
            
            // Số khách hàng mới ngày hôm nay
            $newCustomersToday = Customer::whereDate('created_at', Carbon::today())->count();

            // Tổng số sản phẩm
            $totalProducts = Product::count();

            // Tính tổng quantity trong tuần này
            $weekQuantity = DetailOrder::whereHas('order', function ($query) {
                $query->where('status', 3)
                    ->where('employee_id', auth()->user()->id)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })->sum('quantity');

            // Tính tổng quantity trong tháng này
            $monthQuantity = DetailOrder::whereHas('order', function ($query) {
                $query->where('status', 3)
                    ->where('employee_id', auth()->user()->id)
                    ->whereMonth('created_at', Carbon::now()->month);
            })->sum('quantity');

            return response()->json([
                'todayRevenue' => $todayRevenue,
                'weekRevenue' => $weekRevenue,
                'monthRevenue' => $monthRevenue,
                'todayOrdersCount' => $todayOrdersCount,
                'weekOrdersCount' => $weekOrdersCount,
                'monthOrdersCount' => $monthOrdersCount,
                'newCustomersToday' => $newCustomersToday,
                'totalProducts' => $totalProducts,
                'weekQuantity' => $weekQuantity,
                'monthQuantity' => $monthQuantity,
            ]);
        }
    }

    public function monthlyRevenue()
    {
        $currentYear = Carbon::now()->year;
        $months = range(1, 12);
        $monthlyRevenue = [];

        foreach ($months as $month) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $revenue = Order::where('status', 3)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('total_amount');

            array_push($monthlyRevenue, $revenue ?: 0);
        }

        return response()->json($monthlyRevenue);
    }

    public function monthlyOrder()
    {
        $currentYear = Carbon::now()->year;
        $months = range(1, 12);
        $monthlyOrderCount = [];

        foreach ($months as $month) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $orderCount = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            array_push($monthlyOrderCount, $orderCount);
        }

        return response()->json($monthlyOrderCount);
    }
}
