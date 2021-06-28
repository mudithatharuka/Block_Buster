<!DOCTYPE html>
<html>
<head>
	<title>List</title>
	<link rel="stylesheet" type="text/css" href="abc.css">
</head>
<body>


	
					<div class="List1">
						<ul>
							<li><a href="#">HOME <i class="fas fa-home 2x"></i></a></li>
							<li id="login"><a href="#">MOVIES <i class="fas fa-film 2x"></i></a></li>

							<div class="sub_menue">
								<ul>
									<li><a href="">ACTION</a></li>
									<li><a href="">ANIMATION</a></li>
									<li><a href="">SCI-FI</a></li>
									<li><a href="">COMADY</a></li>
									<li><a href="">HORROR</a></li>
									<li><a href="">THRILLER</a></li>
								</ul>
							</div>
							<li id="close2"><a href="#">TV SERIES <i class="fas fa-tv 2x"></i></a></li>

								<div class="sub_menue2">
									<ul>
										<li><a href="">ACTION</a></li>
										<li><a href="">ANIMATION</a></li>
										<li><a href="">SCI-FI</a></li>
										<li><a href="">COMADY</a></li>
										<li><a href="">HORROR</a></li>
										<li><a href="">THRILLER</a></li>
									</ul>
								</div>

							<li><a href="#">ABOUT US <i class="far fa-address-card 2x"></i></a></li>
						</ul>
					</div><!--List1-->


					<script>
						
							document.getElementById('login').addEventListener('click',function(){
								document.querySelector('.sub_menue').style.display = 'flex';
								document.querySelector('.sub_menue2').style.display = 'none';
							});


			document.getElementById('close2').addEventListener('click',function(){
				document.querySelector('.sub_menue2').style.display = 'flex';
				document.querySelector('.sub_menue').style.display = 'none';
			});




					</script>
	<div class="wrapper" style="height: 100px;width: 100%; background-color: red;	">

<script>
						document.querySelector('.wrapper').addEventListener('click',function(){
				document.querySelector('.sub_menue').style.display = 'none';
				document.querySelector('.sub_menue2').style.display = 'none';
			});
		</script>

</div>
</body>
</html>