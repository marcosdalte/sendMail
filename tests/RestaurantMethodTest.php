<?php

use \Application\Restaurant\Controller\Home;

class RestaurantMethodTest extends PHPUnit_Framework_TestCase {
    public function testExceptionRequestMethodInvalid() {
        // load WF_Exception
        $this->setExpectedException('Core\Exception\WF_Exception');

        // set GET to REQUEST_METHOD
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // load controller Home with POST set
        $restaurant_controller = new Home('POST');

        // call requestMethodGetTest() in Home controller
        $restaurant_controller->requestMethodGetTest();
    }

    public function testRequestMethodValid() {
        // expected 'ok'
        $this->expectOutputString('ok');

        // set POST to REQUEST_METHOD
        $_SERVER['REQUEST_METHOD'] = 'POST';

        // load controller Home with POST set
        $restaurant_controller = new Home('POST');

        // call requestMethodGetTest() in Home controller
        $restaurant_controller->requestMethodGetTest();
    }
}

?>