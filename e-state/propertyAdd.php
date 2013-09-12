<?php
require_once 'includes/dbFunctions.php';
require_once 'includes/functions.php';
require_once 'includes/connection.php';
/*
 * this form adds a new property
 */

if (isset($_POST['addProperty'])) {
   $expected = array('title', 'type', 'featured', 'price', 'image',
       'text', 'offer_type', 'contract_duration',
       'c_duration', 'payment_duration', 'p_duration',
       'levels', 'house_size', 'land_size', 'garage',
       'furnished', 'floor', 'country', 'city', 'area_name',
       'building_name');
   foreach ($expected as $key) {
      if (!empty($_POST[$key])) {
         mysql_prep($key);
         ${$key} = $_POST[$key];
      } else {
         ${$key} = NULL;
      }
   }
//convert check-boxes to integers to insert into DB
   $featured = returnByte($featured);
   $garage = returnByte($garage);
   $furnished = returnByte($furnished);

   $query = "INSERT INTO properties(user_id, title, type, featured, price,"
           . " text, offer_type, contract_duration, c_duration,"
           . " payment_duration, p_duration, garage,furnished, date,"
           . " levels,"
           . " house_size,"
           . " land_size,"
           . " floor)"
           //beware image ,session user
           . " VALUES(3,'{$title}', {$type} , {$featured}, {$price}, "
           . "'{$text}', '{$offer_type}', '{$contract_duration}', {$c_duration},"
           . "'{$payment_duration}', {$p_duration}, {$garage}, {$furnished}, CURRENT_TIME()";
   allowInQuery($levels);
   allowInQuery($house_size);
   allowInQuery($land_size);
   allowInQuery($floor);
   $query .= ")";

   $result_set = mysql_query($query);
   confirm_query($result_set);

   $query = "INSERT INTO address(property_id, area_name, building_name)"
           . " Values(LAST_INSERT_ID(), '{$area_name}', '{$building_name}')";

   $result_set = mysql_query($query);
   confirm_query($result_set);
}
?>
<!doctype html>
<html lang='en'>
   <head>
      <meta charset='UTF-8'>
      <title>Document</title>
      <link href="styles\style.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <form action='propertyAdd.php' method='post'>
         <label for='title'>العنوان</label>
         <input type='text' name='title'>required</br> 
         <label for='type'>النوع</label>
         <select name='type'>
            <option value='1'>بيت مستقل</option>
            <option value='2'>شقة</option>
            <option value='3'>عمارة</option>
            <option value='4'>أرض</option>
         </select></br>
         <label for='featured'>ميز عقارك</label>
         <input type='checkbox' name='featured'></br>
         <label for='price'>السعر</label>
         <input type='text' name='price'>required</br>
         <!--            <label for='image'>صورةالعقار من الخارج</label>
                     <input type='file' name='image'></br>-->
         <label for='text'>معلومات إضافية</label>
         <textarea name="text" rows="10" cols="20"></textarea></br>
         <label for='country'>الدولة</label>
         <select name='country'>
            <option value='1'>الأردن</option>
            <option value='2'>الإمارات</option>
            <option value='3'>السعودية</option>
         </select></br>
         <label for='city'>المدينة</label>
         <select name='city'>
            <option value='إربد'>إربد</option>
            <option value='عمان'>عمان</option>
            <option value='الزرقاء'>الزرقاء</option>
         </select></br>
         <label for='area_name'>اسم المنطقة</label>
         <input type='text' name='area_name'></br>
         <!--        -------------------------------------------------->
         <section class='villa, flat'>
            <input type="radio" name="offer_type" value="1">بيع
            <input type="radio" name="offer_type" value="2">إيجار</br>
            <label for='contract_duration'>مدة العقد</label>
            <input type='text' name='contract_duration'>
            <select name='c_duration'>
               <option value='1'>ساعة</option>
               <option value='2'>يوم</option>
               <option value='3'>شهر</option>
               <option value='4'>سنة</option>
            </select></br>
            <label for='payment_duration'>الدفع كل</label>
            <input type='text' name='payment_duration'>
            <select name='p_duration'>
               <option value='1'>يوم</option>
               <option value='2'>شهر</option>
               <option value='3'>سنة</option>
            </select></br>
            <label for='houseSize'>مساحة البيت</label>
            <input type='text' name='house_size'></br>
            <label for='furnished'>مفروش</label>
            <input type='checkbox' name='furnished'></br>
            <!--        -------------------------------------------------->
         </section>
         <section class='villa ,building'>
            <label for='levels'>عدد الطوابق</label>
            <input type='number' name='levels' min='1' max='20'></br>
         </section>
         <!--        -------------------------------------------------->
         <section class='flat, building'>
            <label for='building_name'>اسم المبنى</label>
            <input type='text' name='building_name'></br>
         </section>
         <!--        -------------------------------------------------->
         <section class='villa, building, land'>
            <label for='landSize'>مساحة الأرض</label>
            <input type='text' name='land_size'></br>
         </section>
         <!--        -------------------------------------------------->
         <section class='villa, building, flat'>
            <label for='garage'>كراج</label>
            <input type='checkbox' name='garage'></br>
         </section>
         <!--        -------------------------------------------------->
         <section class ='flat'>
            <label for='floor'>رقم الطابق</label>
            <input type='number' name='floor'></br>
         </section>
         <input type='submit' value='عرض مسبق' >
         <input type='submit' value='لصق الإعلان' name='addProperty'>
      </form>

   </body>
</html>

