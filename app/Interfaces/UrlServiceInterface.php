<?php


namespace App\Interfaces;

use App\DataTransferObjects\UrlRequestData;
use App\Url;

interface UrlServiceInterface
{
    public function generate(UrlRequestData $data): Url;
}
