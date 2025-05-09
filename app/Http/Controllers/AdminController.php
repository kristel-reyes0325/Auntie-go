<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;

class AdminController extends Controller
{
    // Display the deleted products
    public function deletedProducts()
    {
        // Get the deleted products from the database
        $deletedProducts = Product::onlyTrashed()->get();

        return view('admin.deleted-products', compact('deletedProducts'));
    }

    // Restore a single product
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.deleted-products')->with('success', 'Product restored successfully.');
    }

    // Restore multiple selected products
    public function restoreSelectedProducts(Request $request)
    {
        $productIds = $request->input('product_ids');

        if ($productIds) {
            Product::onlyTrashed()->whereIn('id', $productIds)->restore();
            return redirect()->route('admin.deleted-products')->with('success', 'Selected products restored successfully.');
        }

        return redirect()->route('admin.deleted-products')->with('error', 'No products selected.');
    }

    // Export deleted products to CSV
    public function exportCsv()
    {
        return Excel::download(new ProductsExport, 'deleted_products.csv');
    }

    // Export deleted products as a print-friendly format
    public function exportPrint()
    {
        $deletedProducts = Product::onlyTrashed()->get();
        return view('admin.print-deleted-products', compact('deletedProducts'));
    }
}
