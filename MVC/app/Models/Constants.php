<?php
/**
 * Created by PhpStorm.
 * User: David Peric
 * Date: 28.02.2019
 * Time: 11:58
 */

class Constants
{
    // Email
    public static $invalidEmail = "Die Email, die du eingegeben hast ist invalid";
    public static $emailTooLong = "Die Email darf maximal 100 Zeichen lang sein";
    public static $emailTaken = "Diese Email ist bereits registriert";
    // Username
    public static $usernameTooLong = "Der Username darf maximal 30 Zeichen lang sein";
    public static $usernameTaken = "Dieser Username ist bereits registriert";
    // Password
    public static $passwordTooLong = "Das Passwort darf maximal 30 Zeichen lang sein und muss mindenstens 5 Zeichen lang sein";
    public static $passwordIncorrect = "Das eingegebene Passwort war falsch";
    // Other
    public static $fileNameTooLong = "Der Dateiname darf maximal 50 Zeichen lang sein";
    public static $loginFailed = "Login fehlgeschlagen: Email oder Passwort falsch";
    public static $emailDoesNotExist = "Die eingegebene Email existiert nicht";
    public static $accountClosed = "Dieser Account ist geschlossen.";
    public static $noAnswers = "Diese Frage hat noch keine Antworten";
    // public static $alreadyMarked = "Du hast diese Antwort schon markiert";
    public static $aboutAlreadyMade = "Du hast schon über dich geschrieben";
    public static $userNoQuestions = "Dieser User hat noch keine Fragen gestellt";
    public static $userNoAnswers = "Dieser User hat noch keine Antworten";
    public static $categoryExists = "Diese Kategorie existiert bereits";
    public static $accountInDanger = "Ihr Account ist in Gefahr auf Grund von mehreren unbekannten Loginversuchen";
}