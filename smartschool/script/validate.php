<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<?php 
$method = $_POST["method"];
$value = $_POST["value"];
$target =$_POST["target"];

?>
<response>
  <command method="setcontent">
    <target>rsp_email</target>
    <content>sorry dit emailadres is niet correct</content>
  </command>
  <command method="setstyle">
    <target>rsp_email</target>
    <property>color</property>
    <value>red</value>
  </command>
  <command method="setproperty">
    <target>valid_email</target>
    <property>checked</property>
    <value>false</value>
  </command>
  <command method="focus">
    <target>emailadresouders</target>
  </command>
</response>