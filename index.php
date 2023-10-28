<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <form method="post" action="process.php" enctype="multipart/form-data">

    <!-- //restricting size -->
    <!-- contoh besar nya file yg kita iinginkan adalah 1 mb dalam bytes -->
    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576">  cara ini tidak rekomen-->


    <label for="image">Image File</label>
    <input type="file" id="image" name="image" />

    <label for="file2">Another File</label>
    <input type="file" id="file2" name="file2" />

    <button>Upload</button>
  </form>
</body>

</html>