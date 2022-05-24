<?php
    function sendgridMail($sendTo, $subject, $content) {

        try {
            $curl = curl_init();

            $subject = str_replace("\n", "", $subject);

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

    function registerMail($sendTo, $name) {
        $subject = "Et donem la benvinguda a Plugandwork! 🤠";
        $content = '<div><h2 style=\"text-align: justify;\"><strong>'.$name.', et donem la benvinguda a Plugandwork!</strong></h2><p style=\"text-align: justify;\">T\'enviem aquest correu per donar-te la benvinguda a plugandwork.cat. Ara ja pots demanar discs personalitzats a trav&eacute;s de la nostra web.</p><p style=\"text-align: justify;\">&nbsp;</p><p style=\"text-align: center;\"><iframe class=\"giphy-embed\" src=\"https://giphy.com/embed/XD9o33QG9BoMis7iM4\" width=\"480\" height=\"270\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p><p>&nbsp;</p><hr /><p><strong>❗ AV&Iacute;S ❗</strong></p><p>Aquest missatge forma part del projecte de final de grau (<a href=\"https://plugandwork.cat\">plugandwork.cat</a>). No oferim un servei real. No enviem missatges publicitaris, es probable que no rebis correus d\'aquest tipus mai m&eacute;s.</p></div>';
        echo $content;
        sendgridMail($sendTo, $subject, $content);
    }
?>