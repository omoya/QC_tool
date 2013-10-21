<html lang="en-US">
<link rel="stylesheet" type="text/css" href="form.css">
<script src="form.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<head>
<title>QC page 3</title>
<h1>Fill the form with data from the abstract</h1>
</head>
<body>
<div id="main-wrap">	
<div id="sidebar">		
<form name="Form1" method="POST">
	
		<table id="Table1" border="0">
			<tbody>
							<tr>
								<td>
									<label for="BMname">Biomarker Name:</label>
									<input id="url[1]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="BMassociated">Biomarker associated with [keywords]:</label>
									<input id="url[2]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="summary">Association Summary [why a biomarker]:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="popNr">Total Population/ sample no:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="popNotes">Population/ Sample Notes:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="methods">Methods used [Biomarker Study]:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="results">Results (more detailed w. stats):</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="species">Species:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="sample">Sample type:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="molecule">Molecule Type:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"  />
								</td>
							</tr>
							<tr>
								<td>
									<label for="moleculeSub">Molecule Subtype:</label>
									<input id="url[3]" name="url[]"  type="text" style="float:right;width:50%"  />
								</td>
							</tr>
						</tbody>
		</table>
<input type="submit" value="SUBMIT" name="submit" onclick="subm(this.form.url1.value); return false;">	
	
</form>


</div>

	<div id="content-wrap">
			<p>Article abstract: </p>
			<?php
			//get the parameters from GET URL
			$abstract_input = $_GET["abstract"];
			echo $abstract_input;
			?>
	</div>
	<div class="CSSTableGenerator">
	<span id="insert"></span>
	</div>
</div>	
</body>			

</html>