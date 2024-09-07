<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main menu</title>
    <style>
        *{
             font-family: Arial, Helvetica, sans-serif;
             color: white;
         }
         .container{
           display: flex;
           align-items: center;
           justify-content: center;
           height: 100vh;
         }
         .content{ 
            display: grid;
            place-items: center;
            border: 1px solid black;
            width: 40%;
            height: 60%;
            background-color: cadetblue;
         }
         h2{
            display: grid;
            place-self: center;
         }
         button{
            background-color: darkcyan;
            width: 100%;
            height: 5vh;
            border: none;
            border-radius: 5px;
            cursor: pointer;
         }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Main Menu</h2>
            <div class="buttns">
                <button onclick="window.location.href = 'insert.html';" name="in">INSERT</button><br><br>
                <button onclick="window.location.href = 'edit.html';" name="ed">EDIT</button><br><br>
                <button onclick="window.location.href = 'delete.html';" name="del">DELETE</button><br><br>
                <button onclick="window.location.href = 'view.php';" name="vw">VIEW</button><br><br>
                <button onclick="window.location.href = 'search.html';" name="srch">SEARCH</button><br>
            </div>
        </div>
    </div>


    
</body>
</html>