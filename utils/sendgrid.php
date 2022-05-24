<?php
    function sendgridMail($sendTo, $subject, $content) {

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sendgrid.com/v3/mail/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "personalizations": [
                    {
                        "to": [
                            {
                                "email": "'.$sendTo.'"
                            }
                        ]
                    }
                ],
                "from": {
                    "email": "no-reply@plugandwork.cat"
                },
                "subject": "'.$subject.'",
                "content": [
                    {
                        "type": "text/html",
                        "value": "'.$content.'"
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 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',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        } catch(Exception $e) {

        }
    }
?>