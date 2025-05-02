<?php

use Illuminate\Container\Container;
use App\Support\Mailer;
use App\Support\PdfGenerator;

return function (Container $container) {
    $container->singleton(Mailer::class, fn () => new Mailer());
    $container->singleton(PdfGenerator::class, fn () => new PdfGenerator());
};
