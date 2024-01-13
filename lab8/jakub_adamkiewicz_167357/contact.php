<?php

function PokazKontakt()
    {
        echo '
            <h1>Kontakt</h1>
            <form action="contact.php?action=wyslij_mail" method="post">
				<p>Email:</p>
				<input type="email" name="email">
				<br></br>
                <p>Temat:</p>
                <input type="text" name="temat">
				<br></br>
                <p>Tresc:</p>
                <textarea name="tresc" rows="4" cols="25"></textarea>
				<br></br>
                <input type="submit" value="Wyślij">
            </form>';
    }


function WyslijMailaKontakt($odbiorca)
{
    if(empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email']))
    {
        echo '[nie_wypełniłeś_pola]';
        echo PokazKontakt();
    }
    else
    {
        $mail['subject']   = $_POST['temat'];
        $mail['body']      = $_POST['tresc'];
        $mail['sender']    = $_POST['email'];
        $mail['recipient'] = $odbiorca;

        $header  = "From: Formularz kontaktowy <".$mail['sender'].">\n";
        $header .= "MIME-Version: 1.0\nCorrect-Type: text/plain; charset=utf8\nContent-Transfer-Encoding: ";
        $header .= "X-Sender: <".$mail['sender']."\n";
        $header .= "X-Mailer: PRapWW mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <".$mail['sender'].">\n";

        mail($mail['recipient'],$mail['subject'],$mail['body'],$header);

        echo '[wiadomosc_wyslana]';
    }
}

?>