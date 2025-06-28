<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if(isset ($_POST['submit']))
{
echo "nametmp:".$_FILES['file']["tmp_name"]."<br>";
echo "name:".$_FILES['file']["name"]."<br>";
echo "type :".$_FILES["file"]["type"]."<br>";
echo "size:".$_FILES ["file"]["size"]."<br>";
}
?>
<form method="post" enctype="multipart/form-data">
    
    Select Image: <input type="file" name ="file" />
    <input type="submit" value="Submit" name="submit">
</form>
</body>
</html>