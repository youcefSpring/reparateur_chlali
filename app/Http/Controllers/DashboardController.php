<?php

namespace App\Http\Controllers;

use App\Repositories\ExpenseRepository;
use App\Repositories\ProductPurchaseRepository;
use App\Repositories\ProductSaleRepository;
use App\Repositories\PurchaseRepository;
use App\Repositories\SaleRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $type = request()->type;

        $sales = SaleRepository::query()->where('shop_id', $this->mainShop()->id)
            ->when($type == 'daily', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($type == 'weekly', function ($query) {
                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($type == 'monthly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month);
            })
            ->when($type == 'yearly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year);
            })->get();

        $purchases = PurchaseRepository::query()->where('shop_id', $this->mainShop()->id)
            ->when($type == 'daily', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($type == 'weekly', function ($query) {
                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($type == 'monthly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month);
            })
            ->when($type == 'yearly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year);
            })->get();

        $productPurchases = ProductPurchaseRepository::query()->whereIn('purchase_id', $purchases->pluck('id'))
            ->when($type == 'daily', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($type == 'weekly', function ($query) {
                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($type == 'monthly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month);
            })
            ->when($type == 'yearly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year);
            })
            ->selectRaw('SUM(qty) as total_quantity, product_id')
            ->whereMonth('created_at', date('m'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $productSales = ProductSaleRepository::query()->whereIn('sale_id', $sales->pluck('id'))
            ->when($type == 'daily', function ($query) {
                return $query->whereDate('created_at', today());
            })
            ->when($type == 'weekly', function ($query) {
                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($type == 'monthly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month);
            })
            ->when($type == 'yearly', function ($query) {
                return $query->whereYear('created_at', Carbon::now()->year);
            })
            ->selectRaw('SUM(qty) as total_quantity, product_id')
            ->whereMonth('created_at', date('m'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $perMonthSales = ProductSaleRepository::query()->whereIn('sale_id', $sales->pluck('id'))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
            ->selectRaw('COALESCE(SUM(total), 0) as total_sales')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $perMonthPurchases = ProductPurchaseRepository::query()->whereIn('purchase_id', $purchases->pluck('id'))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
            ->selectRaw('COALESCE(SUM(total), 0) as total_sales')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $perMonthDabits = TransactionRepository::query()->where('shop_id', $this->mainShop()->id)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
            ->selectRaw('COALESCE(SUM(amount), 0) as total_amount')
            ->where('transection_type', 'Debit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $perMonthCredits = TransactionRepository::query()->where('shop_id', $this->mainShop()->id)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
            ->selectRaw('COALESCE(SUM(amount), 0) as total_amount')
            ->where('transection_type', 'Credit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $formattedSales = [];
        $formattedPurchases = [];
        $formattedDabits = [];
        $formattedCradits = [];

        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $formattedDate = $currentDate->format('Y-m');
            $foundDataforSale = $perMonthSales->firstWhere('month', $formattedDate);
            $foundDataforPurchase = $perMonthPurchases->firstWhere('month', $formattedDate);
            $foundDataforDabit = $perMonthDabits->firstWhere('month', $formattedDate);
            $foundDataforCredit = $perMonthCredits->firstWhere('month', $formattedDate);

            $formattedSales[] = $foundDataforSale ? (int) $foundDataforSale->total_sales : 0;
            $formattedPurchases[] = $foundDataforPurchase ? (int) $foundDataforPurchase->total_sales : 0;
            $formattedDabits[] = $foundDataforDabit ? (int) $foundDataforDabit->total_amount : 0;
            $formattedCradits[] = $foundDataforCredit ? (int) $foundDataforCredit->total_amount : 0;

            $currentDate->addMonth();
        }

        $monthlyTotalProductSales = ProductSaleRepository::query()->whereIn('sale_id', $sales->pluck('id'))
        ->when($type == 'daily', function ($query) {
            return $query->whereDate('created_at', today());
        })
        ->when($type == 'weekly', function ($query) {
            return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })
        ->when($type == 'monthly', function ($query) {
            return $query->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month);
        })
        ->when($type == 'yearly', function ($query) {
            return $query->whereYear('created_at', Carbon::now()->year);
        })->get();
        
        $expenses = ExpenseRepository::query()->where('shop_id', $this->mainShop()->id)
        ->when($type == 'daily', function ($query) {
            return $query->whereDate('created_at', today());
        })
        ->when($type == 'weekly', function ($query) {
            return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })
        ->when($type == 'monthly', function ($query) {
            return $query->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month);
        })
        ->when($type == 'yearly', function ($query) {
            return $query->whereYear('created_at', Carbon::now()->year);
        })->get();

        $monthlyProfit = 0;
        foreach ($monthlyTotalProductSales as $monthlyTotalProductSale) {
            $monthlyProfit += ($monthlyTotalProductSale->product->price - $monthlyTotalProductSale->product->cost) * $monthlyTotalProductSale->qty;
        }
        $transactions = TransactionRepository::query()->where('shop_id', $this->mainShop()->id)->latest()->take(5)->get();

        return view('dashboard.index', compact('purchases', 'monthlyProfit', 'sales', 'transactions', 'expenses', 'productPurchases', 'productSales', 'formattedSales', 'formattedPurchases', 'formattedDabits', 'formattedCradits'));
    }
}
