<?php
require_once 'includes/dbFunctions.php';
require_once 'includes/functions.php';
require_once 'includes/connection.php';

if (isset($_POST['addProperty'])) {
   $expected = array('title', 'type', 'featured', 'price', 'image',
       'text', 'offer_type', 'contract_duration',
       'duration1', 'payment_duration', 'duration2',
       'levels', 'house_size', 'land_size', 'garage',
       'furnished', 'floor', 'country', 'city', 'area_name',
       'building_name');
   foreach ($expected as $key) {
      if (!empty($_POST[$key])) {
         ${$key} = $_POST[$key];
      } else {
         ${$key} = NULL;
      }
   }
   //convert check-boxes to integers to insert into DB
   $featured = returnByte($featured);
   $garage = returnByte($garage);
   $furnished = returnByte($furnished);

   $query = "UPDATE `e-state`.`properties`"
           . " SET `title` = '{$title}',"
           . " `type` = '{$type}', `featured` = {$featured}, `price` = {$price},"
           . " `text` = '{$text} ', `offer_type` = {$offer_type},`contract_duration` = 'سنة 2',"
           . " `payment_duration` = 'شهر 4', `levels` = {$levels}, `house_size` = {$house_size},"
           . " `furnished` = {$furnished},`garage` = {$garage},`floor` = {$floor},"
           . " `land_size` = {$land_size}"
           . " WHERE `properties`.`property_id` = 123";
   mysql_query($query);
   if (!mysql_affected_rows() == 1) {
      die("Database query failed: " . mysql_error());
   }

   $query = "UPDATE  `e-state`.`address`"
           . " SET  `country` =  {$country}, `building_name` =  '{$building_name}',"
           . " `city` =  '{$city}',`area_name` =  '{$area_name}'"
           . " WHERE  `address`.`address_id` = 13";

   mysql_query($query);
   if (!mysql_affected_rows() == 1) {
      die("Database query failed: " . mysql_error());
   }
}
$query = "SELECT *"
        . " FROM properties, address"
        . " WHERE properties.property_id = 123 AND address.property_id = 123"; //get property id from GET

$propertySet = mysql_query($query);
confirm_query($propertySet);
$row = mysql_fetch_assoc($propertySet);
?>
<!doctype html>
<html lang='en'>
   <head>
      <meta charset='UTF-8'>
      <title>Document</title>
      <link href="styles\style.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <form action='propertyEdit.php' method='post'>
         <label for='title'>العنوان</label>
         <input type='text' name='title' value="<?php echo $row['title']; ?>">required</br> 
         <label for='type'>النوع</label>
         <select name='type'>
            <option value='1' <?php if ($row['type'] == 1) echo "selected"; ?>>بيت مستقل</option>
            <option value='2' <?php if ($row['type'] == 2) echo "selected"; ?>>شقة</option>
            <option value='3' <?php if ($row['type'] == 3) echo "selected"; ?>>عمارة</option>
            <option value='4' <?php if ($row['type'] == 4) echo "selected"; ?>>أرض</option>
         </select></br>
         <label for='featured'>ميز عقارك</label>
         <input type='checkbox' name='featured' <?php if ($row['featured'] == 1) echo "checked" ?>></br>
         <label for='price'>السعر</label>
         <input type='text' name='price' value="<?php echo $row['price']; ?>">required</br>
         <!--            <label for='image'>صورةالعقار من الخارج</label>
                     <input type='file' name='image'></br>-->
         <label for='text'>معلومات إضافية</label>
         <textarea name="text" rows="10" cols="20"><?php echo $row['text']; ?></textarea></br>
         <label for='country'>الدولة</label>
         <select name='country'>
            <option value='1' <?php if ($row['country'] == 1) echo "selected"; ?>>الأردن</option>
            <option value='2' <?php if ($row['country'] == 2) echo "selected"; ?>>الإمارات</option>
            <option value='3' <?php if ($row['country'] == 3) echo "selected"; ?>>السعودية</option>
         </select></br>
         <label for='city'>المدينة</label>
         <select name='city'>
            <option value='إربد' <?php if ($row['city'] == 'إربد') echo "selected"; ?>>إربد</option>
            <option value='عمان' <?php if ($row['city'] == 'عمان') echo "selected"; ?>>عمان</option>
            <option value='الزرقاء' <?php if ($row['city'] == 'الزرقاء') echo "selected"; ?>>الزرقاء</option>
         </select></br>
         <label for='area_name'>اسم المنطقة</label>
         <input type='text' name='area_name' value="<?php echo $row['area_name']; ?>"></br>
         <!--        -------------------------------------------------->
         <section class='villa, flat'>
            <input type="radio" name="offer_type" value="1" <?php if ($row['offer_type'] == 1) echo "checked"; ?>>بيع
            <input type="radio" name="offer_type" value="2" <?php if ($row['offer_type'] == 2) echo "checked"; ?>>إيجار</br>
            <label for='contract_duration'>مدة العقد</label>
            <input type='text' name='contract_duration' value="<?php echo $row['contract_duration']; ?>">
            <select name='duration1'>
               <option value='ساعة'>ساعة</option>
               <option value='يوم'>يوم</option>
               <option value='شهر'>شهر</option>
               <option value='سنة'>سنة</option>
            </select></br>
            <label for='payment_duration'>الدفع كل</label>
            <input type='text' name='payment_duration' value="<?php echo $row['payment_duration']; ?>">
            <select name='duration2'>
               <option value='يوم'>يوم</option>
               <option value='شهر'>شهر</option>
               <option value='سنة'>سنة</option>
            </select></br>
            <label for='houseSize'>مساحة البيت</label>
            <input type='text' name='house_size' value="<?php echo $row['house_size']; ?>"></br>
            <label for='furnished'>مفروش</label>
            <input type='checkbox' name='furnished' <?php if ($row['furnished'] == 1) echo "checked" ?>></br>
            <!--        -------------------------------------------------->
         </section>
         <section class='villa ,building'>
            <label for='levels'>عدد الطوابق</label>
            <input type='number' name='levels' min='1' max='20' value="<?php echo $row['levels']; ?>"></br>
         </section>
         <!--        -------------------------------------------------->
         <section class='flat, building'>
            <label for='building_name'>اسم المبنى</label>
            <input type='text' name='building_name' value="<?php echo $row['building_name']; ?>"></br>
         </section>
         <!--        -------------------------------------------------->
         <section class='villa, building, land'>
            <label for='landSize'>مساحة الأرض</label>
            <input type='text' name='land_size' value="<?php echo $row['land_size']; ?>"></br>
         </section>
         <!--        -------------------------------------------------->
         <section class='villa, building, flat'>
            <label for='garage'>كراج</label>
            <input type='checkbox' name='garage'></br>
         </section>
         <!--        -------------------------------------------------->
         <section class ='flat'>
            <label for='floor'>رقم الطابق</label>
            <input type='number' name='floor' value="<?php echo $row['floor']; ?>"></br>
         </section>
         <input type='submit' value='عرض مسبق' >
         <input type='submit' value='لصق الإعلان' name='addProperty'>
      </form>
   </body>
</html>
