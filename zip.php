<html>
<form method="POST" action="zip.php" enctype="multipart/form_data">

Select File:<input type="file" name="file[]" multiple="multiple" required/>
<input type="submit" value="Upload" />
</form>
</html>
<?php
define("SITE_ROOT", dirname(__FILE__));
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$filesToZip = array();
	foreach ($_FILES["file"]["tmp_name"] as $key => $tmp_name) 
	{
		# code...
		$name = basename($_FILES["file"]["name"][$key]);
		$uploads_dir=SITE_ROOT."/uploads/".$name;
		array_push($filesToZip, $name);
		move_uploaded_file($_FILES["file"]["tmp_name"][$key],"$uploads_dir");
	}
	$zip = new ZipArchive;
	$zip_name = time().".zip";
	
	if ($zip->open($zip_name,ZipArchive::CREATE) === TRUE) 
	{
		foreach ($variable as $key => $value)
		{
			$zip->addFile("uploads/".$file,$file);
		}
		$zip->close();
	}
}
?>