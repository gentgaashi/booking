<?php

namespace App\Test;

use App\App;
use Slim\Environment;

class AppTest extends \PHPUnit_Framework_TestCase{

	private $app;

	function __construct()
	{
		$this->app = new App(array(
			"debug" => true,
			'templates.path' => __DIR__.'/../../templates'
		));
	}

	public function testGetUsers()
	{
		Environment::mock(array(
			'REQUEST_METHOD' => 'GET',
			'PATH_INFO' => '/users'
		));

		$this->app->call();
		$body = json_decode($this->app->response->getBody());
		$this->assertTrue(is_array($body));
		$this->assertEquals(200, $this->app->response->getStatus());
	}

	public function testHome()
	{
		$path = '/';

		Environment::mock(array(
			'REQUEST_METHOD' => 'GET',
			'PATH_INFO' => $path
		));

		$this->app->call();
		$body = $this->app->response->getBody();
		$str = 'Slim/Angular.js Hotel RESTful App';
		
		$this->assertContains($str, $body, 'String: "'.$str.'" not found at route "'.$path.'"');
		$this->assertEquals(200, $this->app->response->getStatus());
	}

	public function testGetUser()
	{
		$id = 1;

		Environment::mock(array(
			'REQUEST_METHOD' => 'GET',
			'PATH_INFO' => '/users/'.$id
		));

		$this->app->call();
		$body = json_decode($this->app->response->getBody());
		$this->assertTrue(is_object($body));
		$this->assertEquals(200, $this->app->response->getStatus());
	}

	public function testPostUser()
	{
		$env = Environment::mock(array(
			'REQUEST_METHOD' => 'POST',
			'PATH_INFO' => '/users',
            'slim.input' => 'username=Alush&password=123&email=aliii&update=true',
            'CONTENT_TYPE' => 'application/x-www-form-urlencoded',
		));

		$req = new \Slim\Http\Request($env);

		$this->app->call();
		$this->assertTrue(is_array($req->post()));
		$this->assertEquals(200, $this->app->response->getStatus());
	}

	public function testDeleteUser()
	{

		$env = Environment::mock(array(
			'REQUEST_METHOD' => 'DELETE',
			'PATH_INFO' => '/users/34'
		));

		$this->app->call();
		$req = new \Slim\Http\Request($env);

		$this->assertTrue($req->isDelete());
		$this->assertEquals(404, $this->app->response->getStatus());

	}

	//Rooms
	public function testGetRooms()
	{
		Environment::mock(array(
			'REQUEST_METHOD' => 'GET',
			'PATH_INFO' => '/rooms'
		));

		$this->app->call();
		$body = json_decode($this->app->response->getBody());
		$this->assertTrue(is_array($body));
		$this->assertEquals(200, $this->app->response->getStatus());
	}
}