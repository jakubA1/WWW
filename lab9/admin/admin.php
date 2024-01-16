<?php

var_dump($_POST);
require('../cfg.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

function FormularzLogowania()
{	
    $wynik = '
        <div class="logowanie">
            <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="post" name="LoginForm" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
                    <table class="logowanie">
                        <tr><td class="logowanie"></td></tr>
                        <tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie" /></td></tr>
                        <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie" /></td></tr>
                        <tr><td>&nbsp; </td><td><input type="submit" name="x1_submit" class="logowanie" value="zaloguj" /></td></tr>
                    </table>
                </form>
            </div>
        </div>
    ';
    return $wynik;
}

function ListaPodstron() {
    global $link;

    $query = "SELECT * FROM page_list ORDER BY id ASC LIMIT 100";
    $result = mysqli_query($link, $query);
    echo '<form method="post">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Tytuł</th>';
	echo '<th>Status</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['page_title'] . '</td>';
		echo '<td>' . $row['status'] . '</td>';
        echo '<td>';
        echo '<button type="submit" name="edit" value="' . $row['id'] . '">Edytuj</button>';
        echo '<button type="submit" name="del" value="' . $row['id'] . '">Usuń</button>';
        echo '</td>';
        echo '</tr>';
    }	
    echo '</table>';
    echo '<button type="submit" name="add">Dodaj Nową Podstronę</button>';
    echo '</form>';
}

function DodajNowaPodstrone() {
    global $link;

    if (isset($_POST['tytul'], $_POST['tresc'], $_POST['aktywna'])) {
        $tytul = mysqli_real_escape_string($link, $_POST['tytul']);
        $tresc = mysqli_real_escape_string($link, $_POST['tresc']);
        $aktywna = ($_POST['aktywna'] == 'on') ? 1 : 0;

        $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$tytul', '$tresc', $aktywna)";
        if (mysqli_query($link, $query)) {
            echo "Nowa podstrona została dodana pomyślnie.";
        } else {
            echo "Błąd podczas dodawania podstrony: " . mysqli_error($link);
        }
    }

    echo '<form method="post">';
    echo 'Tytuł: <input type="text" name="tytul" value="Tytuł Nowej Podstrony"><br>';
    echo 'Treść: <textarea name="tresc">Treść Nowej Podstrony</textarea><br>';
    echo '<label>Aktywna: <input type="checkbox" name="aktywna" checked></label><br>';
    echo '<input type="submit" name="add" value="Dodaj">';
    echo '</form>';
}

function UsunPodstrone($id) {
    global $link;

        $query = "DELETE FROM page_list WHERE id = $id";
        if (mysqli_query($link, $query)) {
            echo "Podstrona została usunięta pomyślnie.";
        } else {
            echo "Błąd podczas usuwania podstrony: " . mysqli_error($link);
        }		
}

function EdytujPodstrone($id){
    global $link;

    if (isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['active'])) {
        $id = mysqli_real_escape_string($link, $_POST['id']);
        $title = mysqli_real_escape_string($link, $_POST['title']);
        $content = mysqli_real_escape_string($link, $_POST['content']);
        $active = ($_POST['active'] == 'on') ? 1 : 0;

        $query = "UPDATE page_list SET page_title='$title', page_content='$content', status=$active WHERE id=$id";
        if (mysqli_query($link, $query)) {
            echo "Podstrona została zaktualizowana pomyślnie.";
        } else {
            echo "Błąd podczas aktualizacji podstrony: " . mysqli_error($link);
        }
    }

    $id = mysqli_real_escape_string($link, $id);
    $query = "SELECT * FROM page_list WHERE id=$id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    echo '<form method="post">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo 'Tytuł: <input type="text" name="title" value="' . $row['page_title'] . '"><br>';
    echo 'Treść: <textarea name="content">' . $row['page_content'] . '</textarea><br>';
    echo '<label>Aktywna: <input type="checkbox" name="active" ' . ($row['status'] ? 'checked' : '') . '></label><br>';
    echo '<input type="submit" name="edit" value="Zapisz">';
    echo '</form>';
}

$status = 0;

session_start();

if (isset($_POST['x1_submit'])) {
    if ($_POST['login_email'] == $login && $_POST['login_pass'] == $pass) {
        $_SESSION['status'] = 1; // Ustawienie statusu w sesji
    } else {
        echo FormularzLogowania();
		echo '<a href="' . $_SERVER['REQUEST_URI'] . '?action=logout">Wyloguj</br></a>';
        // Dodaj obsługę wylogowania
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            // Zakończ sesję i przekieruj na stronę logowania
            session_destroy();
            $url = parse_url($_SERVER['REQUEST_URI']);
            $path = $url['path'];
            header("Location: $path");
            exit();
        }
        exit; // Wyjście, aby nie kontynuować dalej skryptu
    }
}

if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
        if (isset($_POST["add"])) {
        DodajNowaPodstrone();
    } elseif (isset($_POST["edit"])) {
        $id = $_POST["edit"];
        EdytujPodstrone($id);
    } elseif (isset($_POST["del"])) {
        $id = $_POST["del"];
        UsunPodstrone($id);
    } else {
        ListaPodstron();
    }
} else {
    echo FormularzLogowania();
}
?>
