<?php

namespace App\Repositories;

use App\Interfaces\UrlRepositoryInterface;
use App\Url;

class UrlRepository implements UrlRepositoryInterface
{
    public function store(Url $url): bool
    {
        return $url->save();
    }

    public function checkUniqueHash(string $hash)
    {
        return Url::where('hash', $hash)->count() == 0;
    }

    public function getUrlByHash(string $hash): ?Url
    {
        return Url::where('hash', $hash)
            ->where(function($query) {
                $query->where(function($query) {
                    $query->whereNotNull('expired')
                        ->where('expired', '>', date('Y-m-d'));
                })->orWhere(function($query) {
                    $query->whereNull('expired');
                });
            })->first();
    }
}
