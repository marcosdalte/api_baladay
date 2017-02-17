<?php

namespace Tests\Functional;

class RoutesTest extends BaseTestCase{
    public function testGetCitiesNotAllowed(){
        $response = $this->runApp('GET', '/cities');
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('UNAUTHORIZED', (string)$response->getBody());
    }
    
    public function testGetEventsNotAllowed(){
        $response = $this->runApp('GET', '/events');
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('UNAUTHORIZED', (string)$response->getBody());
    }
    
    public function testGetEventsIdNotAllowed(){
        $response = $this->runApp('GET', '/events/100');
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('UNAUTHORIZED', (string)$response->getBody());
    }
    
    public function testGetCitiesSuccess(){
        $response = $this->runApp('GET', '/cities', 'keyword api_key:87fd0842be8454da3063361d336189da097ae5830cded00c2c42a6fc39e9f188');
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    public function testGetEventsSuccess(){
        $response = $this->runApp('GET', '/events', 'keyword api_key:87fd0842be8454da3063361d336189da097ae5830cded00c2c42a6fc39e9f188');
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    public function testGetEventsByIdSuccess(){
        $response = $this->runApp('GET', '/events/100', 'keyword api_key:87fd0842be8454da3063361d336189da097ae5830cded00c2c42a6fc39e9f188');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
