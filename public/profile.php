<?php
  if(!isset($_COOKIE['id'])) {
    header('Location: register.php');
  }
  else{
	
	$host = "pga.esilv.olfsoftware.fr";
	$port = "5432";
	$dbname = "pggrp4";
	$user = "grp47oxh6hjegww";
	$password = "99yXmThpFno"; 
	$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
	$dbconn = pg_connect($connection_string);

	$query = "SELECT * FROM webdev.users WHERE id = '".$_COOKIE['id']."'"; 
    $result = pg_query($dbconn, $query); 
    $row=pg_fetch_assoc($result);

	if(pg_num_rows($result) > 0){
        
	  $username = $row['username'];
	  $bio = $row['bio'];
	  $profil_picture = $row['profil_picture'];
	}else{
		  
    //   echo "Something Went Wrong";
	}
  }

  if(array_key_exists('logout', $_POST)) {

    if($_SERVER['SERVER_NAME'] == "localhost"){
      
      setcookie('id',"",0,"/",$_SERVER['SERVER_NAME']);
      header('Location: login.php');
    }
    else{
      unset($_COOKIE['id']); 
      setcookie('id', null, -1, '/'); 
      
      header('Location: login.php');
    }
  }

  if(isset($_POST['bio'])&&!empty($_POST['bio'])){
    

	$query = "UPDATE webdev.users SET bio =  '".$_POST['bio']."' WHERE id = '".$_COOKIE['id']."' "; 
    $ret = pg_query($dbconn, $query); 

    if($ret){
        
        // echo "Data saved Successfully";
    }else{
        
        // echo "Soething Went Wrong";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/common.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>
  <style>
    header {padding-top: 50px;}
	form {padding-top: 13px; padding-left: 6px;}
	a {cursor: pointer;}
  </style>
</head>
<body>

<!-- NavBar -->
<div class="navigation">
    <div class="logo">
      <a class="no-underline" onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/app.php');" class="navigation-link">
        Leo Crush
      </a>
    </div>
    <div class="navigation-search-container">
      <i class="fa fa-search"></i>
      <input class="search-field" type="text" placeholder="Search">
      <div class="search-container">
        <div class="search-container-box">
          <div class="search-results">

          </div>
        </div>
      </div>
    </div>
    <div class="navigation-icons">
	  <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/dm.php?id=144&convId=145');" class="navigation-link">
        <i class="far fa-envelope icon"></i>
      </a>
      <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/app.php');" class="navigation-link">
        <i class="far fa-compass iconActive"></i>
      </a>
      <a onclick="var url = window.location.toString(); window.location.href = url.replace(/\/[^\/]*$/, '/profile.php');" class="navigation-link">
        <i class="far fa-user-circle icon"></i>
      </a>
      <!-- <a href="https://instagram.com/mimoudix" id="signout" class="navigation-link">
        <i class="fas fa-sign-out-alt icon"></i>
      </a> -->
      <form method="post">
        <input type="submit" name="logout"
          class="button" value="Logout" 
        />
      </form>
    </div>
  </div>

<!-- Profile -->
<header>

	<div class="container">

		<div class="profile">

			<div class="profile-image">

			<div style="cursor:pointer;" style class="image-upload">
		     	<label style="cursor:pointer;" for="file-input">
				   <img class="picture" id="picture" style="cursor:pointer;"onClick="onFileSelected()" src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="">
				</label>
				<input style="display:none;" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture').src = window.URL.createObjectURL(this.files[0])"/>
            </div>

			</div>

			<div class="profile-user-settings">

				<h1 class="profile-user-name"><?php echo $username;?></h1>

				<button onclick="" class="btn profile-edit-btn">Edit Profile</button>

				<button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

			</div>

			<div class="profile-stats">

				<ul>
					<li><span class="profile-stat-count">164</span> posts</li>
					<li><span class="profile-stat-count">188</span> followers</li>
					<li><span class="profile-stat-count">206</span> following</li>
				</ul>

			</div>

			<div class="profile-bio">

			<form method="post">
				<input name="bio" id="bio" maxlength="50" style="width: 480px; border: 0; background-color: #fafafa;" placeholder="Add a description.." value="<?php echo $bio;?>"></input>
				<input type="submit" name="submit" class="btn btn-primary" value="Update">
			</form>

			</div>

		</div>
		<!-- End of profile section -->

	</div>
	<!-- End of container -->

</header>

<main>

	<div class="container">

		<div class="gallery">

			<div class="gallery-item" tabindex="0">

				<img id="picture2" src="https://images.unsplash.com/photo-1511765224389-37f0e77cf0eb?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture2').src = window.URL.createObjectURL(this.files[0])"/>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 56</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture3" src="https://images.unsplash.com/photo-1497445462247-4330a224fdb1?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture3').src = window.URL.createObjectURL(this.files[0])"/>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 89</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 5</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture4" src="https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture4').src = window.URL.createObjectURL(this.files[0])"/>


				<div class="gallery-item-type">

					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

				</div>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 42</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture5" src="https://images.unsplash.com/photo-1502630859934-b3b41d18206c?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture5').src = window.URL.createObjectURL(this.files[0])"/>

				<div class="gallery-item-type">

					<span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i>

				</div>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 38</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture6" src="https://images.unsplash.com/photo-1498471731312-b6d2b8280c61?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture6').src = window.URL.createObjectURL(this.files[0])"/>


				<div class="gallery-item-type">

					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

				</div>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 47</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture7" src="https://images.unsplash.com/photo-1515023115689-589c33041d3c?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture7').src = window.URL.createObjectURL(this.files[0])"/>


				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 94</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 3</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture8" src="https://images.unsplash.com/photo-1504214208698-ea1916a2195a?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture8').src = window.URL.createObjectURL(this.files[0])"/>


				<div class="gallery-item-type">

					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

				</div>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 52</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 4</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture9" src="https://images.unsplash.com/photo-1515814472071-4d632dbc5d4a?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture9').src = window.URL.createObjectURL(this.files[0])"/>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 66</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture10" src="https://images.unsplash.com/photo-1511407397940-d57f68e81203?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture10').src = window.URL.createObjectURL(this.files[0])"/>


				<div class="gallery-item-type">

					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

				</div>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 45</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture11" src="https://images.unsplash.com/photo-1518481612222-68bbe828ecd1?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture11').src = window.URL.createObjectURL(this.files[0])"/>


				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 34</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
					</ul>

				</div>

			</div>

			<div id="picture12" class="gallery-item" tabindex="0">

				<img src="https://images.unsplash.com/photo-1505058707965-09a4469a87e4?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture2').src = window.URL.createObjectURL(this.files[0])"/>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 41</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
					</ul>

				</div>

			</div>

			<div class="gallery-item" tabindex="0">

				<img id="picture13" src="https://images.unsplash.com/photo-1423012373122-fff0a5d28cc9?w=500&h=500&fit=crop" class="gallery-image" alt="">
				<input style="" id="file-input" type="file"  accept="image/*" onchange="document.getElementById('picture13').src = window.URL.createObjectURL(this.files[0])"/>

				<div class="gallery-item-type">

					<span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i>

				</div>

				<div class="gallery-item-info">

					<ul>
						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 30</li>
						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
					</ul>

				</div>

			</div>

		</div>
		<!-- End of gallery -->

		<div class="loader"></div>

	</div>
	<!-- End of container -->

</main>

</body>
</html>
   
