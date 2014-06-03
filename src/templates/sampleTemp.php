<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css">
	<link rel='stylesheet' type='text/css' href="/public/css/style.css">
	<link rel='stylesheet' type='text/css' href="/public/css/jquery-ui.custom.min.css">
	<title>REST</title>
</head>
<body ng-app="slimApp">
<div class="container" style="position:relative">

<h2 ng-non-bindable><?= $title ?></h2>

<div class="clear"></div>
<div class="row row-1">
	<div class="col-md-2">
		<div class="nav-div">
			<ul class="nav nav-pills nav-stacked">
				<li>
					<a href="#/">Dashboard</a> 
				</li>
				<li>
					<a href="#/users">Users</a> 
				</li>
				<li>
					<a href="#/rooms">Rooms</a> 
				</li>
				<li>
					<a href="#/booking">Booking</a> 
				</li>
				<li>
					<a href="#/help">Help</a> 
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-10">
		<div style="position:relative">
			<div ng-view class="view-item">
				<img class='ajax-loader' src="/public/images/ajax-loader.GIF">
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>

<script src="/public/js/lib/jquery.min.js"></script>
<script src="/public/js/lib/jquery-ui.custom.min.js"></script>	
<script src="/public/js/lib/angular.min.js"></script>
<script src="/public/js/lib/angular-resource.min.js"></script>
<script src="/public/js/lib/angular-route.min.js"></script>
<script type="text/javascript" src="/public/js/lib/moment.min.js"></script>
<script type="text/javascript" src="/public/js/lib/angular-animate.min.js"></script>
<script src="/public/js/app.js"></script>
<script src="/public/js/controller/mainController.js"></script>

</body>
</html>