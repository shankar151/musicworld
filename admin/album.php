<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header('location:login.php');
	}
?>
<?php
$alb_id="";
$alb_name="";
$alb_cat="";
$alb_rel_date="";
$alb_production="";
$pic="";

	include('inc/config.php');
	$msg="";
	
	if(isset($_POST['save']))
		
	{
	extract($_POST);
		
		$pic=$_FILES['alb_photo']['name'];
		
		$q1="select * from album where alb_name='$alb_name'";
		$data=mysqli_query($con,$q1) or die(mysqli_error($con));
		
		if(mysqli_num_rows($data)>0)
		{
			$msg="Data Already Exist";
		}
		else
		{
			
		$q2="insert into album(alb_name,alb_cat,alb_rel_date,alb_production,alb_photo)values('$alb_name','$alb_cat','$alb_rel_date','$alb_production','$pic')";
		
		move_uploaded_file($_FILES['alb_photo']['tmp_name'],"upload/".$pic);
		
		mysqli_query($con,$q2) or die(mysqli_error($con));
		header('location:album.php');
		}
	}
	
	else if(isset($_POST['update']))
	{
		extract($_POST);
		
		$pic=$_FILES['alb_photo']['name'];
		
		if($pic=="")
		{
		$qs="update album set alb_name='$alb_name',alb_cat='$alb_cat',alb_rel_date='$alb_rel_date',alb_production='$alb_production' where alb_id='$alb_id'";
		}
		else
		{
			move_uploaded_file($_FILES['alb_photo']['tmp_name'],"upload/".$pic);
			
				$qs="update album set alb_name='$alb_name',alb_cat='$alb_cat',alb_rel_date='$alb_rel_date',alb_production='$alb_production',alb_photo='$pic' where alb_id='$alb_id'";
		}
		echo $qs;
		mysqli_query($con,$qs) or die(mysqli_error($con));
		
	}
	if(isset($_GET['id']))
	{
	$x=$_GET['id'];
	$qs="delete from album where alb_id='$x'";
	
	mysqli_query($con,$qs);
	}
	
	if(isset($_GET['eid']))
	{
		$y=$_GET['eid'];
		$q2="select * from album where alb_id='$y'";
		
		$data=mysqli_query($con,$q2);
		
		$row=mysqli_fetch_array($data);
		
		$alb_id=$row['alb_id'];
		$alb_name=$row['alb_name'];
		$alb_cat=$row['alb_cat'];
		$alb_rel_date=$row['alb_rel_date'];
		$alb_production=$row['alb_production'];
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
                        <h1 class="h3 mb-0 text-gray-800">Album Panel<hr color="magenta" width="850px"/></h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- category Card Example -->
										<div class=col-6>
                     
                        <div class="input-group">
												
													<label class="h5 mb-0 text-gray-800">Album Name &nbsp;</label>
													<input type="hidden" name="alb_id" value="<?php echo $alb_id; ?>" />
													
													<input type="text" class="form-control bg-light border-2 small" placeholder="Album name" value="<?php echo $alb_name; ?>" name="alb_name">
														
                        </div>
                    
										</div>
										
										<div class=col-6>
                    
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Album Category &nbsp;</label>
														<select name="alb_cat"  value="<?php echo $alb_cat; ?>" class="form-control bg-light border-2 small">
											<?php
												$qs="select * from category";
												$data=mysqli_query($con,$qs);
												
												while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
												{
													echo "<option value='".$row['cat_id']."'>
																	".$row['cat_name']."
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
                            <label class="h5 mb-0 text-gray-800">Album Rel Date &nbsp;</label><input class="form-control bg-light border-2 small" type="date" name="alb_rel_date"  value="<?php echo $alb_rel_date; ?>">
                           
                        </div>
                    
										</div>
										
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Album Production &nbsp;</label>
														<input type="text" class="form-control bg-light border-2 small" name="alb_production"  value="<?php echo $alb_production; ?>" placeholder="Album production">
                        </div>
                    
										</div>
										
									</div>
										
										<br/>
										
									<div class="row">
										<div class=col-6>
                     
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Album Photo &nbsp;</label>
                           <label class="btn btn-primary" id="set" />	<i class="fas fa-upload fa-sm text-red-50"></i>Upload Image<input type="file" name="alb_photo"/></label>
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
                            <h6 class="m-0 font-weight-bold text-primary">Details Of Album</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
														<table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
																					<th>Album Id</th>
																					<th>Album Photo</th>
																					<th>Album Name</th>
																					<th>Album Category</th>
																					<th>Album Release Date</th>
																					<th>Album Production</th>
																					<th>Edit</th>
																					<th>Delete</th>
																				</tr>
                                    </thead>
                                   
                                    <tbody>
                <?php
									$qs="select * from album left join category on alb_cat=cat_id";
									$data=mysqli_query($con,$qs);
									
									while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
									{
								?>
								<tr>
									<td><?php echo $row['alb_id']; ?></td>
									<td><img src="upload/<?php echo $row['alb_photo']; ?>" style="width:100px;height:70px;"/></td>
									<td><?php echo $row['alb_name']; ?></td>
									<td><?php echo $row['cat_name']; ?></td>
									<td><?php echo $row['alb_rel_date']; ?></td>
									<td><?php echo $row['alb_production']; ?></td>
									<td>
									<a href='album.php?eid=<?php echo $row['alb_id']; ?>'>Edit</a>
									</td>
									<td>
										<a onclick="return confirm('Are you sure?')" href='album.php?id=<?php echo $row['alb_id']; ?>'>Delete</a>
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