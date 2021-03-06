<?php
require 'autoload.php';

use PagSeguro\PagSeguroTransacao;
use PagSeguro\PagSeguroException;
use PagSeguro\Produto;

$sandbox = true;
$pagseguro = new PagSeguroTransacao($sandbox);

// autoRedirect=true para redirecionar automaticamente
// caso contrário, o método pagar retorna a URL do PagSeguro
// $pagseguro->autoRedirect = true;

$pagseguro->email = PAGSEGURO_EMAIL;
$pagseguro->token = PAGSEGURO_TOKEN;
$pagseguro->userAgent = 'Meu Site (+https://meusite.com.br)'; // opcional

$pagseguro->notificacaoUrl = 'https://meusite.com.br/notificar.php';
$pagseguro->redirectUrl = 'https://meusite.com.br/?pagseguro';


try {
    // Algo que identifique a compra. Máx 200 caracteres
    // Pode ser o nº do pedido, id do usuário, etc
    $pagseguro->setId('pedido_46');

    $produtos = array(

        // new Produto($id, $preco, $descricao, $quantidade),

        new Produto(123, 19.99, 'Livro de matemática', 1),
        new Produto(557, 9.99, 'Livro de português', 2),
        new Produto(9908, 15.99, 'Livro de química', 4)
    );

    $pagseguro->setProdutos($produtos);

    $url = $pagseguro->pagar();

    echo $url;
}
catch (PagSeguroException $e) {
    echo 'ERRO: ' . $e;
}
