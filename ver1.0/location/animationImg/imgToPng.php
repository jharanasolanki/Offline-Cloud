<form method="post" enctype="multipart/form-data">
	<p>Convert JPG/GIF image to PNG</p><br>
	<input type="file" name="user_image" /><br>
	<input type="submit" name="submit" value="Submit" />
</form>

<?php
// submit button press/hit 
if(isset($_POST['submit']))
{
    if(exif_imagetype($_FILES['user_image']['tmp_name']) ==  IMAGETYPE_GIF) 
    {
		// Convert GIF to png image type
        $new_png_img = 'user_image.png';
        $png_img = imagepng(imagecreatefromgif($_FILES['user_image']['tmp_name']), $new_png_img);
    }
    elseif(exif_imagetype($_FILES['user_image']['tmp_name']) ==  IMAGETYPE_JPEG) 
    {
		// Convert JPG/JPEG to png image type
        $new_png_img = 'user_image.png';
        $png_img = imagepng(imagecreatefromjpeg($_FILES['user_image']['tmp_name']), $new_png_img);
    }
    else 
    {
		// already png image type
        $new_png_img = 'user_image.png';
    }       
}
?>