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
    echo 
		'<form method="post">
		<table>
		<tr>
		<th>Id</th>
		<th>Tytuł</th>
		<th>Status</th>
		</tr>';
		while ($row = mysqli_fetch_array($result)) {
			echo 
				'<tr>
				<td>' . $row['id'] . '</td>
				<td>' . $row['page_title'] . '</td>
				<td>' . $row['status'] . '</td>
				<td>
				<button type="submit" name="edytuj" value="' . $row['id'] . '">Edytuj</button>
				<button type="submit" name="usun" value="' . $row['id'] . '">Usuń</button>
				</td>
				</tr>';
		}
		echo '</table>
			<button type="submit" name="dodaj">Dodaj Nową Podstronę</button>
			</form>';
	}

function DodajNowaPodstrone() {
    global $link;

    if (isset($_POST['tytul']) && isset($_POST['tresc'])) {
        $tytul = mysqli_real_escape_string($link, $_POST['tytul']);
        $tresc = mysqli_real_escape_string($link, $_POST['tresc']);
        $aktywna = isset($_POST['aktywna']) ? 1 : 0;

        $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$tytul', '$tresc', $aktywna)";
        if (mysqli_query($link, $query)) {
            echo "Nowa podstrona została dodana pomyślnie.";
        } else {
            echo "Błąd podczas dodawania podstrony: " . mysqli_error($link);
        }
    }
	echo '<a href="admin.php"><button type="button">Wróć</button></a>';

    echo '<form method="post">
		Tytuł: <input type="text" name="tytul" value="Tytuł Nowej Podstrony"><br>
		Treść: <textarea name="tresc">Treść Nowej Podstrony</textarea><br>
		<label>Aktywna: <input type="checkbox" name="aktywna" checked></label><br>
		<input type="submit" name="dodaj" value="Dodaj">
		</form>';
}

function UsunPodstrone($id) {
    global $link;

        $query = "DELETE FROM page_list WHERE id = $id";
        if (mysqli_query($link, $query)) {
            echo "Podstrona została usunięta pomyślnie.";
        } else {
            echo "Błąd podczas usuwania podstrony: " . mysqli_error($link);
        }
		
	echo '<a href="admin.php"><button type="button">Wróć</button></a>';
}

function EdytujPodstrone($id){
    global $link;

    if (isset($_POST['id'], $_POST['title'], $_POST['content'])) {
        $id = mysqli_real_escape_string($link, $_POST['id']);
        $title = mysqli_real_escape_string($link, $_POST['title']);
        $content = mysqli_real_escape_string($link, $_POST['content']);
        $active = isset($_POST['active']) ? 1 : 0;

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
	
	echo '<a href="admin.php"><button type="button">Wróć</button></a>';

    echo '<form method="post" action="admin.php">
		<input type="hidden" name="id" value="' . $row['id'] . '">
		Tytuł: <input type="text" name="title" value="' . $row['page_title'] . '"><br>
		Treść: <textarea name="content">' . $row['page_content'] . '</textarea><br>
		<label>Aktywna: <input type="checkbox" name="active" ' . ($row['status'] ? 'checked' : '') . '></label><br>
		<input type="submit" name="edytuj" value="Zapisz">
		</form>';
}

$status = 0;

session_start();

if (isset($_POST['x1_submit'])) {
    if ($_POST['login_email'] == $login && $_POST['login_pass'] == $pass) {
        $_SESSION['status'] = 1; // Ustawienie statusu w sesji
    } else {
        echo FormularzLogowania();
    }
}

if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
        if (isset($_POST["dodaj"])) {
        DodajNowaPodstrone();
    } elseif (isset($_POST["edytuj"])) {
        $id = $_POST["edytuj"];
        EdytujPodstrone($id);
    } elseif (isset($_POST["usun"])) {
        $id = $_POST["usun"];
        UsunPodstrone($id);
    } else {
        ListaPodstron();		
    }
	echo '<a href="' . $_SERVER['REQUEST_URI'] . '?action=logout">Wyloguj</br></a>';
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];
        header("Location: $path");
        exit();
    }
    exit;
} else {
    echo FormularzLogowania();
	echo '<a href="../index.php"><button type="button">Strona Glówna</button></a>';
}
?>
