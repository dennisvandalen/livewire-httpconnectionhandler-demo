<?php

namespace App;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HttpConnectionHandler extends \Livewire\Controllers\HttpConnectionHandler
{
    public function applyPersistentMiddleware()
    {
        try {
            $request = $this->makeRequestFromUrlAndMethod(
                Livewire::originalUrl(),
                Livewire::originalMethod()
            );
        } catch (NotFoundHttpException $e) {
            $request = $this->makeRequestFromUrlAndMethod(
                Str::replaceFirst(request('fingerprint')['locale'] . '/', '', Livewire::originalUrl()),
                Livewire::originalMethod()
            );
        }

        // Gather all the middleware for the original route, and filter it by
        // the ones we have designated for persistence on Livewire requests.
        $originalRouteMiddleware = app('router')->gatherRouteMiddleware($request->route());

        $persistentMiddleware = Livewire::getPersistentMiddleware();

        $filteredMiddleware = collect($originalRouteMiddleware)->filter(function ($middleware) use ($persistentMiddleware) {
            // Some middlewares can be closures.
            if (!is_string($middleware)) return false;

            return in_array(Str::before($middleware, ':'), $persistentMiddleware);
        })->toArray();

        // Now run the faux request through the original middleware with a custom pipeline.
        (new Pipeline(app()))
            ->send($request)
            ->through($filteredMiddleware)
            ->then(function () {
                // noop
            });
    }
}
