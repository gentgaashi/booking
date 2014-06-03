var app = angular.module('slimApp', ['ngRoute','ngResource','ngAnimate']);

var Resources = {};
  
app.config(function($routeProvider, $locationProvider) {
    $routeProvider.
      when('/', {
        templateUrl: '/public/templates/dashboard.html',
        controller: 'dashboardController'
      }).
      when('/help', {
        templateUrl: '/public/templates/showHelp.html',
        controller: 'showHelpController'
      }).
      when('/rooms', {
        templateUrl: '/public/templates/showRooms.html',
        controller: 'showRoomsController'
      }).
      when('/rooms/add', {
          templateUrl: '/public/templates/addRoom.html',
          controller: 'addRoomController'
      }).
      when('/rooms/prices', {
          templateUrl: '/public/templates/showPrices.html',
          controller: 'showPricesController'
      }).
      when('/rooms/edit/:id', {
          templateUrl: '/public/templates/editRoom.html',
          controller: 'editRoomController'
      }).
      when('/users', {
        templateUrl: '/public/templates/addUser.html',
        controller: 'addUserController'
      }).
      when('/booking', {
        templateUrl: '/public/templates/booking.html',
        controller: 'bookingController'
      }).
      when('/booking/add', {
        templateUrl: '/public/templates/addBooking.html',
        controller: 'addBookingController'
      }).
      otherwise({
        redirectTo: '/'
      });
  });

app.run(function($rootScope, $location, $resource){
  $rootScope.$on('$routeChangeSuccess', function(e, current, pre) {
    $(".nav li").each(function(){
      $(this).removeClass('active');
    });
      $(".nav li a").each(function(){
        
        var linkSegment = $(this).attr('href').split('/')[1];
        var shortLocation = $location.path().split('/')[1];

        if(linkSegment == shortLocation){
          $(this).parent().addClass('active');
        }
      });
    });

  Resources.Rooms = $resource('/rooms');
  Resources.Users = $resource('/users');
  Resources.Room = $resource('/rooms/:id');
  Resources.User = $resource('/users/:id');
  Resources.Bookings = $resource('/booking');
  Resources.Booking = $resource('/booking/:id');

  
});
