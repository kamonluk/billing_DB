<?php

require_once 'DBConnection.php';

class ServiceAuthentication{

    public static function accountAuthenticationProvider($accNo)
	{
        return DBConnection::accountInformationProvider($accNo);
    }
    
}