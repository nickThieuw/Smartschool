<?php

class databasetester{
public function databasetest(){
    try{
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
    } catch (databasefoutexception $dbf) {
        throw new databasefoutexception($dbf->getMessage() , $dbf->getCode());
    }
}
}
