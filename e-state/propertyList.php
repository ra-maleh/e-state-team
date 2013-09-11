<?php
require_once 'includes/dbFunctions.php';
require_once 'includes/connection.php';
/*
 * this page is like the normal users profile where he can view all of his 
 * properties
 */
?>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Document</title>
      <link href="styles\style.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <a href="propertyAdd.php">أضف إعلان جديد</a>

      <table>
         <thead>
            <tr>
               <th>النوع</th>
               <th>العنوان</th>
               <th>موعد النشر</th>
               <th>قائم؟</th>
               <th>مميز؟</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <th><?php
                  $query = "SELECT *"
                          . " FROM properties"
                  //. " WHERE properties.user_id = " . $_SESSION['user_id']"
                          . " ORDER BY date DESC"
                  ;
                  $propertySet = mysql_query($query);
                  confirm_query($propertySet);

                  while ($row = mysql_fetch_assoc($propertySet)) {
                     echo $row['type'] . "</th><th>" . $row['title']
                     . "</th><th>" . $row['date'] . "</th><th>"
                     . $row['depricated'] . "</th><th>" . $row['featured']
                     . "</th><th><a href=#><img src='images/delete.png'>
                                    </a></th><th><a href='propertyEdit.php'><img src='images/edit.png'>
                                    </a></th><th><a href=#><img src='images/refresh.png'>
                                    </a></th></tr><tr><th>";
                  }
                  ?>

         </tbody>
      </table>

      <?php require_once 'includes/footer.php'; ?> 
