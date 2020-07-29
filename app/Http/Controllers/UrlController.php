<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UrlRequestData;
use App\Http\Requests\GenerateUrlRequest;
use App\Interfaces\UrlServiceInterface;
use App\Url;

class UrlController extends Controller
{
    private UrlServiceInterface $urlService;

    public function __construct(UrlServiceInterface $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index()
    {
        return view('url.index', ['url' => new Url()]);
    }

    public function create(GenerateUrlRequest $request)
    {
        $requestData = UrlRequestData::fromRequest($request);

        try {
            $url = $this->urlService->generate($requestData);
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
        return view('url.index', ['url' => $url]);
    }
}
