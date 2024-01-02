<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header('location:login.php');
	}
?>
<?php
	include('inc/config.php');
	
	$cat_id="";
	$cat_name="";
	$cat_photo="";
	$pic="";
	$msg="";
	
	if(isset($_POST['save']))
	{
			extract($_POST);
			
			$pic=$_FILES['cat_photo']['name'];
			
			$q1="select * from category where cat_name='$cat_name'";
			
			$data=mysqli_query($con,$q1);
			
				if(mysqli_num_rows($data)>0)
				{
					$msg='Data Already Exist';
				}
				else
				{
					$qs="insert into category(cat_name,cat_photo)values('$cat_name','$pic')";
					
					move_uploaded_file($_FILES['cat_photo']['tmp_name'],"upload/".$pic);
					
					mysqli_query($con,$qs);
					header('location:category.php');
				}
			
	}
	else if(isset($_POST['update']))
	{
		extract($_POST);
		
		$pic=$_FILES['cat_photo']['name'];
		
		if($pic=="")
		{
		$qs="update category set cat_name='$cat_name' where cat_id='$cat_id'";
		}
		else
		{
			move_uploaded_file($_FILES['cat_photo']['tmp_name'],"upload/".$pic);
			
			$qs="update category set cat_name='$cat_name',cat_photo='$pic' where cat_id='$cat_id'";
		}
		mysqli_query($con,$qs) or die(mysqli_error($con));
		
	}
	
	
	if(isset($_GET['id']))
	{
	$x=$_GET['id'];
	$qs="delete from category where cat_id='$x'";
	
	mysqli_query($con,$qs);
	}
	
	if(isset($_GET['eid']))
	{
		$y=$_GET['eid'];
		$q2="select * from category where cat_id='$y'";
		
		$data=mysqli_query($con,$q2);
		
		$row=mysqli_fetch_array($data);
		
		$cat_id=$row['cat_id'];
		$cat_name=$row['cat_name'];
		$pic=$row['cat_photo'];
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
								
								<form method="post" enctype="multipart/form-data">
                <div class="container-fluid"> 

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Category Panel<hr color="magenta" width="850px"/></h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- category Card Example -->
										<div class=col-4>
										<?php
											echo $msg;
										?>
                     <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
												<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
												
													<label class="h5 mb-0 text-gray-800">Category Name &nbsp;</label>
													
													<input type="text" class="form-control bg-light border-2 small" placeholder="category name" name="cat_name" value="<?php echo $cat_name; ?>">
                           
                        </div>
                    </form>
										</div>

											<div class=col-4>
                  
                        <div class="input-group">
                            <label class="h5 mb-0 text-gray-800">Category Photo &nbsp;</label><input type="file"/>
                           <label class="btn btn-primary" id="set" />	<i class="fas fa-upload fa-sm text-red-50"></i>Upload Image<input type="file" name="cat_photo"/></label>
													 <span style="color:magenta;"><?php echo $pic; ?></span>
                        </div>
                    
										</div>
												<div class=col-4>
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
                            <h6 class="m-0 font-weight-bold text-primary">Details Of Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5" cellpadding="5">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
																						<th>Category photo</th>
                                            <th>Category name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                   
								<tbody>
									<?php
										$qs="select * from category";
										$data=mysqli_query($con,$qs);
										
										while($row=mysqli_fetch_array($data,MYSQLI_BOTH))
										{
									?>
								
								<tr>
									<td><?php echo $row['cat_id']; ?></td>
									<td><img src="upload/<?php echo $row['cat_photo']; ?>" style="width:100px;height:100px;"/></td>
									<td><?php echo $row['cat_name']; ?></td>
									<td>
									<a href='category.php?eid=<?php echo $row['cat_id']; ?>'>Edit</a>
									</td>
									<td>
										<a onclick="return confirm('Are You Sure?')" href="category.php?id=<?php echo $row['cat_id']; ?>">Delete</a>
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