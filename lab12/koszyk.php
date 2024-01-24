<?php
session_start();

include('cfg.php');

$conn = new mysqli('localhost', 'root', '', 'moja_strona');

class SklepInternetowy {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        if (!isset($_SESSION['koszykJA'])) {
            $_SESSION['koszykJA'] = array();
        }
    }

    private function PokazProdukt($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produkt WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    private function AktualizujIloscProduktu($id, $zmianaIlosci) {
        $stmt = $this->conn->prepare("UPDATE produkt SET ilosc_dostepnych_sztuk = ilosc_dostepnych_sztuk + ? WHERE id = ?");
        $stmt->bind_param("ii", $zmianaIlosci, $id);
        $stmt->execute();
    }
    
    public function DodajDoKoszyka($id, $ilosc) {
        $produkt = $this->PokazProdukt($id);
        $produktID = "produkt_" . $id;
        if (array_key_exists($produktID, $_SESSION['koszykJA'])) {
            if ($produkt['ilosc_dostepnych_sztuk'] >= $ilosc) {
                $_SESSION['koszykJA'][$produktID]['ilosc_dostepnych_sztuk'] += $ilosc;
                $this->AktualizujIloscProduktu($id, -$ilosc);
            } else {
                echo "Brak produktu w magazynie.";
            }
        } else {
            if ($produkt['ilosc_dostepnych_sztuk'] >= $ilosc) {
                $_SESSION['koszykJA'][$produktID] = array(
                    'id' => $id,
                    'tytul' => $produkt['tytul'],
                    'ilosc_dostepnych_sztuk' => $ilosc,
                    'cena_brutto' => number_format($produkt['cena_netto'] * (1 + ($produkt['podatek_vat'] / 100)), 2, '.', ''),
                    'zdjecie' => $produkt['zdjecie'],
                );
                $this->AktualizujIloscProduktu($id, -$ilosc);
            } else {
                echo "Brak produktu w magazynie.";
            }
        }
    }

    public function UsunZKoszyka($id, $ilosc) {
        $produktID = "produkt_" . $id;
        if (array_key_exists($produktID, $_SESSION['koszykJA'])) {
            $_SESSION['koszykJA'][$produktID]['ilosc_dostepnych_sztuk'] -= $ilosc;
            if ($_SESSION['koszykJA'][$produktID]['ilosc_dostepnych_sztuk'] <= 0) {
                unset($_SESSION['koszykJA'][$produktID]);
            }
            $this->AktualizujIloscProduktu($id, $ilosc);
        }
    }

    public function ZliczWartoscKoszyka() {
        $wartosc = 0;
        foreach ($_SESSION['koszykJA'] as $produkt) {
            $wartosc += $produkt['cena_brutto'] * $produkt['ilosc_dostepnych_sztuk'];
        }
        return number_format($wartosc, 2, '.', '');
    }

    public function PokazKoszyk() {
        if (!empty($_SESSION['koszykJA'])) {
            foreach ($_SESSION['koszykJA'] as $produktID => $produkt) {
                echo "<p>{$produkt['tytul']} (Ilość: {$produkt['ilosc_dostepnych_sztuk']}, Cena: {$produkt['cena_brutto']} PLN)</p>";
            }
            echo "<p>Łączna wartość: " . $this->ZliczWartoscKoszyka() . " PLN</p>";
        } else {
            echo "<p>Koszyk jest pusty.</p>";
        }
    }
}

$SklepInternetowy = new SklepInternetowy($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dodaj_do_koszyka'])) {
        $id = $_POST['produkt_id'];
        $ilosc = $_POST['ilosc'];
        $SklepInternetowy->DodajDoKoszyka($id, $ilosc);
    } elseif (isset($_POST['usun_z_koszyka'])) {
        $id = $_POST['produkt_id'];
        $ilosc = $_POST['ilosc'];
        $SklepInternetowy->UsunZKoszyka($id, $ilosc);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sklep internetowy</title>
</head>
<body>
<a href="index.php"><button type="button">Strona Główna</button></a>
<h2>Lista Produktów</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Zdjęcie</th>
        <th>Nazwa</th>
        <th>Cena Netto</th>
        <th>Cena Brutto</th>
        <th>Ilość</th>
        <th>Akcja</th>
    </tr>
    <?php
    $query_produkty = "SELECT * FROM produkt WHERE status = 1";
    $result_produkty = mysqli_query($conn, $query_produkty);
    if (mysqli_num_rows($result_produkty) > 0) {
        while ($produkt = mysqli_fetch_assoc($result_produkty)) {
            $cenaBruttoFormatted = number_format($produkt['cena_netto'] * (1 + ($produkt['podatek_vat'] / 100)), 2, '.', '');
            echo "<tr>
				<td><img src='{$produkt['zdjecie']}' alt='{$produkt['tytul']}' style='max-width: 100px; max-height: 100px;'></td>
				<td>{$produkt['tytul']}</td>
				<td>{$produkt['cena_netto']} PLN</td>
				<td>{$cenaBruttoFormatted} PLN</td>
				<td>{$produkt['ilosc_dostepnych_sztuk']}</td>
				<td><form method='post'><input type='hidden' name='produkt_id' value='{$produkt['id']}'>
				<input type='number' name='ilosc' value='1' min='1' max='{$produkt['ilosc_dostepnych_sztuk']}'>
				<input type='submit' name='dodaj_do_koszyka' value='Dodaj do koszyka'></form></td>
				</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Brak produktów do wyświetlenia</td></tr>";
    }
    ?>
</table>

<h2>Koszyk</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Zdjęcie</th>
        <th>Nazwa</th>
        <th>Ilość</th>
        <th>Cena</th>
        <th>Akcja</th>
    </tr>
    <?php
    if (isset($_SESSION['koszykJA']) && !empty($_SESSION['koszykJA'])) {
        foreach ($_SESSION['koszykJA'] as $produktID => $produkt) {
            echo "<tr>
				<td><img src='{$produkt['zdjecie']}' alt='{$produkt['tytul']}' style='max-width: 100px; max-height: 100px;'></td>
				<td>{$produkt['tytul']}</td>
				<td>{$produkt['ilosc_dostepnych_sztuk']}</td>
				<td>" . number_format($produkt['cena_brutto'], 2, '.', '') . " PLN</td>
				<td><form method='post'><input type='hidden' name='produkt_id' value='{$produkt['id']}'>
				<input type='number' name='ilosc' value='{$produkt['ilosc_dostepnych_sztuk']}' min='1' max='{$produkt['ilosc_dostepnych_sztuk']}'>
				<input type='submit' name='usun_z_koszyka' value='Usuń z koszyka'></form></td>
				</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Koszyk jest pusty</td></tr>";
    }
    ?>
</table>

<p><strong>Łączna wartość koszyka:</strong> <?php echo $SklepInternetowy->ZliczWartoscKoszyka(); ?> PLN</p>

</body>
</html>
