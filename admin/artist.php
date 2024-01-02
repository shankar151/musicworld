<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header('location:login.php');
	}
?>
<?php

		$art_id="";
		$art_name="";
		$art_city="";
		$art_dob="";
		$art_gender="";
		$pic="";
		
	include('inc/config.php');
	$msg="";
	
	if(isset($_POST['save']))
	{
		extract($_POST);
		
		$pic=$_FILES['art_photo']['name'];
		
		$q1="select * from artist where art_name='$art_name'";
		$data=mysqli_query($con,$q1);
		
		if(mysqli_num_rows($data)>0)
		{
			$msg="Data Already Exist";
		}
		else
		{
			$q2="insert into artist(art_name,art_gender,art_dob,art_city,art_photo)values('$art_name','$art_gender','$art_dob','$art_city','$pic')";
			
			move_uploaded_file($_FILES['art_photo']['tmp_name'],"upload/".$pic);
			
			mysqli_query($con,$q2) or die(mysqli_error($con));
			header('location:artist.php');
		}
	}
	
	else if(isset($_POST['update']))
	{
		extract($_POST);
		
		$pic=$_FILES['art_photo']['name'];
		
		if($pic=="")
		{
		$qs="update artist set art_name='$art_name',art_gender='$art_gender',art_dob='$art_dob',art_city='$art_city' where art_id='$art_id'";
		}
		else
		{
			move_uploaded_file($_FILES['art_photo']['tmp_name'],"upload/".$pic);
			
			$qs="update artist set art_name='$art_name',art_gender='$art_gender',art_dob='$art_dob',art_city='$art_city',art_photo='$pic' where art_id='$art_id'";
		}
		mysqli_query($con,$qs) or die(mysqli_error($con));
		
	}
	
	if(isset($_GET['id']))
	{
	 echo $x=$_GET['id'];
	 echo $qs="delete from artist where art_id='$x'";
	
		mysqli_query($con,$qs) or die(mysqli_error($con));
	}
	
	if(isset($_GET['eid']))
	{
		$y=$_GET['eid'];
		$q2="select * from artist where art_id='$y'";
		
		$data=mysqli_query($con,$q2);
		
		$row=mysqli_fetch_array($data);
		
		$art_id=$row['art_id'];
		$art_name=$row['art_name'];
		$art_city=$row['art_city'];
		$art_dob=$row['art_dob'];
		$art_gender=$row['art_gender'];
		$pic=$row['art_photo'];
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
                        <h1 class="h3 mb-0 text-gray-800">Artist Panel<hr color="magenta" width="850px"/></h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- category Card Example -->
										<div class=col-6>
                     
                        <div class="input-group">
												
													<label class="h5 mb-0 text-gray-800">Artist Name &nbsp;</label>
													<input type="hidden" name="art_id" value="<?php echo $art_id; ?>"/>
													<input type="text" class="form-control bg-light border-2 small" name="art_name" value="<?php echo $art_name; ?>" placeholder="Artist name">
														
                        </div>
                    
										</div>
										
										<div class=col-6>
                    
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Aritst gender &nbsp;</label>
														
									<label>Male</label><input class="form-control bg-light border-2 small" type="radio" name="art_gender" <?php if($art_gender=="male"){echo "checked";} ?> value="male"/>
									
									<label>female</label><input class="form-control bg-light border-2 small" type="radio" name="art_gender" <?php if($art_gender=="female"){echo "checked";} ?> value="female"/>
									
										<label>Others</label><input class="form-control bg-light border-2 small" type="radio" name="art_gender" <?php if($art_gender=="others"){echo "checked";} ?> value="others"/>
														
                        </div>
                    
										</div>
										</div>
										
										<br/>
										
									 <div class="row">

                        <!-- category Card Example -->
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Artist DOB &nbsp;</label><input class="form-control bg-light border-2 small" type="date" name="art_dob" value="<?php echo $art_dob; ?>">
                           
                        </div>
                    
										</div>
										
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Artist City &nbsp;</label>
														<input type="text" class="form-control bg-light border-2 small" name="art_city" value="<?php echo $art_city; ?>" placeholder="Artist city">
                        </div>
                    
										</div>
										
									</div>
										
										<br/>
										
									<div class="row">
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Artist Photo &nbsp;</label>
                           <label class="btn btn-primary" id="set" />	<i class="fas fa-upload fa-sm text-red-50"></i>Upload Image<input type="file" name="art_photo"/></label><?php echo $pic; ?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Details Of Artist</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
														<table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
																				<th>Artist Id</th>
																				<th>Artist Photo</th>
																				<th>Artist Name</th>
																				<th>Artist Gender</th>
																				<th>Artist Dob</th>
																				<th>Artist City</th>
																				<th>Edit</th>
																				<th>Delete</th>
																			</tr>
                                    </thead>
                                   
                                    <tbody>
                <?php
								$qs="select * from artist";
								$data=mysqli_query($con,$qs);
								
								while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
								{
							?>
							<tr>
								<td><?php echo $row['art_id']; ?></td>
								<td><img src="upload/<?php echo $row['art_photo']; ?>" style="width:100px;height:60px;"/></td>
								<td><?php echo $row['art_name']; ?></td>
								<td><?php echo $row['art_gender']; ?></td>
								<td><?php echo $row['art_dob']; ?></td>
								<td><?php echo $row['art_city']; ?></td>
								<td>
									<a href='artist.php?eid=<?php echo $row['art_id']; ?>'>Edit</a>
								</td>
								<td>
									<a onclick="return confirm('Are you sure?')" href='artist.php?id=<?php echo $row['art_id'];?>'>Delete</a>
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