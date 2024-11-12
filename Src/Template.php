<?php
namespace Src;

class Template {
    
    public function __construct(private string $layout) {
    }
    public function view(string $template, array $variables = []) {
        extract($variables);

        include VIEW_PATH . "$this->layout.html";
    }
}