<?php
require '../../../database/db.php';
require '../../../assets/fpdf181/fpdf.php';

$Lapor = "SELECT produk.nama_produk,pegawai.nama,produk_keluar.jumlah,date_format(produk_keluar.tanggal_keluar,'%d-%m-%Y') as tanggal from produk_keluar INNER JOIN produk ON produk.id_produk = produk_keluar.id_produk 
INNER JOIN pegawai ON pegawai.id_pegawai = produk_keluar.id_pegawai";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}

$Judul = 'Data Produk Keluar';
$tgl =   'Data tanggal: ' . date("d-m-Y");

$Header = array(
    array("label" => "Produk", "length" => 60, "align" => "L"),
    array("label" => "Nama Pegawai", "length" => 60, "align" => "L"),
    array("label" => "Jumlah", "length" => 20, "align" => "L"),
    array("label" => "Tanggal Keluar", "length" => 40, "align" => "L")
);

$pdf = new FPDF();
$pdf->AddPage('p', 'A4', 'C');
$pdf->SetFont('arial', 'B', '15');
$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
$pdf->SetFont('arial', 'i', '9');
$pdf->Cell(0, 10, $tgl, '0', 1, 'P');
$pdf->SetFont('arial', '', '12');
$pdf->SetFillColor(78, 115, 223);
$pdf->SetTextColor(255);
$pdf->setDrawColor(0, 0, 0);
foreach ($Header as $Kolom) {
    $pdf->Cell($Kolom['length'], 8, $Kolom['label'], 1, '0', $Kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFillColor(230, 234, 247);
$pdf->SettextColor(0);
$pdf->SetFont('arial', '', '10');
$fill = true;
foreach ($Data as $Baris) {
    $i = 0;
    foreach ($Baris as $Cell) {
        $pdf->Cell($Header[$i]['length'], 7, $Cell, 2, '0', $Kolom['align'], $fill);
        $i++;
    }
    $fill = !$fill;
    $pdf->Ln();
}
$pdf->Output('D', $Judul . '.pdf');
