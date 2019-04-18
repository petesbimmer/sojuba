<?php

    // Only process POST reqeusts.

	$service="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the form fields and remove whitespace.

        $date = trim($_POST["date"]);echo date( m/d/Y)

        $time = trim($_POST["time"]); echo time(h:i)

		$people_no = trim($_POST["people_no"]);

        $email_add = trim($_POST["email_add"]);

        $phone_no = trim($_POST["phone_no"]);



        // Check that data was sent to the mailer.

        if ( empty($date) OR empty($time) OR empty($people_no) OR empty($phone_no) OR !filter_var($email_add, FILTER_VALIDATE_EMAIL)) {

            // Set a 400 (bad request) response code and exit.

            http_response_code(400);

            echo "Oops! There was a problem with your submission. Please complete the form and try again.";

            exit;

        }



        // Set the recipient email address.

        // FIXME: Update this to your desired email address.

        $recipient = "$email_add";



        // Set the email subject.

        $subject = "Your Reservation Request at Sojuba";



        // Build the email content.

        $email_content = "Date: $date\n"; echo date( h:i a m/d/Y, strtotime($date));

		$email_content .= "Time: $time\n";

        $email_content .= "People Number: $people_no\n";

        $email_content .= "Email Address: $email_add\n";

        $email_content .= "Phone Number: $phone_no\n";



        // Build the email headers.

        $email_headers = "From Sojuba";



        // Send the email.

        if (mail($recipient, $subject, $email_content, $email_headers)) {

            // Set a 200 (okay) response code.
            http_response_code(200);

            echo "Your reservation at Sojuba on $date $time has been made.";

        } else {

            // Set a 500 (internal server error) response code.

            http_response_code(500);

            echo "Oops! Something went wrong and we couldn't process your reservation.";

        }



    } else {

        // Not a POST request, set a 403 (forbidden) response code.

        http_response_code(403);

        echo "There was a problem with your submission, please try again.";

    }



?>

