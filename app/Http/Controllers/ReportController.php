<?php

namespace App\Http\Controllers;

use App\Repositories\ProductSaleRepository;
use App\Repositories\PurchaseRepository;
use App\Repositories\SaleRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function summary()
    {
        $purchases = PurchaseRepository::query()->where('shop_id', $this->mainShop()->id)->whereMonth('created_at', date('m'))->get();
        $sales = SaleRepository::query()->where('shop_id', $this->mainShop()->id)->whereMonth('created_at', date('m'))->get();
        $transactions = TransactionRepository::query()->where('shop_id', $this->mainShop()->id)->whereMonth('created_at', date('m'))->where('transection_type', 'Credit')->get();

        //purchase
        $totalPurchasesAmount = $purchases->sum('grand_total');
        $totalPaidAmount = $purchases->sum('paid_amount');
        $totalPurchasesTax = $purchases->sum('total_tax');
        $totalPurchaseProducts = $purchases->sum('total_qty');
        $totalPurchasesDiscount = $purchases->sum('total_discount');

        //sales
        $totalSaleAmount = $sales->sum('grand_total');
        $totalSaleTax = $sales->sum('total_tax');
        $totalSaleProducts = $sales->sum('total_qty');
        $totalSaleDiscount = $sales->sum('total_discount');

        //transactions
        $totalPaymentRecieved = $transactions->sum('amount');
        $totalPaymentRecievedCash = $transactions->where('payment_method', 'Cash')->sum('amount');
        $totalPaymentRecievedBank = $transactions->where('payment_method', 'Bank')->sum('amount');
        $totalPaymentRecievedCashCount = $transactions->where('payment_method', 'Cash')->count();
        $totalPaymentRecievedBankCount = $transactions->where('payment_method', 'Bank')->count();

        $monthlyTotalProductSales = ProductSaleRepository::query()->whereMonth('created_at', date('m'))->get();
        $monthlyProfit = 0;
        foreach ($monthlyTotalProductSales as $productSales) {
            $monthlyProfit += ($productSales->net_unit_price - $productSales->product->cost) * $productSales->qty;
        }

        return view('report.summary', compact(
            'totalPurchasesAmount',
            'totalPurchaseProducts',
            'totalPaidAmount',
            'totalPurchasesTax',
            'totalPurchasesDiscount',
            'totalSaleAmount',
            'totalSaleTax',
            'totalSaleDiscount',
            'totalSaleProducts',
            'totalPaymentRecieved',
            'totalPaymentRecievedCash',
            'totalPaymentRecievedBank',
            'totalPaymentRecievedCashCount',
            'totalPaymentRecievedBankCount',
            'monthlyProfit'
        ));
    }
}
