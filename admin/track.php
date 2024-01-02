<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header('location:login.php');
	}
?>
<?php

$trk_id="";
$trk_title="";
$trk_artist="";
$trk_album="";
$trk_lang="";
$trk_duration="";
$trk_rating="";
$pic="";
$trk_url="";

	include('inc/config.php');
	$msg="";
	
	if(isset($_POST['save']))
	{
		extract($_POST);
		
		$pic=$_FILES['trk_photo']['name'];
		
		$qs="select * from track where trk_title='$trk_title'";
		$data=mysqli_query($con,$qs);
		
			if(mysqli_num_rows($data)>0)
			{
				$msg="Data Alread Exist";
			}
			else
			{
				$qs="insert into track(trk_title,trk_artist,trk_album,trk_lang,trk_duration,trk_rating,trk_photo,trk_url)values('$trk_title','$trk_artist','$trk_album','$trk_lang','$trk_duration','$trk_rating','$pic','$trk_url')";
				
				move_uploaded_file($_FILES['trk_photo']['tmp_name'],"upload/".$pic);
				
				mysqli_query($con,$qs);
				header('location:track.php');
			}
	
	}
	
	else if(isset($_POST['update']))
	{
		extract($_POST);
		
		$pic=$_FILES['trk_photo']['name'];
		
		if($pic=="")
		{
		$qs="update track set trk_title='$trk_title',trk_artist='$trk_artist',trk_album='$trk_album',trk_lang='$trk_lang',trk_duration='$trk_duration', trk_rating='$trk_rating' where trk_id='$trk_id'";
		}
		else
		{
			move_uploaded_file($_FILES['trk_photo']['tmp_name'],"upload/".$pic);
			
			$qs="update track set trk_title='$trk_title',trk_artist='$trk_artist',trk_album='$trk_album',trk_lang='$trk_lang',trk_duration='$trk_duration', trk_rating='$trk_rating',trk_photo='$pic',trk_url='$trk_url' where trk_id='$trk_id'";
		}
		
				mysqli_query($con,$qs) or die(mysqli_error($con));
	}
	
	if(isset($_GET['id']))
	{
	$x=$_GET['id'];
	$qs="delete from track where trk_id='$x'";
	
	mysqli_query($con,$qs);
	}
	
	if(isset($_GET['eid']))
	{
		$x=$_GET['eid'];
		$qs="select * from track where trk_id='$x'";
		
		$data=mysqli_query($con,$qs);
		
		$row=mysqli_fetch_array($data);
		
		$trk_id=$row['trk_id'];
		$trk_title=$row['trk_title'];
		$trk_artist=$row['trk_artist'];
		$trk_album=$row['trk_album'];
		$trk_duration=$row['trk_duration'];
		$trk_rating=$row['trk_rating'];
		$pic=$row['trk_photo'];
		$trk_url=$row['trk_url'];
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Music Dunia - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
		
		<style>
				#set{
					padding:5px;
					background:blue;
					display:table;
					color:#fff;
					border-radius:20px;
					font-size:13px;
				}
				input[type='file']
				{
					display:none;
				}
				#set:hover
				{
					background:skyblue;
				}


				#b1
				{
					background:green;
				}
				#b1:hover
				{
					background:skyblue;
				}
			
		</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
					include('inc/sidebar.php');
				?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
									include('inc/nav.php');
								?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
									<form method="post" enctype="multipart/form-data">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Track Panel<hr color="magenta" width="850px"/></h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- category Card Example -->
										<div class=col-6>
                     
                        <div class="input-group">
												
													<label class="h5 mb-0 text-gray-800">Track Title &nbsp;</label>
													<input type="hidden" name="trk_id" value="<?php echo $trk_id; ?>"/>
													<input type="text" class="form-control bg-light border-2 small" placeholder="track name" name="trk_title" value="<?php echo $trk_title; ?>">
														
                        </div>
                    
										</div>
										
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track Artist &nbsp;</label>
														<select class="form-control bg-light border-2 small" name="trk_artist" value="<?php echo $trk_artist; ?>">
											<?php
												$q1="select * from artist";
												$data=mysqli_query($con,$q1);
												
												while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
												{
													echo "<option value='".$row['art_id']."'>
																	".$row['art_name']."
																</option>";
												}
											?>
										</select>
														
                        </div>
                    
										</div>
										</div>
										
										<br/>
										
									 <div class="row">

                        <!-- category Card Example -->
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track Album &nbsp;</label>
														<select  class="form-control bg-light border-2 small" name="trk_album" value="<?php echo $trk_album; ?>">
											<?php
												$q1="select * from album";
												$data=mysqli_query($con,$q1);
												
												while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
												{
													echo "<option value='".$row['alb_id']."'>
																	".$row['alb_name']."
																</option>";
												}
											?>
										</select>
                           
                        </div>
                   
										</div>
										
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track Language &nbsp;</label>
														<select  class="form-control bg-light border-2 small" name="trk_lang" value="<?php echo $trk_lang; ?>">
											<?php
												$q1="select * from language";
												$data=mysqli_query($con,$q1);
												
												while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
												{
													echo "<option value='".$row['lang_id']."'>
																	".$row['lang_name']."
																</option>";
												}
											?>
										</select>
                           
                        </div>
                   
										</div>
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track Duration &nbsp;</label>
														<input type="text" class="form-control bg-light border-2 small" name="trk_duration" value="<?php echo $trk_duration; ?>" placeholder="Track duration">
                        </div>
                   
										</div>
										
									</div>
										
										<br/>
										
									<div class="row">
									
										<div class=col-6>
                    
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track Rating &nbsp;</label>
														<input type="text" class="form-control bg-light border-2 small" name="trk_rating" value="<?php echo $trk_rating; ?>" placeholder="Track rating">
                        </div>
                    
										</div>
										
										<div class=col-6>
                    
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track Photo &nbsp;</label><?php echo $pic; ?>
                           <label class="btn btn-primary" id="set" />	<i class="fas fa-upload fa-sm text-red-50"></i>Upload Image<input type="file" name="trk_photo"/>></label>
                        </div>
                    
										</div>
												
                   </div>
									 <br/>
									 <div class="row">
									 
										<div class=col-6>
                    
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Track URL &nbsp;</label>
														<input type="text" class="form-control bg-light border-2 small" name="trk_url" value="<?php echo $trk_url; ?>" placeholder="Track URL">
                        </div>
                    
										</div>
										
										<div class=col-6>
												<input id="b1" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" value="Save" name="save" style="border-radius:10px;"/>
													
													<input id="b1" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" value="Update" name="update" style="border-radius:10px;"/>
												</div>
									 </div>
									</form>
										<hr color="orange" width="850px" align="left"/>
										
                    <!-- Content Row -->

                 

                    <!-- Content Row -->
                    <div class="row">

                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Details Of Tracks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
														<table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
																				<th>Track Id</th>
																				<th>Track Photo</th>
																				<th>Track Title</th>
																				<th>Track Artist</th>
																				<th>Track Album</th>
																				<th>Track language</th>
																				<th>Track Duration</th>
																				<th>Track Rating</th>
																				<th>Track URL</th>
																				<th>Edit</th>
																				<th>Delete</th>
																			</tr>
                                    </thead>
                                   
                                    <tbody>
               <?php
								$qs="select * from track left join artist on trk_artist=art_id left join album on trk_album=alb_id left join language on trk_lang=lang_id";
								$data=mysqli_query($con,$qs);
								
								while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
								{
							?>
							<tr>
								<td><?php echo $row['trk_id']; ?></td>
								<td><img src="upload/<?php echo $row['trk_photo']; ?>" style="width:100px;height:100px;"/></td>
								<td><?php echo $row['trk_title']; ?></td>
								<td><?php echo $row['art_name']; ?></td>
								<td><?php echo $row['alb_name']; ?></td>
								<td><?php echo $row['lang_name']; ?></td>
								<td><?php echo $row['trk_duration']; ?></td>
								<td><?php echo $row['trk_rating']; ?></td>
								<td><?php echo $row['trk_url']; ?></td>
								<td>
									<a href='track.php?eid=<?php echo $row['trk_id']; ?>'>Edit</a>
								</td>
								<td>
									<a onclick="return confirm('Are you sure?')" href='track.php?id=<?php echo $row['trk_id']; ?>'>Delete</a>
								</td>
							</tr>
							<?php
								}
								?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           <?php
						include('inc/footer.php');
					 ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
			include('inc/logout-modal.php');
		?>
    <?php
			include('js/script.php');
		?>
</body>

</html>