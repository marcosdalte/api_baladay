<?php
// Routes

$app->get('/[{evento}]', function ($request, $response, $args) use($app) {
    $evento = $request->getAttribute('evento');
    $header = $request->getHeaderLine('AUTHORIZATION');
    
    $auth = new auth();
    $auth->setApp($app);
    
    if ($auth->verify($header) == false){
        $data = array('Code' => '401', 'Message' => 'UNAUTHORIZED');
        return $response->withStatus(401)
                        ->withJson($data);
    }

    $data = array('cidade' => $cidade, 'evento' => $evento);
    return $this->response->withJson($data);
});