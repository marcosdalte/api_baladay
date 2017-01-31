<?php

$app->get('/events', function ($request, $response, $args) use($app) {
    $header = $request->getHeaderLine('AUTHORIZATION');
    
    $auth = new auth;
    $auth->setApp($app);
    $container = $app->getContainer();
    if ($auth->verify($header) == false){
        $container->logger->error("'Code' => '401' 'Message' => 'UNAUTHORIZED'" . $header);
        $data = array('Code' => '401', 'Message' => 'UNAUTHORIZED');
        return $response->withStatus(401)
                        ->withJson($data);
    }

    $sth = $container->db->prepare("select idEvento, nomeEvento, dtEvento, descricao, url from evento where dtCancel >= sysdate()");
    $sth->execute();
    $cities = $sth->fetchAll();
    return $this->response->withJson($cities);
});

$app->get('/events/{idEvento}', function ($request, $response, $args) use($app) {
    $idEvento = $request->getAttribute('idEvento');
    $header = $request->getHeaderLine('AUTHORIZATION');
    
    $auth = new auth;
    $auth->setApp($app);
    $container = $app->getContainer();
    if ($auth->verify($header) == false){
        $container->logger->error("'Code' => '401' 'Message' => 'UNAUTHORIZED'" . $header);
        $data = array('Code' => '401', 'Message' => 'UNAUTHORIZED');
        return $response->withStatus(401)
                        ->withJson($data);
    }

    $sth = $container->db->prepare("select idEvento, nomeEvento, dtEvento, descricao, url from evento where idEvento = :idEvento");
    $sth->bindParam("idEvento", $idEvento);    
    $sth->execute();
    $cities = $sth->fetchAll();
    return $this->response->withJson($cities);
});

$app->get('/cities', function ($request, $response, $args) use($app) {
    $header = $request->getHeaderLine('AUTHORIZATION');
    
    $auth = new auth;
    $auth->setApp($app);
    $container = $app->getContainer();
    if ($auth->verify($header) == false){
        $container->logger->error("'Code' => '401' 'Message' => 'UNAUTHORIZED'" . $header);
        $data = array('Code' => '401', 'Message' => 'UNAUTHORIZED');
        return $response->withStatus(401)
                        ->withJson($data);
    }

    $sth = $container->db->prepare("select distinct cid.id, cid.nome from cidade cid, evento ev where cid.id = ev.fk_idCidade and ev.dtCancel >= sysdate()");
    $sth->execute();
    $cities = $sth->fetchAll();
    return $this->response->withJson($cities);
});
