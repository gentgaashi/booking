<?php
namespace App;


use App\Entity\User;
use App\Entity\Room;
use App\Entity\Booking;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class App extends \Slim\Slim{

	function __construct(array $userSettings = array())
	{
		require __DIR__.'/../../bootstrap.php';

		parent::__construct($userSettings);

		$this->get("/", function(){
			$this->render('sampleTemp.php',array('title' => 'Slim/Angular.js Hotel RESTful App'));
		});

		$this->get("/users", function() use ($em){	

			$encoders = array(new JsonEncoder());
			$normalizers = array(new GetSetMethodNormalizer());

			$serializer = new Serializer($normalizers,$encoders);

			$normalizers[0]->setIgnoredAttributes(array('password'));

			$this->response->headers->set('Content-Type', 'application/json');
			$users = $em->getRepository('App\Entity\User')->findAll();

			$json = $serializer->serialize($users, 'json');


			$this->response->setBody($json);
		});

		$this->get("/users/:id", function($id) use ($em){	

			$encoders = array(new JsonEncoder());
			$normalizers = array(new GetSetMethodNormalizer());

			$serializer = new Serializer($normalizers,$encoders);

			$normalizers[0]->setIgnoredAttributes(array('password'));

			$this->response->headers->set('Content-Type', 'application/json');
			$user = $em->getRepository('App\Entity\User')->find($id);

			$json = $serializer->serialize($user, 'json');


			$this->response->setBody($json);
		});


		$this->post("/users", function() use ($em){
			$json = json_decode($this->request->getBody());
			$error = false;

			if(isset($json->update) && $json->update == true){
				$user = $em->getRepository("App\Entity\User")->find($json->id);
				$user->setUsername($json->username);
				$user->setEmail($json->email);
			}else{
				$user = new User();

				if(isset($json->username) && isset($json->password) && isset($json->email)){
					$user->setUsername($json->username);
					$user->setPassword(sha1($json->password));
					$user->setEmail($json->email);
				}else{
					$error = true;
				}
			}

			try{
				$em->persist($user);
				$em->flush();
			}catch(\Exception $ex){
				$error = true;
			}

			$this->response->setBody(json_encode($user));
		});

		$this->delete("/users/:id", function($id) use ($em){
			$user = $em->getRepository("App\Entity\User")->find($id);
			$this->response->setBody(json_encode($user));
			
			try{
				$em->remove($user);
				$em->flush();
			}catch(\Exception $ex){
				$this->response->setStatus(404);
			}

			$this->response->setBody(json_encode($user));
			
		});

		//Rooms
		$this->get("/rooms", function() use ($em){	

			$encoders = array(new JsonEncoder());
			$normalizers = array(new GetSetMethodNormalizer());

			$serializer = new Serializer($normalizers,$encoders);

			$this->response->headers->set('Content-Type', 'application/json');
			$rooms = $em->getRepository('App\Entity\Room')->findAll();
			
			$json = $serializer->serialize($rooms, 'json');


			$this->response->setBody($json);
		});

		$this->post("/rooms", function() use($em){
			$json = json_decode($this->request->getBody());
			$errors = [];

			if(isset($json->update) && $json->update == true){
				$room = $em->getRepository("App\Entity\Room")->find($json->id);
			}else{
				$room = new Room();
			}
			
			if(isset($json->name)){
				$room->setName($json->name);
				$room->setAdults($json->adults);
				$room->setChildren($json->children);
				$room->setRoomCount($json->roomCount);

				if(isset($json->price)){
					$room->setPrices($json->price);
				}

			}else{
				$errors[] = 'Error processing form';
			}

			try{
				$em->persist($room);
				$em->flush();
			}catch(\Exception $ex){
				$errors[] = 'Error persisting to db';
			}

			if(empty($errors)){
				$this->response->setBody(json_encode($room));
			}else{
				$this->response->setStatus(404);
				$this->response->setBody(json_encode($errors));
			}
		});

		$this->delete("/rooms/:id", function($id) use ($em){
			$room = $em->getRepository("App\Entity\Room")->find($id);
			
			try{
				$em->remove($room);
				$em->flush();
			}catch(\Exception $ex){
				$this->response->setStatus(404);
			}

			$this->response->setBody(json_encode($room));
			
		});

		$this->get("/rooms/:id", function($id) use ($em){	

			$encoders = array(new JsonEncoder());
			$normalizers = array(new GetSetMethodNormalizer());

			$serializer = new Serializer($normalizers,$encoders);

			$this->response->headers->set('Content-Type', 'application/json');
			$room = $em->getRepository('App\Entity\Room')->find($id);
			$json = $serializer->serialize($room, 'json');


			$this->response->setBody($json);
		});

		//booking routes
		$this->get('/booking', function() use ($em){

			$bookings = $em->getRepository('App\Entity\Booking')->findAll();

			$encoders = array(new JsonEncoder());
			$normalizers = array(new GetSetMethodNormalizer());
			$normalizers[0]->setIgnoredAttributes(array('birthday','password'));

			$serializer = new Serializer($normalizers,$encoders);

			$this->response->headers->set('Content-Type', 'application/json');

			$json = $serializer->serialize($bookings, 'json');


			$this->response->setBody($json);

		});

		$this->delete("/booking/:id", function($id) use ($em){
			$booking = $em->getRepository("App\Entity\Booking")->find($id);
						
			try{
				$em->remove($booking);
				$em->flush();
			}catch(\Exception $ex){
				$this->response->setStatus(404);
			}
			//$booking->getRoom()->setPrices(json_decode($booking->getRoom()->getPrices(), true));
			$this->response->setBody(json_encode($booking));
			
		});

		$this->post("/booking", function() use ($em){

			$data = json_decode($this->request->getBody());
			$errors = array();

			$booking = new Booking();

			if(isset($data->dateFrom, $data->dateTo, $data->room, $data->user)){

				$room = $em->getRepository('App\Entity\Room')->find($data->room->id);
				$user = $em->getRepository('App\Entity\User')->find($data->user->id);

				if(!$room){
					$errors[] = "Room not found";
				}

				if(!$user){
					$errors[] = "User not found";
				}

				$booking->setDateFrom(new \DateTime($data->dateFrom));
				$booking->setDateTo(new \DateTime($data->dateTo));
				$booking->setRoom($room);
				$booking->setUser($user);
			}else{
				$errors[] = "All required fields were not filled";
			}
						
			

			try{
				$em->persist($booking);
				$em->flush();
			}catch(\Exception $ex){
				$errors[] = 'Error persisting to db';
			}

			if(empty($errors)){
				$this->response->setBody(json_encode($booking));
			}else{
				$this->response->setStatus(404);
				$this->response->setBody(json_encode($errors));
			}
			
		});
	}
}