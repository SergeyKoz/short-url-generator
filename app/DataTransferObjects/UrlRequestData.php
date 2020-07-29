<?php

namespace App\DataTransferObjects;

use App\Http\Requests\GenerateUrlRequest;

class UrlRequestData
{
    public string $url;

    public bool $isCustom;

    public string $customUrl;

    public ?\DateTime $expired;

    public function __construct(string $url, bool $isCustom, string $customUrl, ?\DateTime $expired)
    {
        $this->url = $url;
        $this->isCustom = $isCustom;
        $this->customUrl = $customUrl;
        $this->expired = $expired;
    }

    public static function fromRequest(GenerateUrlRequest $request): UrlRequestData
    {
        return new static(
            $request->input('url'),
            $request->input('isCustom') == 'yes',
            $request->input('customUrl') ?? '',
            $request->input('expired') == '' ? null :
                \DateTime::createFromFormat('Y-m-d', $request->input('expired'))
        );
    }
}
