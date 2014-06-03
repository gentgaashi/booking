app.controller("dashboardController", function($scope, $resource){

	Resources.Rooms.query().$promise.then(function(rooms){
		$scope.rooms = rooms;
	});

	Resources.Users.query().$promise.then(function(users){
		$scope.users = users;
	});

	Resources.Bookings.query().$promise.then(function(bookings){
		$scope.bookings = bookings;
	});

});



app.controller('showHelpController', function($scope, $resource){
	$scope.message = "";

});

app.controller('addUserController', function($scope, $resource){
	$scope.user = {};
	
	var promise = Resources.User.query().$promise;

	promise.then(function(users){
		$scope.users = users;
	});
	
	$scope.addUser = function(){
		var user = new Resources.User();
		user.username = $scope.user.username;
		user.password = $scope.user.password;
		user.email = $scope.user.email;
		user.update = false;
		if(user.username && user.password && user.email){
			 user.$save(function(user){
			 	$scope.users.push(user);
			 });
			 $scope.user = {};

			$scope.formError = "";
		}else{
			$scope.formError = "Please fill in all the fields";
		}
	}

	$scope.deleteUser = function(id){
		Resources.User.delete({id : id},function(user){
			Resources.User.query().$promise.then(function(users){
				$scope.users = users;
			});
		});
			
	};

	$scope.checkEnter = function(user, event){
		var enterKey = 13;
		if(event.keyCode == enterKey){
			$scope.saveUser(user,event);
			$(event.target).parent().parent().find('.save-btn').fadeOut('fast');
		}
	}

	$scope.edit = function(user, e){
		$(e.target).find('span').hide();
		$(e.target).find('input').fadeIn('fast').focus();
		$(e.target).parent().find('.save-btn').fadeIn('fast');
	};

	$scope.saveUser = function(u,event){

		Resources.User.get({id:u.id}).$promise.then(function(user){

			user.username = u.username;
			user.email = u.email;
			user.update = true;
			user.$save(function(){
				$(event.target).fadeOut('fast');
				$(event.target).parent().parent().find('span').fadeIn('fast');
				$(event.target).parent().parent().find('input[type=text]').hide();
			});
		});
	}
});

app.controller('showRoomsController', function($scope, $resource){
	
	var promise = Resources.Rooms.query().$promise;

	promise.then(function(rooms){
		$scope.rooms = rooms;
	});

    $scope.deleteRoom = function(id){
		Resources.Room.delete({id : id},function(room){
			Resources.Room.query().$promise.then(function(rooms){
				$scope.rooms = rooms;
			});
		});	
	};
});

app.controller('addRoomController', function($scope, $resource, $location){

    $scope.form = {};
    $scope.form.price = {};

    $scope.addRoom = function(){
        var room = new Resources.Room();
        room.price = {};
        room.name = $scope.form.name;
        room.adults = $scope.form.adults;
        room.children = $scope.form.children;
        room.roomCount = $scope.form.roomCount;

        room.price.mon = $scope.form.price.mon;
        room.price.tue = $scope.form.price.tue;
        room.price.wed = $scope.form.price.wed;
        room.price.thu = $scope.form.price.thu;
        room.price.fri = $scope.form.price.fri;
        room.price.sat = $scope.form.price.sat;
        room.price.sun = $scope.form.price.sun;

        room.$save(function(room){
            $location.path('/rooms');
        });
    }

});

app.controller("showPricesController", function($scope, $resource, $location){
	
	var promise = Resources.Rooms.query().$promise;

	promise.then(function(rooms){
		$scope.rooms = rooms;
		angular.forEach($scope.rooms, function(room){
			room.price = room.prices;
		});

		$scope.myName = rooms[0];
	});



	$scope.edit = function(room, e){
		$(e.target).find('span').hide();
		$(e.target).find('input').fadeIn('fast').focus();
		$(e.target).parent().find('.save-btn').fadeIn('fast');
	};

	$scope.checkEnter = function(room, event){
		var enterKey = 13;
		if(event.keyCode == enterKey){
			$scope.saveRoom(room,event);
			$(event.target).parent().parent().find('.save-btn').fadeOut('fast');
		}
	}

	$scope.saveRoom = function(r,event){
		Resources.Room.get({id:r.id}).$promise.then(function(room){

			room.price = r.price;
			room.update = true;

			room.$save(function(){	
				Resources.Rooms.query().$promise.then(function(rooms){
					$scope.rooms = rooms;
					angular.forEach($scope.rooms, function(room){
						room.price = room.prices;
					});
				});

				$(event.target).fadeOut('fast');
				$(event.target).parent().parent().find('span').fadeIn('fast');
				$(event.target).parent().parent().find('input[type=number]').hide();
			});
		});
	}
});

app.controller("editRoomController", function($scope, $resource, $location, $routeParams){
	var roomId = $routeParams.id;

	Resources.Room.get({id: roomId}, function(room){
		room.price = room.prices;
		$scope.form = room;
	});

	$scope.editRoom = function(room, event){
		$scope.form.update = true;

		$scope.form.$save(function(){
			$location.path('/rooms');
		});
	}
});

app.controller("bookingController", function($scope, $resource){
	$scope.bookings = {};
	Resources.Bookings.query().$promise.then(function(bookings){

		angular.forEach(bookings, function(booking){
			booking.dateFrom = moment.unix(booking.dateFrom.timestamp).format("DD-MM-YYYY");
			booking.dateTo = moment.unix(booking.dateTo.timestamp).format("DD-MM-YYYY");
		});

		$scope.bookings = bookings;

	});

	$scope.deleteBooking = function(id){
		Resources.Booking.delete({id : id},function(booking){
			Resources.Booking.query().$promise.then(function(bookings){
				angular.forEach(bookings, function(booking){
					booking.dateFrom = moment.unix(booking.dateFrom.timestamp).format("DD-MM-YYYY");
					booking.dateTo = moment.unix(booking.dateTo.timestamp).format("DD-MM-YYYY");
				});
				$scope.bookings = bookings;
			});
		});	
	}
});

app.controller('addBookingController', function($scope, $resource, $location){

	$scope.booking = {};

	Resources.Users.query().$promise.then(function(users){
		$scope.users = users;
		//$scope.booking.user = users[0];
	});
	Resources.Rooms.query().$promise.then(function(rooms){
		$scope.rooms = rooms;
		//$scope.booking.room = rooms[0];
	});

	$scope.addBooking = function(){
		var book = new Resources.Booking();
		$scope.formError = [];

		book.dateFrom = $scope.booking.dateFrom;
		book.dateTo = $scope.booking.dateTo;
		book.room = $scope.booking.room;
		book.user = $scope.booking.user;

		if(book.dateFrom && book.dateTo && book.user && book.room){
			book.$save(function(booking){
				$location.path('/booking');	
			},
			function(error){
				$scope.formError = error.data;
			});
			
		}else{
			$scope.formError.push("Please fill in all the fields");
		}

				
	};
});