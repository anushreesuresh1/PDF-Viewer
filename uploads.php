

    <?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="UTF-8">
	<title>uploads</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="stylesheet" type= "text/css" href="style.css">
	<style>
        .wrapper{ 
        	width: 100px; 
        	padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" href="style.css">
</head>
<body>
<main>

	
		<section class="container wrapper">
			
        <div class= 'col-md-12 text-right'>
			<a href="logout.php"  text-align= "right" class="btn btn-sm btn-outline-danger" size = >Sign Out</a>
			
    </div>
			<div class="page-header">
				<h2 class="display-5">Welcome</h2>
			</div>
            
		</section>
	</main>






    

    <div class="container" style="margin-top:100px">
		<div class="card">
			<div class="col-lg-12 col-md-6 col-12 ">
            <div class=" text-center">
			<strong>Fill Title and Upload PDF</strong>
				<form method="post" enctype="multipart/form-data">
					<?php
					$con = mysqli_connect("localhost","root","","register1");
						// If submit button is clicked
						if (isset($_POST['submit']))
						{
						// get name from the form when submitted
						$name = $_POST['name'];					

						if (isset($_FILES['pdf_file']['name']))
						{
						// If the ???pdf_file??? field has an attachment
							$file_name = $_FILES['pdf_file']['name'];
							$file_tmp = $_FILES['pdf_file']['tmp_name'];
							
							// Move the uploaded pdf file into the pdf folder
							move_uploaded_file($file_tmp,"./pdf/".$file_name);
							// Insert the submitted data from the form into the table
							$insertquery =
							"INSERT INTO articles(title,data) VALUES('$name','$file_name')";
							
							// Execute insert query
							$iquery = mysqli_query($con, $insertquery);	

								if ($iquery)
							{							
					?>											
								<div class=
								"alert alert-success alert-dismissible fade show text-center">
									<a class="close" data-dismiss="alert" aria-label="close">
									??
									</a>
									<strong>Success!</strong> Data submitted successfully.
								</div>
								<?php
								}
								else
								{
								?>
								<div class=
								"alert alert-danger alert-dismissible fade show text-center">
									<a class="close" data-dismiss="alert" aria-label="close">
									??
									</a>
									<strong>Failed!</strong> Try Again!
								</div>
								<?php
								}
							}
							else
							{
							?>
								<div class=
								"alert alert-danger alert-dismissible fade show text-center">
								<a class="close" data-dismiss="alert" aria-label="close">
									??
								</a>
								<strong>Failed!</strong> File must be uploaded in PDF format!
								</div>
							<?php
							}// end if
						}// end if
					?>
					
					<div class="form-input py-2">
						<div class="form-group">
							<input type="text" class="form-control"
								placeholder="Enter your PDF name" name="name">
						</div>								
						<div class="form-group">
							<input type="file" name="pdf_file"
								class="form-control" accept=".pdf" required/>
						</div>
						<div class="form-group">
							<input type="submit"
								class="btnRegister" name="submit" value="Submit">
						</div>
					</div>
				</form>
			</div>	
            
            
			
			<div class="col-lg-12 col-md-6 col-12">
			<div class="card" style="margin-top:100px">
				<div class="card-header text-center">
				<h4>Records from Database</h4>
				</div>
				<div class="card-body">
				<div class="table-responsive">
					<table>
						<thead>
							<th>ID</th>
							<th>Title</th>
							<th>PDF</th>
						</thead>
						<tbody>
						<?php
							$selectQuery = "select * from articles";
							$squery = mysqli_query($con, $selectQuery);

							while (($result = mysqli_fetch_assoc($squery))) {
						?>
						<tr>
							<td><?php echo $result['aid']; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $result['data']; ?></td>
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





