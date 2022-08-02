<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PointsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function test_point_status()
    {
        $response = $this->call('GET', 'apiv1/getPoints');
        $this->assertEquals(200, $response->status());
    }

    public function test_point_has_data()
    {
        $response = $this->call('GET', 'apiv1/getPoints');
        $content = $this->response->decodeResponseJson();
        $this->assertIsArray($content['data']);
    }

    public function test_point_has_status()
    {
        $response = $this->call('GET', 'apiv1/getPoints');
        $content = $this->response->decodeResponseJson();
        $this->assertIsBool($content['status']);
    }

    public function test_point_has_status_code()
    {
        $response = $this->call('GET', 'apiv1/getPoints');
        $content = $this->response->decodeResponseJson();
        $this->assertIsNumeric($content['statusCode']);
    }

   
}
