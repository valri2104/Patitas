<?php
/**
 * Developed by Camilo Arbelaez.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * AdminProductController handles CRUD operations for product management.
 *
 * This controller provides complete administrative functionality for managing
 * products including creation, reading, updating, and deletion.
 */
class AdminProductController extends Controller
{
    /**
     * Display a listing of all products (admin view - shows all products)
     */
    public function index(): View
    {
        $viewData             = [];
        $viewData['title']    = __('admin.products.index.title');
        $viewData['subtitle'] = __('admin.products.index.subtitle');

        // Get all products (including out of stock for admin view)
        $viewData['products'] = Product::orderBy('name', 'asc')->get();

        return view('admin.product.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new product
     */
    public function create(): View
    {
        $viewData               = [];
        $viewData['title']      = __('admin.products.create.title');
        $viewData['subtitle']   = __('admin.products.create.subtitle');
        $viewData['categories'] = ['Alimento', 'Juguetes', 'Medicina', 'Accesorios'];

        return view('admin.product.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created product in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255|unique:products,name',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'category'     => 'required|in:Alimento,Juguetes,Medicina,Accesorios',
            'customizable' => 'boolean',
            'imageUrl'     => 'nullable|string',
        ]);

        // Set default value for customizable if not provided
        $validatedData['customizable'] = $validatedData['customizable'] ?? false;

        $product = new Product;
        $product->setName($validatedData['name']);
        $product->setDescription($validatedData['description']);
        $product->setPrice($validatedData['price']);
        $product->setStock($validatedData['stock']);
        $product->setCategory($validatedData['category']);
        $product->setCustomizable($validatedData['customizable']);

        if ($validatedData['imageUrl']) {
            $product->setImageUrl($validatedData['imageUrl']);
        }

        $product->save();

        return redirect()->route('admin.product.index')
            ->with('success', __('admin.products.messages.created'));
    }

    /**
     * Display the specified product
     */
    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        $viewData            = [];
        $viewData['title']   = __('admin.products.show.title', ['name' => $product->getName()]);
        $viewData['product'] = $product;

        return view('admin.product.show')->with('viewData', $viewData);
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);

        $viewData               = [];
        $viewData['title']      = __('admin.products.edit.title', ['name' => $product->getName()]);
        $viewData['subtitle']   = __('admin.products.edit.subtitle');
        $viewData['product']    = $product;
        $viewData['categories'] = ['Alimento', 'Juguetes', 'Medicina', 'Accesorios'];

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    /**
     * Update the specified product in storage
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name'         => 'required|string|max:255|unique:products,name,' . $id,
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'category'     => 'required|in:Alimento,Juguetes,Medicina,Accesorios',
            'customizable' => 'boolean',
            'imageUrl'     => 'nullable|string',
        ]);

        // Set default value for customizable if not provided
        $validatedData['customizable'] = $validatedData['customizable'] ?? false;

        $product->setName($validatedData['name']);
        $product->setDescription($validatedData['description']);
        $product->setPrice($validatedData['price']);
        $product->setStock($validatedData['stock']);
        $product->setCategory($validatedData['category']);
        $product->setCustomizable($validatedData['customizable']);

        if ($validatedData['imageUrl']) {
            $product->setImageUrl($validatedData['imageUrl']);
        }

        $product->save();

        return redirect()->route('admin.product.index')
            ->with('success', __('admin.products.messages.updated'));
    }

    /**
     * Remove the specified product from storage
     */
    public function destroy(int $id): RedirectResponse
    {
        $product     = Product::findOrFail($id);
        $productName = $product->getName();

        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', __('admin.products.messages.deleted', ['name' => $productName]));
    }
}
