<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a searchable, paginated listing of products.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Product::$categories;
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:150',
            'sku'            => 'required|string|max:50|unique:products,sku',
            'category'       => 'required|in:' . implode(',', Product::$categories),
            'description'    => 'nullable|string|max:2000',
            'price'          => 'required|numeric|min:0|max:99999999.99',
            'stock_quantity' => 'required|integer|min:0|max:2147483647',
            'expiry_date'    => 'nullable|date|after_or_equal:today',
            'is_active'      => 'boolean',
        ]);

        // Handle boolean checkbox
        $validated['is_active'] = $request->has('is_active');

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Product::$categories;
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:150',
            'sku'            => 'required|string|max:50|unique:products,sku,' . $product->id,
            'category'       => 'required|in:' . implode(',', Product::$categories),
            'description'    => 'nullable|string|max:2000',
            'price'          => 'required|numeric|min:0|max:99999999.99',
            'stock_quantity' => 'required|integer|min:0|max:2147483647',
            'expiry_date'    => 'nullable|date',
            'is_active'      => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}
