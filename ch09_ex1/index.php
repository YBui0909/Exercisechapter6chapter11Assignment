<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        $name = trim($name);
        $email = trim($email);
        $phone = trim($phone);

        if (empty($name)) {
            $message = 'You must enter a name';
            break;
        }

        $name = ucwords($name);

        $i = strrpos($name, ' ');

        if ($i !== false) {
            $first_name = substr($name, $i + 1);
        }

        if (empty($email)) {
            $message = 'You must enter an address email';
            break;
        } elseif (strpos($email, '@') === false) {
            $message = 'The email address must contain an @ sign.';
            break;
        } elseif (strpos($email, '.')===false) {
            $message = 'The email address must contain a dot charactor.';
            break;
        }

        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace(' ', '', $phone);

        if (strlen($phone) < 7) {
            $message = 'The phone number must contain at least seven digits.';
            break;
        }

        if (strlen($phone) == 7) {
            $part1 = substr($phone, 0, 3);
            $part2 = substr($phone, 3);
            $phone = $part1 . '-' . $part2;
        } else {
            $part1 = substr($phone, 0, 3);
            $part2 = substr($phone, 3, 3);
            $part3 = substr($phone, 6);
            $phone = $part1 . '-' . $part2 . '-' . $part3;
        }

        $message =
            "Hello $first_name,\n\n" .
            "Thank you for entering this data:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n";
        break;
}
include 'string_tester.php';
