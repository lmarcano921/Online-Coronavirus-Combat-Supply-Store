<?php

require_once 'GoogleAuthenticator.php';
include('C:\xampp\htdocs\templates\csc350project\db_connect.php');
session_start();

$ga = new GoogleAuthenticator();

$secret = $ga->createSecret();
$qr = $ga->getQRCodeGoogleUrl('OCCSS', $secret);


$_SESSION['secret'] = $secret;
$_SESSION['qr'] = $qr;

header('location: 2-factor-signup.php');
