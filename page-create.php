<?php
/*
Template Name: CREATE PDF
*/
//get_header(); ?>

<?php //wp_head(); ?>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once('wk/WkHtmlToPdf.php');
$id = $_GET['id']; //requested recipe ID
$title = $_GET['title'];
$pdf = new WkHtmlToPdf;
// Add a HTML file, a HTML string or a page from a URL
$pdf->addPage('http://lampinator.com/roi/?p=' . $id . '');
//$pdf->addPage('<html><h1>' . $derp . '</h1></html>');
//$pdf->addPage('<html><h1>' . $derp . '</h1></html>');
//$pdf->addPage('http://google.com');

// Add a cover (same sources as above are possible)
//$pdf->addCover('mycover.html');

// Add a Table of contents
//$pdf->addToc();

// Save the PDF
//$pdf->saveAs('derp.pdf');

// ... or send to client for inline display

$pdf->send( $title . '.pdf');
$pdf->send(); 
?>


<?php //get_footer(); ?>