<?php
session_start();

require('../cfg.php');

$conn = new mysqli('localhost', 'root', '', 'moja_strona');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login = 'admin';
$pass = 'admin';

class Admin {
	private $conn;
    private $pass;
	
	public function __construct($conn)
    {
		$this->conn = $conn;
	}

	public function FormularzLogowania() {	
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
	
	public function ListaPodstron() {
		$query = "SELECT * FROM page_list ORDER BY id ASC LIMIT 100";
		$result = mysqli_query($this->conn, $query);
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

	public function DodajNowaPodstrone() {
		if (isset($_POST['tytul']) && isset($_POST['tresc'])) {
			$tytul = mysqli_real_escape_string($this->conn, $_POST['tytul']);
			$tresc = mysqli_real_escape_string($this->conn, $_POST['tresc']);
			$aktywna = isset($_POST['aktywna']) ? 1 : 0;

			$query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$tytul', '$tresc', $aktywna)";
			if (mysqli_query($this->conn, $query)) {
				echo "Nowa podstrona została dodana pomyślnie.";
			} else {
				echo "Błąd podczas dodawania podstrony.";
			}
		}

		echo '<form method="post">
			Tytuł: <input type="text" name="tytul" value="Tytuł Nowej Podstrony"><br>
			Treść: <textarea name="tresc">Treść Nowej Podstrony</textarea><br>
			<label>Aktywna: <input type="checkbox" name="aktywna" checked></label><br>
			<input type="submit" name="dodaj" value="Dodaj">
			</form>';
		
		echo '<a href="admin.php"><button type="button">Wróć</button></a><br>';
	}

	public function UsunPodstrone($id) {
			$query = "DELETE FROM page_list WHERE id = $id";
			if (mysqli_query($this->conn, $query)) {
				echo "Podstrona została usunięta pomyślnie.";
			} else {
				echo "Błąd podczas usuwania podstrony.";
			}
			
		echo '<br><a href="admin.php"><button type="button">Wróć</button></a><br>';
	}

	public function EdytujPodstrone($id){
		if (isset($_POST['id'], $_POST['title'], $_POST['content'])) {
			$id = mysqli_real_escape_string($this->conn, $_POST['id']);
			$title = mysqli_real_escape_string($this->conn, $_POST['title']);
			$content = mysqli_real_escape_string($this->conn, $_POST['content']);
			$active = isset($_POST['active']) ? 1 : 0;

			$query = "UPDATE page_list SET page_title='$title', page_content='$content', status=$active WHERE id=$id";
			if (mysqli_query($this->conn, $query)) {
				echo "Podstrona została zaktualizowana pomyślnie.";
			} else {
				echo "Błąd podczas aktualizacji podstrony.";
			}
		}

		$id = mysqli_real_escape_string($this->conn, $id);
		$query = "SELECT * FROM page_list WHERE id=$id";
		$result = mysqli_query($this->conn, $query);
		$row = mysqli_fetch_assoc($result);

		echo '<form method="post" action="admin.php">
			<input type="hidden" name="id" value="' . $row['id'] . '">
			Tytuł: <input type="text" name="title" value="' . $row['page_title'] . '"><br>
			Treść: <textarea name="content">' . $row['page_content'] . '</textarea><br>
			<label>Aktywna: <input type="checkbox" name="active" ' . ($row['status'] ? 'checked' : '') . '></label><br>
			<input type="submit" name="edytuj" value="Zapisz">
			</form>';
			
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
	}
	
	public function WyslijMailKontakt($odbiorca) {
        if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
            echo '[nie wypełniłeś pola]';
            echo $this->PokazKontakt();
        } else {
            $mail['subject'] = $_POST['temat'];
            $mail['body'] = $_POST['tresc'];
            $mail['sender'] = $_POST['email'];
            $mail['recipient'] = $odbiorca;
            $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
            $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding:";
            $header .= "X-Sender: <" . $mail['sender'] . "\n";
            $header .= "X-Mailer: PRapWWW mail 1.2\n";
            $header .= "X-Priority: 3\n";
            $header .= "Return-Path: <" . $mail['sender'] . ">\n";

            mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

            echo '[wiadomość wysłana]';
        }
    }
	
	public function PokazKontakt() {
        $wynik = '
        <h2>Formularz Kontaktowy</h2>
        <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <label for="temat">Temat:</label>
            <input type="text" name="temat"><br>
            <label for="tresc">Treść:</label>
            <textarea name="tresc"></textarea><br>
            <label for="email">Email:</label>
            <input type="email" name="email"><br>
            <input type="submit" name="wyslij_mail_kontakt" value="Wyślij">
        </form>';

        return $wynik;
    }
	
    public function PrzypomnijHaslo() {
        if (isset($_POST['przypomnij_haslo'])) {
            if (empty($_POST['email']) || empty($_POST['email']))  {
                echo '[nie wypełniłeś pola]';
                echo $this->PokazPrzypomnienieHasla();
            } else {
                $mail['subject'] = 'Przypomnienie hasła';
                $mail['body'] = 'Twoje hasło: ' . $this->pass;
                $mail['sender'] = '167357@student.uwm.edu.pl';
                $mail['recipient'] = $_POST['email'];
                $header = "From: Przypomnienie hasła <" . $mail['sender'] . ">\n";
                $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding:";
                $header .= "X-Sender: <" . $mail['sender'] . "\n";
                $header .= "X-Mailer: PRapWWW mail 1.2\n";
                $header .= "X-Priority: 3\n";
                $header .= "Return-Path: <" . $mail['sender'] . ">\n";

                mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

                echo '[przypomnienie_wysłane]  ';
                echo $this->pass;
			}
		}
	}
	
	public function PokazPrzypomnienieHasla() {
        $wynik = '
        <h2>Przypomnij Hasło</h2>
        <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <label for="email">Email:</label>
            <input type="email" name="email"><br>
            <input type="submit" name="przypomnij_haslo" value="Przypomnij hasło">
        </form>';

        return $wynik;
    }
	
}

class ZarzadzajKategoriami {
	
	private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function DodajKategorie($matka, $nazwa) {
        if($matka == null)
        {$matka=0;}
        $query = "INSERT INTO kategoria (matka, nazwa) VALUES ($matka, '$nazwa')";
        if (mysqli_query($this->conn, $query)) {
			echo "Kategoria została dodana pomyślnie.";
        } else {
            echo "Błąd podczas dodawania kategorii.";
        }
    }

    public function UsunKategorie($kategoria_id) {
        $query = "DELETE FROM kategoria WHERE id = $kategoria_id";
        if (mysqli_query($this->conn, $query)) {
			echo "Kategoria została usunięta pomyślnie.";
        } else {
            echo "Błąd podczas usuwania kategorii.";
        }
    }

    public function EdytujKategorie($kategoria_id, $nowa_nazwa) {
        $query = "UPDATE kategoria SET nazwa = '$nowa_nazwa' WHERE id = $kategoria_id";
        if (mysqli_query($this->conn, $query)) {
			echo "Kategoria została zaktualizowana pomyślnie.";
        } else {
            echo "Błąd podczas aktualizacji kategorii.";
        }
    }

    public function PokazKategorie() {
        $query = "SELECT * FROM kategoria";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "ID: {$row['id']}, Matka: {$row['matka']}, Nazwa: {$row['nazwa']}<br>";
        }
    }
	
	public function GenerujDrzewoKategorii($matka = 0, $indent = 0)
    {
        $query = "SELECT * FROM kategoria WHERE matka = $matka";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo str_repeat("&nbsp;&nbsp;", $indent);
            echo "   id:{$row['id']}, nazwa:{$row['nazwa']}<br>";

            $this->GenerujDrzewoKategorii($row['id'], $indent + 1);
        }
    }

    public function ForumlarzeKategorii($type) {
        $forms = [
            'dodajK' => '<h2>Dodaj kategorie</h2>
                      <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                          <label for="matka">Matka:</label>
                          <input type="text" name="matka"><br>
                          <label for="nazwa">Nazwa:</label>
                          <input type="text" name="nazwa"><br>
                          <input type="submit" name="dodajK" value="Dodaj">
                      </form>',

            'usunK' => '<h2>Usuń kategorie</h2>
                         <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                             <label for="kategoria_id">Id kategorii:</label>
                             <input type="text" name="kategoria_id"><br>
                             <input type="submit" name="usunK" value="Usuń">
                         </form>',

            'edytujK' => '<h2>Edytuj kategorie</h2>
                       <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                           <label for="kategoria_id">Id kategorii:</label>
                           <input type="text" name="kategoria_id"><br>
                           <label for="newName">Nowa nazwa:</label>
                           <input type="text" name="nowa_nazwa"><br>
                           <input type="submit" name="edytujK" value="Edytuj">
                       </form>',

            'pokazK' => '<h2>Lista kategori</h2>
                       <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                           <input type="submit" name="pokazK" value="Pokaż liste kategorii">
                       </form>',
					   
			'generujDK' => '<h2>Generuj drzewo kategorii</h2>
                       <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                           <input type="submit" name="generujDK" value="Generuj">
                       </form>'
        ];

        return $forms[$type];
    }
}

class ZarzadzajProduktami {
    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function DodajProdukt($tytul, $opis, $cena_netto, $vat, $ilosc, $status, $kategoria, $gabaryt, $zdjecie) {
        $data_utworzenia = date('Y-m-d H:i:s');
		$dataWygasniecia = date('Y-m-d H:i:s', strtotime('+90 days'));
        $query = "INSERT INTO produkt (tytul, opis, data_utworzenia, cena_netto, podatek_vat, ilosc_dostepnych_sztuk, status, kategoria, gabaryt, zdjecie) VALUES ('$tytul', '$opis', '$data_utworzenia', $cena_netto, $vat, $ilosc, $status, '$kategoria', '$gabaryt', '$zdjecie')";
        if (mysqli_query($this->conn, $query)) {
			echo "Produkt został dodany pomyślnie.";
        } else {
            echo "Błąd podczas dodawania produktu.";
        }
    }

    public function UsunProdukt($produkt_id) {
        $query = "DELETE FROM produkt WHERE id = $produkt_id";
        if (mysqli_query($this->conn, $query)) {
			echo "Produkt został usunięty pomyślnie.";
        } else {
            echo "Błąd podczas usuwania produktu.";
        }
		
    }

    public function EdytujProdukt($produkt_id, $tytul, $opis, $cena_netto, $vat, $ilosc, $status, $kategoria, $gabaryt, $zdjecie) {
        $data_modyfikacji = date('Y-m-d H:i:s');
		$dataWygasniecia = date('Y-m-d H:i:s', strtotime('+90 days'));
        $query = "UPDATE produkt SET tytul = '$tytul', opis = '$opis', data_modyfikacji = '$data_modyfikacji', cena_netto = $cena_netto, podatek_vat = $vat, ilosc_dostepnych_sztuk = $ilosc, status = $status, kategoria = '$kategoria', gabaryt = '$gabaryt', zdjecie = '$zdjecie' WHERE id = $produkt_id";
        if (mysqli_query($this->conn, $query)) {
			echo "Produkt został zaktualizowany pomyślnie.";
        } else {
            echo "Błąd podczas aktualizacji produktu.";
        }
    }

    public function PokazProdukty() {
        $query = "SELECT * FROM produkt";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "ID: {$row['id']}, Tytuł: {$row['tytul']}, Opis: {$row['opis']}, Data utworzenia: {$row['data_utworzenia']}, Cena netto: {$row['cena_netto']}, VAT: {$row['podatek_vat']}, Ilość: {$row['ilosc_dostepnych_sztuk']}, Status: {$row['status']}, Kategoria: {$row['kategoria']}, Gabaryt: {$row['gabaryt']}, Zdjęcie: {$row['zdjecie']}<br>";
        }
    }
	
	public function FormularzeProduktow($type) {
        $forms = [
            'dodajP' => '<h2>Dodaj produkt</h2>
                         <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                             <label for="tytul">Tytuł:</label>
                             <input type="text" name="tytul"><br>
                             <label for="opis">Opis:</label>
                             <textarea name="opis"></textarea><br>
                             <label for="cena_netto">Cena netto:</label>
                             <input type="text" name="cena_netto"><br>
                             <label for="vat">VAT:</label>
                             <input type="text" name="vat"><br>
                             <label for="ilosc">Ilość:</label>
                             <input type="number" name="ilosc"><br>
                             <label for="status">Status:</label>
                             <input type="text" name="status"><br>
                             <label for="kategoria">Kategoria:</label>
                             <input type="text" name="kategoria"><br>
                             <label for="gabaryt">Gabaryt:</label>
                             <input type="text" name="gabaryt"><br>
                             <label for="zdjecie">Zdjęcie (URL):</label>
                             <input type="text" name="zdjecie"><br>
                             <input type="submit" name="dodajP" value="Dodaj">
                         </form>',

            'usunP' => '<h2>Usuń produkt</h2>
                         <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                             <label for="produkt_id">ID produktu:</label>
                             <input type="text" name="produkt_id"><br>
                             <input type="submit" name="usunP" value="Usuń">
                         </form>',

            'edytujP' => '<h2>Edytuj produkt</h2>
                          <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                              <label for="produkt_id">ID produktu:</label>
                              <input type="text" name="produkt_id"><br>
                              <label for="tytul">Nowy tytuł:</label>
                              <input type="text" name="tytul"><br>
                              <label for="opis">Nowy opis:</label>
                              <textarea name="opis"></textarea><br>
                              <label for="cena_netto">Nowa cena netto:</label>
                              <input type="text" name="cena_netto"><br>
                              <label for="vat">Nowy VAT:</label>
                              <input type="text" name="vat"><br>
                              <label for="ilosc">Nowa ilość:</label>
                              <input type="number" name="ilosc"><br>
                              <label for="status">Nowy status:</label>
                              <input type="text" name="status"><br>
                              <label for="kategoria">Nowa kategoria:</label>
                              <input type="text" name="kategoria"><br>
                              <label for="gabaryt">Nowy gabaryt:</label>
                              <input type="text" name="gabaryt"><br>
                              <label for="zdjecie">Nowe zdjęcie (URL):</label>
                              <input type="text" name="zdjecie"><br>
                              <input type="submit" name="edytujP" value="Edytuj">
                          </form>',

            'pokazP' => '<h2>Lista produktów</h2>
                         <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
                             <input type="submit" name="pokazP" value="Pokaż listę produktów">
                         </form>'
        ];

        return $forms[$type];
	}
}

$Admin = new Admin($conn);
$ZarzadzajKategoriami = new ZarzadzajKategoriami($conn);
$ZarzadzajProduktami = new ZarzadzajProduktami($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['wyslij_mail_kontakt'])) {
        $Admin->WyslijMailKontakt('qw@gmail.com');
    }
    $Admin->PrzypomnijHaslo();
}

if (isset($_POST['x1_submit'])) {
    if ($_POST['login_email'] == $login && $_POST['login_pass'] == $pass) {
        $_SESSION['status'] = 1;
    } else {
        echo "Nieprawidłowe dane logowania";
    }
}

if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];
        header("Location: $path");
        exit();
	
	} elseif (isset($_POST['przypomnij_haslo']) && !empty($_POST['email'])) {
		$Admin->PrzypomnijHaslo();
	
    } elseif (isset($_POST["dodaj"])) {
        $Admin->DodajNowaPodstrone();
		
    } elseif (isset($_POST["edytuj"])) {
        $id = $_POST["edytuj"];
        $Admin->EdytujPodstrone($id);
		
    } elseif (isset($_POST["usun"])) {
        $id = $_POST["usun"];
        $Admin->UsunPodstrone($id);
		
    } elseif (isset($_POST['dodajK'])) {
        $matka = $_POST['matka'];
        $nazwa = $_POST['nazwa'];
        $ZarzadzajKategoriami->DodajKategorie($matka, $nazwa);
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
		
	} elseif (isset($_POST['usunK'])) {
        $kategoria_id = $_POST['kategoria_id'];
        $ZarzadzajKategoriami->UsunKategorie($kategoria_id);
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
		
    } elseif (isset($_POST['edytujK'])) {
        $kategoria_id = $_POST['kategoria_id'];
        $nowa_nazwa = $_POST['nowa_nazwa'];
        $ZarzadzajKategoriami->EdytujKategorie($kategoria_id, $nowa_nazwa);	
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
		
	} elseif (isset($_POST['pokazK'])) {
        $ZarzadzajKategoriami->PokazKategorie();
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
	
	} elseif (isset($_POST['generujDK'])) {
        $ZarzadzajKategoriami->GenerujDrzewoKategorii();
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
	
	} elseif (isset($_POST['dodajP'])) {
		$tytul = $_POST['tytul'];
		$opis = $_POST['opis'];
		$cena_netto = $_POST['cena_netto'];
		$vat = $_POST['vat'];
		$ilosc = $_POST['ilosc'];
		$status = $_POST['status'];
		$kategoria = $_POST['kategoria'];
		$gabaryt = $_POST['gabaryt'];
		$zdjecie = $_POST['zdjecie'];
        $ZarzadzajProduktami->DodajProdukt($tytul, $opis, $cena_netto, $vat, $ilosc, $status, $kategoria, $gabaryt, $zdjecie);
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
	
	} elseif (isset($_POST['usunP'])) {
		$produkt_id = $_POST['produkt_id'];
        $ZarzadzajProduktami->UsunProdukt($produkt_id);
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
		
	} elseif (isset($_POST['edytujP'])) {
		$produkt_id = $_POST['produkt_id'];
		$tytul = $_POST['tytul'];
		$opis = $_POST['opis'];
		$cena_netto = $_POST['cena_netto'];
		$vat = $_POST['vat'];
		$ilosc = $_POST['ilosc'];
		$status = $_POST['status'];
		$kategoria = $_POST['kategoria'];
		$gabaryt = $_POST['gabaryt'];
		$zdjecie = $_POST['zdjecie'];
        $ZarzadzajProduktami->EdytujProdukt($produkt_id, $tytul, $opis, $cena_netto, $vat, $ilosc, $status, $kategoria, $gabaryt, $zdjecie);
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
		
	} elseif (isset($_POST['pokazP'])) {
        $ZarzadzajProduktami->PokazProdukty();
		echo '<br><a href="admin.php"><button type="button">Wróć</button></br></a>';
		
    } 
	  else
	{
        echo $Admin->ListaPodstron();
        echo $ZarzadzajKategoriami->ForumlarzeKategorii('dodajK');
		echo $ZarzadzajKategoriami->ForumlarzeKategorii('usunK');
		echo $ZarzadzajKategoriami->ForumlarzeKategorii('edytujK');
		echo $ZarzadzajKategoriami->ForumlarzeKategorii('pokazK');
		echo $ZarzadzajKategoriami->ForumlarzeKategorii('generujDK');
		echo $ZarzadzajProduktami->FormularzeProduktow('dodajP');
		echo $ZarzadzajProduktami->FormularzeProduktow('usunP');
		echo $ZarzadzajProduktami->FormularzeProduktow('edytujP');
		echo $ZarzadzajProduktami->FormularzeProduktow('pokazP');
    }
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '?action=logout">Wyloguj</br></a>';

} else {
    echo $Admin->FormularzLogowania();
	echo $Admin->PokazKontakt();
	echo $Admin->PokazPrzypomnienieHasla();
    echo '<a href="../index.php"><button type="button">Strona Główna</button></a>';
}

?>
