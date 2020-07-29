<?php

namespace App\Services;

use App\DataTransferObjects\UrlRequestData;
use App\Interfaces\UrlRepositoryInterface;
use App\Interfaces\UrlServiceInterface;
use App\Url;
use Exception;

class UrlService implements UrlServiceInterface
{
    private UrlRepositoryInterface $urlRepository;

    public function __construct(UrlRepositoryInterface $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * @param UrlRequestData $data
     * @return Url
     * @throws Exception
     */
    public function generate(UrlRequestData $data): Url
    {
        $url = new Url();
        $url->origin = $data->url;
        $url->is_custom = $data->isCustom;
        $url->hash = $url->is_custom ? $data->customUrl : $this->getNewHash();
        $url->expired = isset($data->expired) ? $data->expired->format('Y-m-d') : null;
        $stored = $this->urlRepository->store($url);
        if (!$stored) {
            throw new Exception('Url generation error');
        }
        return $url;
    }

    private function getNewHash()
    {
        $range = range('a', 'z');
        $hash = '';
        for ($i = 0; $i < 4; $i++) {
            $hash .= $range[array_rand($range)];
        }

        return $this->urlRepository->checkUniqueHash($hash) ? $hash : $this->getNewHash();
    }
}
