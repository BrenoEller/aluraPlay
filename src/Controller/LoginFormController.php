<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{
    public function processaRequisicao(): void 
    {
        require_once __DIR__ . "/../../view/login-form.php";
    }
}