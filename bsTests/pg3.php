<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="ico/favicon.png">
		<script src="form.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

		<title>QcTool</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="navbar.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="../../assets/js/html5shiv.js"></script>
		  <script src="../../assets/js/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		<div class="container">
			<!-- Static navbar -->
			<div class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">QC Tool</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="#">Home</a></li>
						<li><a href="#submit">Submit</a></li>
						<li class="active"><a href="#improve">Improve</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>

			<div class="jumbotron" style = "width:49%;float:left;padding-right:10px;padding-left:10px;";>
				<i>Fill the form with data from the abstract</i>	
				<form name="Form1" method="POST">	
					<table id="Table1" border="0">
						<tbody>
							<tr>
								<td>
									<input id="url[1]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="biomarker name"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[2]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="biomarker associated with [keywords]"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[3]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="association Summary [why a biomarker]"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[4]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="total Population/ sample no"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[5]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="population/ Sample Notes"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[6]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="methods used [Biomarker Study]"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>									
									<input id="url[7]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="results (more detailed w. stats)"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[8]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="species"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[9]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="sample type"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[10]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="molecule type"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
							<tr>
								<td>
									<input id="url[11]" name="url[]" type="text" class="form-control" style = "width:500px;" placeholder="molecule subtype"/>
								</td>
							</tr>
							<tr style = "height:10px;">						
							</tr>
						</tbody>
					</table>
					<input type="submit" value="SUBMIT" name="submit" onclick="subm(this.form.url1.value); return false;">	
				</form>
			</div>

			<div class="jumbotron" id="txtHint" style = "width:49%;float:right;font-size:16px;padding-right:10px;padding-left:10px;";>
				<div id="content-wrap">
					<?php
					//get the parameters from GET URL
					$abstract_input = $_GET["abstract"];
					echo $abstract_input;
					?>
				</div>
			</div>		
		</body>
	</div> <!-- /container -->
	
	<footer>
	
		<p>&copy; medBiomarkers 2013</p>
		
	</footer>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src=".js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>			

</html>