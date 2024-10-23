<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Получить все продукты
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Создать новый продукт
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|integer',
            'proteins' => 'nullable|integer',
            'fats' => 'nullable|integer',
            'carbohydrates' => 'nullable|integer',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    // Получить продукт по ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Обновить информацию о продукте
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'calories' => 'sometimes|required|integer',
            'proteins' => 'nullable|integer',
            'fats' => 'nullable|integer',
            'carbohydrates' => 'nullable|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json($product);
    }

    // Удалить продукт
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
