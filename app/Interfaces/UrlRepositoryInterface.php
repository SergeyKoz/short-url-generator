<?php


namespace App\Interfaces;

use App\Url;

interface UrlRepositoryInterface
{
    public function store(Url $url): bool;

    public function checkUniqueHash(string $hash);

    public function getUrlByHash(string $hash): ?Url;
}
