<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class OrderCacheDB
{
    protected string $listKey = 'orders:list';
    protected string $prefix  = 'order:';

    public function all(): array
    {
        $ids = Cache::get($this->listKey, []);
        return collect($ids)
            ->map(fn($id) => Cache::get($this->prefix . $id))
            ->filter()
            ->values()
            ->toArray();
    }

    public function insert(array $data): array
    {
        $id = Cache::increment('orders:counter');
        $data['id'] = $id;
        $data['created_at'] = now()->toDateTimeString();

        Cache::put($this->prefix . $id, $data, now()->addHours(2));

        $ids = Cache::get($this->listKey, []);
        $ids[] = $id;
        Cache::put($this->listKey, $ids);

        return $data;
    }
}
