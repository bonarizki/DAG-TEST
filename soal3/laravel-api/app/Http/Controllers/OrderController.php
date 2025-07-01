<?php

namespace App\Http\Controllers;

use App\Helpers\OrderCacheDB;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    protected OrderCacheDB $orderDb;

    /**
     * __construct
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __construct()
    {
        $this->orderDb = new OrderCacheDB;
    }

    /**
     * Menampilkan daftar order.
     * Jika parameter 'customer_name' diberikan, hasil akan difilter berdasarkan nama customer.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(OrderRequest $request)
    {
        // Ambil semua data order dari "database" cache
        $orders = $this->orderDb->all();

        // Jika ada parameter customer_name pada request, lakukan filter
        if ($request->has('customer_name')) {
            // Ubah customer_name menjadi lowercase untuk pencocokan tanpa case sensitive
            $name = strtolower($request->customer_name);

            // Filter orders berdasarkan customer_name
            $orders = collect($orders)->filter(function ($order) use ($name) {
                // Bandingkan nama customer pada order dengan input (case insensitive)
                return strtolower($order['customer_name']) === $name;
            })->values()->all(); // Reset index array hasil filter
        }

        if ($orders === []) {
            // Jika tidak ada order yang ditemukan, kembalikan response JSON dengan pesan error
            return response()->json([
                'message' => 'No orders found',
                'data' => []
            ], 404);
        }
        
        // Kembalikan response JSON berisi daftar order
        return response()->json([
            'message' => 'Order list retrieved successfully',
            'data' => $orders
        ], 200);
    }

    /**
     * Menyimpan order baru ke "database" cache.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request)
    {
        // Simpan order baru ke "database" cache setelah validasi
        $order = $this->orderDb->insert($request->validated());

        // Kembalikan response JSON dengan pesan sukses dan ID order
        return response()->json([
            'message' => 'Order received successfully',
            'order_id' => $order['id']
        ], 201);
    }
}
