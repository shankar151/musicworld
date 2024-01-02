 <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="a.jpg" style="width:40px;height:40px;"/>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white"><h4>Music Dunia</h4></a></li>
          <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="album.php" class="nav-link px-2 text-white">Latest Album</a></li>
          <li><a href="track.php" class="nav-link px-2 text-white">Latest Tracks</a></li>
          <li><a href="artist.php" class="nav-link px-2 text-white">Artist</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
					
						<?php
						if(!isset($_SESSION['uname']))
					{
					?>
				
          <li><a href="login.php"><button type="button" class="btn btn-outline-light me-2">Login</button></a></li>
          <li><a href="signup.php"><button type="button" class="btn btn-warning">Sign-up</button></a></li>
       
					<?php
					}
					else
					{
					?>
				 
					<li><a href="mywishlist.php" class="nav-link px-2 text-white">My Wishlist</a></li>
          <li><a href="logout.php"><button type="button" class="btn btn-outline-light me-2">Logout</button></a></li>
       
					<?php
					}
					?>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-white" placeholder="Search..." aria-label="Search">
        </form>
				
      </div>
    </div>
  </header>