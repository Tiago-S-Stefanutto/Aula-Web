<?php

use App\Controller\{
    AlunoController,
    InicialController,
    LoginController,
    AutorController,
    CategoriaController
    LivroController,
    EmprestimoController
};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/';
        InicialController::index();
        break;

        case '/login':
                LoginController::index();
        break;

        case '/aluno':
            AlunoController::index();
        break;
            
        case '/aluno/cadastro':
                LoginController::cadastro();
        break;    

        case '/aluno/delete':
            LoginController::delete();
        break;

        case '/autor':
            AutorController::index();
        break;

        case '/autor/delete':
            AutorController::delete();
        break;

        case '/autor/cadastro':
            AutorController::cadastro();
        break;
}