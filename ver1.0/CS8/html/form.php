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

    <div class="alert alert-danger  "role="alert" id="errMsg"  ></div>
<div class="row">
    <div class="col-md-12">
      <form action="../php/insertForm.php" method="post">
        <form>
        <h1> Share File </h1>
        
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

<script type="text/javascript" language="javascript">
    //this function takes username entered by the user as argument and
    //checks wether that username is available
    document.getElementById("errMsg").style.display = "none";
    function checkUsername(str) {
        if (str.length != 0) {
            var xmlhttp = new XMLHttpRequest();
            //when the open() function state is changed this function is called
            xmlhttp.onreadystatechange = function() {
                //checks if the open() function state is changed to complete
                if (this.readyState == 4 && this.status == 200) {
                    allowed = (this.responseText); // stores answer returned by open function
                    if (allowed == 0)
                        {document.getElementById("errMsg").innerHTML = "Username taken";
                        document.getElementById("errMsg").style.display = "block";
                        Console.log("hey");
                        }
                    else
                       document.getElementById("errMsg").style.display = "none";
                }
            };
            // the username entered by the user is sent to the php script as a querystring
            xmlhttp.open("GET", "../php/getusername.php?q=" + str, true);
            xmlhttp.send();
        }
    }
  </script>
  </body>
