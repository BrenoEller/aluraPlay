<?php

namespace Alura\Mvc\Helper;

trait HtmlRendererTrait
{
    private function renderTemplate(string $templateName, array $context = []): string
    {
        $tempName = __DIR__ . '/../../view/';

        extract($context);
        ob_start();
        require_once $tempName . $templateName . '.php';
        return ob_get_clean();
    }
}