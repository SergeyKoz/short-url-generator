<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UrlRequestData;
use App\Http\Requests\GenerateUrlRequest;
use App\Interfaces\UrlServiceInterface;
use Illuminate\Support\MessageBag;

class UrlController extends Controller
{
    private UrlServiceInterface $urlService;

    public function __construct(UrlServiceInterface $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index()
    {
        return view('url.index');
    }

    public function create(GenerateUrlRequest $request, MessageBag $message_bag)
    {
        $requestData = UrlRequestData::fromRequest($request);
        try {
            $url = $this->urlService->generate($requestData);
        } catch (\Throwable $exception) {
            $message_bag->add('url', $exception->getMessage());
            return view('url.index')->withErrors($message_bag);
        }
        return redirect()->to('/')->with('hash', $url->hash);
    }
}
