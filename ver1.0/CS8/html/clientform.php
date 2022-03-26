<html>
    <head><meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Share File</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/style.css">    
    <style>
    ::placeholder {
        
        /* Firefox, Chrome, Opera */
        color: white;
    }
      
    :-ms-input-placeholder {
        
        /* Internet Explorer 10-11 */
        color: white;
    }
      
    ::-ms-input-placeholder {
        
        /* Microsoft Edge */
        color: white;
    }
    </style>
        </head>
    <body>

    <div class="col-md-12">
      <form action="../php/findShare.php" method="post">
        <form>
        <h1> Find File </h1>
        
        <fieldset>
          <label for="name">UserId:</label>
          <input type="text" id="name" name="userMail" placeholder = "Enter UserId for sharing" onkeyup="checkUsername(this.value)" >
        
          <label for="email">Password:</label>
          <input type="password" id="mail" name="userPass" placeholder = "Enter Password for sharing">
        </fieldset>
        <button type="submit">Share</button>
        
       </form>
        </div>
      </div>
  </div>
  </div>
</div>      

  </body>
