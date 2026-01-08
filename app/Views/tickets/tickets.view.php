<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Options pour activer HTML5 et ressources distantes

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->setTempDir(__DIR__ . '/../../../tmp');




$dompdf = new Dompdf($options);

// Variables dynamiques
$seat = 14;
$price = 1200;
$ticketId = "#BM-772026";
$categoryName = "VIP PRESTIGE";
$matchName = "WYDAD AC VS RAJA CA";
$dateMatch = "28 JANVIER 2026 • 20:00 • STADE MOHAMMED V";

// HTML du ticket
$html = "
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;900&display=swap');
    body { background-color: #000; color: #fff; font-family: 'Outfit', sans-serif; margin:0; padding:0; }
    .ticket-container { width:700px; margin:50px auto; background:#0a0a0a; border:2px solid #D4AF37; border-radius:30px; overflow:hidden; }
    .header { background:linear-gradient(90deg,#1a1a1a 0%,#000 100%); padding:30px; text-align:center; border-bottom:2px dashed #333; }
    .match-title { color:#D4AF37; text-transform:uppercase; font-size:24px; font-weight:900; letter-spacing:5px; margin-bottom:10px; }
    .teams { font-size:18px; margin:15px 0; }
    .teams span { color:#D4AF37; margin:0 10px; }
    .body-content { padding:40px; }
    .category-name { font-size:40px; font-weight:900; color:#D4AF37; text-transform:uppercase; margin-bottom:20px; font-style:italic; }
    .details-table { width:100%; margin-top:30px; }
    .details-table td { padding:15px 0; }
    .label { font-size:10px; color:#666; text-transform:uppercase; letter-spacing:2px; }
    .value { font-size:16px; font-weight:bold; text-transform:uppercase; }
    .qr-section { background:#111; text-align:center; padding:30px; border-top:2px dashed #333; }
    .footer-text { font-size:10px; color:#444; letter-spacing:3px; margin-top:10px; }
    .price-tag { font-size:24px; font-weight:900; color:#fff; }
</style>

<div class='ticket-container'>
    <div class='header'>
        <div class='match-title'>Official Match Pass</div>
        <div class='teams'>{$matchName}</div>
        <div style='font-size:10px;color:#666;'>{$dateMatch}</div>
    </div>
    <div class='body-content'>
        <div class='category-name'>{$categoryName}</div>
        <table class='details-table'>
            <tr>
                <td>
                    <div class='label'>Siège</div>
                    <div class='value' style='color:#D4AF37'>#{$seat}</div>
                </td>
                <td>
                    <div class='label'>Prix Total</div>
                    <div class='price-tag'>{$price} DH</div>
                </td>
                <td>
                    <div class='label'>ID Billet</div>
                    <div class='value'>{$ticketId}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class='qr-section'>
        <div style='background:#fff; width:100px; height:100px; margin:0 auto; padding:10px;'>
            <p style='color:#000;font-size:10px;margin-top:35px;'>[QR CODE]</p>
        </div>
        <div class='footer-text'>SCAN AT ENTRANCE</div>
    </div>
</div>
";

// Générer le PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$pdfContent = $dompdf->output();

// Optionnel : sauvegarder le PDF localement
// file_put_contents(__DIR__.'/ticket.pdf', $pdfContent);

// echo "PDF généré avec succès !";
