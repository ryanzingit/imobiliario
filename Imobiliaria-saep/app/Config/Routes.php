<?php
//Rotas Públicas
// Rotas Login
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/autenticar', 'LoginController::autenticar');
$routes->get('logout', 'LoginController::logout');

//Rotas Protegidas
$routes->group('', ['filter' => 'auth'], function($routes){
    // Rota Inicio
    $routes->get('inicio', 'InicioController::index');

    // Rotas proprietario
    $routes->match(['get', 'post'], 'proprietario',  'ProprietarioController::index');
    $routes->get('proprietario/novo',                'ProprietarioController::novo');
    $routes->post('proprietario/inserir',            'ProprietarioController::inserir');
    $routes->get('proprietario/editar/(:num)',       'ProprietarioController::editar/$1');
    $routes->post('proprietario/atualizar/(:num)',   'ProprietarioController::atualizar/$1');
    $routes->get('proprietario/excluir/(:num)',      'ProprietarioController::excluir/$1');

    // Rotas Veículos
    $routes->match(['get', 'post'], 'imovel',  'ImovelController::index');
    $routes->get('imovel/novo',                'ImovelController::novo');
    $routes->post('imovel/inserir',            'ImovelController::inserir');
    $routes->get('imovel/editar/(:num)',       'ImovelController::editar/$1');
    $routes->post('imovel/atualizar/(:num)',   'ImovelController::atualizar/$1');
    $routes->get('imovel/excluir/(:num)',      'ImovelController::excluir/$1');

    // Rotas Agendamentos
    $routes->match(['get', 'post'], 'agendamentos',     'AgendamentosController::index');
    $routes->get('agendamentos/novo',                   'AgendamentosController::novo');
    $routes->post('agendamentos/inserir',               'AgendamentosController::inserir');
    $routes->get('agendamentos/editar/(:num)',          'AgendamentosController::editar/$1');
    $routes->post('agendamentos/atualizar/(:num)',      'AgendamentosController::atualizar/$1');
    $routes->get('agendamentos/excluir/(:num)',         'AgendamentosController::excluir/$1');
});