<?php

// include FPDF engine.
require( 'fpdf/fpdf.php' );

// display comma as decimal separator.
function displayComma( $data )
{
    $data2 = str_replace( ".", ",", $data );
    return $data2;
}

// create new PDF function.
function createPDF( $logo_filename, $invoice_ref, $invoice_date, $professional_data, $customer_data, $descriptions, $unitPriceExclVat, $vatRate, $quantity, $special_mention, $footer )
{
    // define font.
    $font = "Arial";
    $pdf = new FPDF();
    $pdf->AddPage();
    // logo: if no filename is provided use default ('../css/images/logo.jpg')
    if ( empty( $logo_filename ) )
        $logo_filename = "../css/images/logo.jpg";
    $pdf->Image( $logo_filename, 10, 10, 0, 30 );
    // invoice reference & date.
    $pdf->SetFont( $font, "B", 10 );
    $pdf->Cell( 0, 5, "Facture", 0, 1, "R" );
    $pdf->Cell( 0, 5, "Réf. : ".$invoice_ref, 0, 1, "R" );
    $pdf->SetFont( $font, "", 8 );
    $pdf->Cell( 0, 5, "date : ".$invoice_date, 0, 1, "R" );
    // professional information.
    $pdf->SetFont( $font, "", 8 );
    $pdf->Text( 12, 48, "Émetteur :" );
    $pdf->SetFillColor( 220, 220, 220 );
    $pdf->Rect( 10, 50, 80, 35, "F" );
    $count = 0;
    foreach( $professional_data as $data )
    {
        $count++;
        if ( $count == 1 )
        {
            $pdf->SetFont( $font, "B", 10 );
        }
        else
        {
            $pdf->SetFont( $font, "", 10 );
        }
        $pdf->Text( 20, 55 + $count * 5, $data );
    }
    // customer information.
    $pdf->SetFont( $font, "", 8 );
    $pdf->Text( 102, 43, "Adressé à :" );
    $pdf->Rect( 100, 45, 95, 40 );
    $count = 0;
    foreach( $customer_data as $data )
    {
        $count++;
        if ( $count == 1 )
        {
            $pdf->SetFont( $font, "B", 10 );
        }
        else
        {
            $pdf->SetFont( $font, "", 10 );
        }
        $pdf->Text( 120, 55 + $count * 5, $data );
    }
    // invoice array.
    $pdf->SetFont( $font, "", 8 );
    $pdf->Rect( 10, 95, 100, 6 );
    $pdf->Text( 12, 99, "Désignation" );
    $pdf->Rect( 110, 95, 15, 6 );
    $pdf->Text( 114, 99, "TVA" );
    $pdf->Rect( 125, 95, 25, 6 );
    $pdf->Text( 133, 99, "P.U. HT" );
    $pdf->Rect( 150, 95, 15, 6 );
    $pdf->Text( 155, 99, "Qté" );
    $pdf->Rect( 165, 95, 30, 6 );
    $pdf->Text( 173, 99, "Total TTC" );
    $pdf->Rect( 10, 101, 100, 100 );
    $pdf->Rect( 110, 101, 15, 100 );
    $pdf->Rect( 125, 101, 25, 100 );
    $pdf->Rect( 150, 101, 15, 100 );
    $pdf->Rect( 165, 101, 30, 100 );
    $count = 0;
    foreach( $descriptions as $data )
    {
        $count++;
        $pdf->Text( 15, 110 + ( $count - 1 ) * 5, $data );
    }
    $count = 0;
    foreach( $vatRate as $data )
    {
        $count++;
        $pdf->Text( 114, 110 + ( $count - 1 ) * 5, displayComma( $data )." %" );
    }
    $count = 0;
    foreach( $unitPriceExclVat as $data )
    {
        $count++;
        $pdf->Text( 133, 110 + ( $count - 1 ) * 5, displayComma( $data )." €" );
    }
    $count = 0;
    foreach( $quantity as $data )
    {
        $count++;
        $pdf->Text( 157, 110 + ( $count - 1 ) * 5, $data );
    }
    $count1 = count( $unitPriceExclVat );
    $count2 = count( $vatRate );
    $count3 = count( $quantity );
    $count = 0;
    $total_ht  = 0.0;
    $total_ttc = 0.0;
    for ( $i = 0 ; $i< $count1 ; $i++ )
    {
        $count++;
        $total = $unitPriceExclVat[ $i ] * ( 1.0 + $vatRate[ $i ] / 100.0 ) * $quantity[ $i ];
        $total_ttc = $total_ttc + $total;
        $total_ht  = $total_ht  + $unitPriceExclVat[ $i ] * $quantity[ $i ];
        $pdf->Text( 175, 110 + ( $count - 1 ) * 5, displayComma( number_format( $total, 2 ) )." €" );
    }
    $total_vat = $total_ttc - $total_ht;
    // total price & vat.
    $pdf->Text( 130, 205, "Total HT" );
    $pdf->Text( 130, 209, "Total TVA" );
    $pdf->Rect( 129, 210, 66, 4, "F" );
    $pdf->Text( 130, 213, "Total TTC" );
    $pdf->Text( 175, 205, displayComma( number_format( $total_ht, 2 ) )." €" );
    $pdf->Text( 175, 209, displayComma( number_format( $total_vat, 2 ) )." €" );
    $pdf->Text( 175, 213, displayComma( number_format( $total_ttc, 2 ) )." €" );
    // special mention.
    $pdf->SetFont( $font, "B", 8 );
    $pdf->Text( 10, 205, $special_mention );
    // legal mention.
    $pdf->SetFont( $font, "", 6 );
    $pdf->SetX( 0 );
    $pdf->SetY( 270 );
    foreach( $footer as $data )
    {
        $pdf->Cell( 0, 3, $data, 0, 1, "C" );
    }
    $pdf->Output( "a.pdf" );
    echo "<a href='a.pdf'> ici</a>";
}

// test.
$professional_data = array( "Chambres d'hôtes Chalaire", "Maison Forte", "27 rue du Chat qui Pisse", "38000 Grenoble" );
$customer_data = array( "Toto le Toto", "6ème étage", "7 rue Titi Mumu", "38100 Grenoble" );
$descriptions = array( "Nuit du 24/05/2012 au 25/05/2012", "Nuit du 31/05/2012 au 01/06/2012" );
$unitPriceExclVat = array( "88.2", "88.2" );
$vatRate = array( "20.6", "20.6" );
$quantity = array( "1", "2" );
$footer = array( "Régime auto-entrepreneur - SIRET 528 747 777 000 28", "NAF 7112B" );
createPDF( "", "FA1205-0035", "25/05/2012", $professional_data, $customer_data, $descriptions, $unitPriceExclVat, $vatRate, $quantity, "* TVA non applicable art-293B du CGI", $footer );

?>