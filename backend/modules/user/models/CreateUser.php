<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class CreateUser extends User {

    public $verifyPassword;
//    public $verifyCode;

    public function rules() {
        $rules = array(
            array('username, password, tel', 'required'),
            array('username', 'length', 'max' => 20, 'min' => 3, 'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
            array('password', 'length', 'max' => 128, 'min' => 4, 'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
            array('email', 'email'),
            array('tel', 'unique', 'message' => UserModule::t("This user's tel already exists.")),
            array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
            array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
            //array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => UserModule::t("Incorrect symbols (A-z0-9).")),
            array('tel', 'match', 'pattern' => '/^((\+86)|(86))?(1(3|8))\d{9}$/u', 'message' => UserModule::t("Incorrect symbols (d{11}).")),
        );
        return $rules;
    }

}