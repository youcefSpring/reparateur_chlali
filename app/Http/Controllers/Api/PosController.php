<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CustomerGroupResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TaxResource;
use App\Http\Resources\WarehouseResource;
use App\Models\GeneralSetting;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CustomerGroupRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use App\Repositories\TaxRepository;
use App\Repositories\WarehouseRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class PosController extends Controller
{
    public function pos()
    {
        $customers = CustomerRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        $customerGroups = CustomerGroupRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        $warehouses = WarehouseRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        $taxes = TaxRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        $products = ProductRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->whereNotNull('is_featured')->get();
        $brands = BrandRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        $categories = CategoryRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        $generalSetting = GeneralSetting::where('shop_id', $this->mainShop()->id)->first();
        $currency = $generalSetting->defaultCurrency?->symbol ?? '$';
        $barcodeDigits = $generalSetting->barcode_digits ?? 8;

        return $this->json('Pos data', [
            'customers' => CustomerResource::collection($customers),
            'customerGroups' => CustomerGroupResource::collection($customerGroups),
            'warehouses' => WarehouseResource::collection($warehouses),
            'categories' => CategoryResource::collection($categories),
            'taxes' => TaxResource::collection($taxes),
            'featuredProducts' => ProductResource::collection($products),
            'brands' => BrandResource::collection($brands),
            'currency' => $currency,
            'barcodeDigits' => $barcodeDigits,
        ]);
    }
    public function store(SaleRequest $request)
    {
        $sale = SaleRepository::storeByRequest($request);
        $message = 'Product successfull sold';
        if ($request->type == 'Draft') {
            $message = 'Product successfull drafted';
        }
        return $this->json($message, [
            'invoice_pdf_url' => $request->type == 'Draft' ? null : $this->downloadInvoice($sale->id),
        ]);
    }
    public function details($id)
    {
        $sale = SaleRepository::query()->where('id', $id)->first();
        $products = [];
        foreach ($sale->productSales as $productSales) {
            $products[] = ProductResource::make($productSales->product);
        }
        return $this->json('Product successfull drafted', [
            'products' => $products,
        ]);
    }
    private function downloadInvoice($id)
    {
        $sale = SaleRepository::find($id);
        if (!$sale) {
            return $this->json('Sale id not found', [], 422);
        }
        $generalsettings = GeneralSettingRepository::query()->where('shop_id', $this->mainShop()->id)->first();

        $pdf = Pdf::loadView('sale.invoice', compact('sale', 'generalsettings'));

        $storagePath = storage_path('app/public/invoices');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }
        $pdfPath = $storagePath . '/' . $id . '.pdf';
        $pdf->save($pdfPath);
        $path = asset('storage/invoices/' . $id . '.pdf');
        return $path;
    }
}
