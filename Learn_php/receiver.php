<?php


if (isset($_GET['var1'])){
    echo $_GET ['var1'];
}
else{
    echo 'This page has a variable named var1 but it&apos;s not declared in url <br>';
}
if(isset($_GET['var2'])){
    echo  $_GET['var2']."<br>";
    echo "Hi Ali,I&apos;m going to buy a new  $_GET[var2] set, the model will be $_GET[var3]";
}
$str1="This is a string";


?>

This is the Receiver page 