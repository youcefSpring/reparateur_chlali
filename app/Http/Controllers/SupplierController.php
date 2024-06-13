<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = SupplierRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        SupplierRepository::storeByRequest($request);
        return back()->with('success', 'Supplier is created successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        SupplierRepository::updateByRequest($request, $supplier);
        return back()->with('success', 'Supplier is update successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success', 'Supplier is deleted successfully!');
    }

    public function downloadSupplierSample()
    {
        return response()->download(public_path('import/sample_supplier.csv'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $file = $request->file('file');
        $csvData = array_map('str_getcsv', file($file));
        try {
            foreach ($csvData as $key => $row) {
                if ($key > 0) {
                    Supplier::create([
                        'created_by' => auth()->id(),
                        'shop_id' => $this->mainShop()->id,
                        'name' => $row[0],
                        'company_name' => $row[1],
                        'vat_number' => $row[2],
                        'email' => $row[3],
                        'phone_number' => $row[4],
                        'address' => $row[5],
                        'city' => $row[6],
                        'state' => $row[7],
                        'postal_code' => $row[8],
                        'country' => $row[9],
                    ]);
                }
            }
            return back()->with('success', 'Supplier import successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Please provide valid data in the csv file!');
        }
    }
}
