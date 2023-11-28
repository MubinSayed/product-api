<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->input('category');
        $searchQuery = $request->input('q');

        $categories = json_decode((new Client())
            ->get('https://dummyjson.com/products/categories')->getBody(), true);

        // Paginate the data
        $perPage = 5;
        $currentPage = $request->input('page', 1);

        $apiUrl  = "https://dummyjson.com/products?skip=" . (($currentPage - 1) * $perPage) . "&limit=$perPage";

        if ($selectedCategory) {
            $apiUrl = "https://dummyjson.com/products/category/$selectedCategory";
        }

        if ($searchQuery) {
            $apiUrl = "https://dummyjson.com/products/search/?q=" . urlencode($searchQuery);
        }

        $data = json_decode((new Client())->get($apiUrl)->getBody(), true);

        $products = $data['products'];

        // Process data
        $processedData = [];

        foreach ($products as $product) {
            $thirdImage = isset($product['images'][2]) ? $product['images'][2] : null;
            $processedData[] = [
                'title' => $product['title'] ?? "No data found",
                'price' => $product['price'] ?? "No data found",
                'discountPercentage' => $product['discountPercentage'] ?? "No data found",
                'brand' => $product['brand'] ?? "No data found",
                'category' => $product['category'] ?? "No data found",
                'stock' => $product['stock'] ?? "No data found",
                'rating' => $product['rating'] ?? "No data found",
                'thirdImage' => $thirdImage ?? "No data found",
            ];
        }

        $totalItems = $data['total'] ?? count($processedData);
        $paginatedData = new LengthAwarePaginator($processedData, $totalItems, $perPage);
        $paginatedData->setPath($request->fullUrl());

        return view('index', [
            'data' => $paginatedData,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $searchQuery,
        ]);
    }
}
