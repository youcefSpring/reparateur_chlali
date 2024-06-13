<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CustomerGroupRepository;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index()
    {
        $sales = SaleRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->where('type', 'Sales')->get();
        return view('sale.index', compact('sales'));
    }
    public function posSale()
    {
        $sales = SaleRepository::find(request()->id);
        return view('sale.pos', compact('sales'));
    }
    public function generateInvoice($id)
    {
        $sale = SaleRepository::find($id);
        $generalsettings = GeneralSettingRepository::query()->where('shop_id', $this->mainShop()->id)->first();
        return view('sale.invoice', compact('sale', 'generalsettings'));
    }
    public function salePrint()
    {
        $request = request();
        $sales = SaleRepository::query()->orderBy('id', 'DESC')->limit($request->length)->get();
        $generalsettings = GeneralSettingRepository::query()->where('shop_id', $this->mainShop()->id)->first();
        return view('sale.salePrint', compact('sales', 'generalsettings'));
    }
    public function draft()
    {
        $drafts = SaleRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->where('type', 'Draft')->get();
        return view('sale.draft', compact('drafts'));
    }
    public function draftDelete(Sale $sale)
    {
        foreach ($sale->productSales as $draftProduct) {
            $draftProduct->product->update(['qty' => $draftProduct->product->qty + $draftProduct->qty]);
        }
        $sale->productSales()->delete();
        $sale->delete();
        return back()->with('success', 'Draft successfully deleted');
    }
    public function posData()
    {
        $categories = CategoryRepository::query()->where('shop_id', $this->mainShop()->id)->get();
        $brandes = BrandRepository::query()->where('shop_id', $this->mainShop()->id)->get();
        $featuredProducts = ProductRepository::query()->where('shop_id', $this->mainShop()->id)->whereNotNull('is_featured')->get();
        $generalSetting = GeneralSettingRepository::query()->where('shop_id', $this->mainShop()->id)->first();
        $customerGroups = CustomerGroupRepository::query()->where('shop_id', $this->mainShop()->id)->get();
        $barcodeDigits = $generalSetting->barcode_digits ?? 8;
        return $this->json('Pos data', [
            'categories' => CategoryResource::collection($categories),
            'brands' => BrandResource::collection($brandes),
            'featuredProducts' => ProductResource::collection($featuredProducts),
            'barcodeDigits' => $barcodeDigits,
            'customerGroups' => $customerGroups,
        ]);
    }
    public function sale(SaleRequest $request)
    {
        $sale = SaleRepository::storeByRequest($request);
        $message = 'Product successfull sold';
        if ($request->type == 'Draft') {
            $message = 'Product successfull drafted';
        }
        return $this->json($message, [
            'sale' => SaleResource::make($sale),
        ]);
    }
}
