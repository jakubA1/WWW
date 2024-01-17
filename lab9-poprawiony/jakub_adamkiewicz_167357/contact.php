<?php

function PokazKontakt()
{
    $wynik = '
    <div class="kontakt">
        <h1 class="heading">Kontakt:</h1>
            <div class="kontakt">
            <form method="post" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                <table class="kontakt">
                    <tr><td class="log4_t">[temat]</td><td>'.$temat='<input type="text" name="temat" class="kontakt" /></td></tr>
                    <tr><td class="log4_t">[email]</td><td>'.$email='<input type="text" name="email" class="kontakt" /></td></tr>
                    <tr><td class="log4_t">[tresc]</td><td>'.$tresc='<textarea id="content" name="tresc" class="kontakt" /></textarea></td></tr>
                    <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="kontakt" value="Wyslij" /></td></tr>
                </table>
            </form>
        </div>
    </div>
    ';
    return $wynik;
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

if (isset($_GET['action']) && $_GET['action'] == 'wyslij_mail') {
    $odbiorca = '167357@student.uwm.edu.pl';
    WyslijMailKontakt($odbiorca);
} else {
    echo PokazKontakt();
	echo '<a href="index.php"><button type="button">Strona Glówna</button></a>';
}

?>