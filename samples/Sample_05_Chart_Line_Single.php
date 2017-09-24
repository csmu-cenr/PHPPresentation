<?php

include_once 'Sample_Header.php';

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Area;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar3D;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Line;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Pie;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Pie3D;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Scatter;
use PhpOffice\PhpPresentation\Shape\Chart\Series;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Border;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Fill;
use PhpOffice\PhpPresentation\Style\Shadow;


function fnSlide_Scatter(PhpPresentation $objPHPPresentation) {
    global $oFill;
    global $oShadow;
    
    // Create templated slide
    echo EOL.date('H:i:s') . ' Create templated slide'.EOL;
    $currentSlide = createTemplatedSlide($objPHPPresentation); // local function
    
    // Generate sample data for fourth chart
    echo date('H:i:s') . ' Generate sample data for chart'.EOL;
    $seriesData = array('Monday' => 0.1, 'Tuesday' => 0.33333, 'Wednesday' => 0.4444, 'Thursday' => 0.5, 'Friday' => 0.4666, 'Saturday' => 0.3666, 'Sunday' => 0.1666);
    
    // Create a scatter chart (that should be inserted in a shape)
    echo date('H:i:s') . ' Create a scatter chart (that should be inserted in a chart shape)'.EOL;
    $lineChart = new Scatter();
    $series = new Series('Downloads', $seriesData);
    $series->valuesMultiplyBy100();
    $series->setShowSeriesName(true);
    $series->getMarker()->setSymbol(\PhpOffice\PhpPresentation\Shape\Chart\Marker::SYMBOL_DASH);
    $series->getMarker()->setSize(10);
    $lineChart->addSeries($series);
    
    // Create a shape (chart)
    echo date('H:i:s') . ' Create a shape (chart)'.EOL;
    $shape = $currentSlide->createChartShape();
    $shape->setName('PHPPresentation Daily Download Distribution')
        ->setResizeProportional(false)
        ->setHeight(550)
        ->setWidth(700)
        ->setOffsetX(120)
        ->setOffsetY(80);
    $shape->setShadow($oShadow);
    $shape->setFill($oFill);
    $shape->getBorder()->setLineStyle(Border::LINE_SINGLE);
    $shape->getTitle()->setText('PHPPresentation Daily Downloads');
    $shape->getTitle()->getFont()->setItalic(true);
    $shape->getPlotArea()->setType($lineChart);
    $shape->getView3D()->setRotationX(30);
    $shape->getView3D()->setPerspective(30);
    $shape->getLegend()->getBorder()->setLineStyle(Border::LINE_SINGLE);
    $shape->getLegend()->getFont()->setItalic(true);
}

// Create new PHPPresentation object
echo date('H:i:s') . ' Create new PHPPresentation object'.EOL;
$objPHPPresentation = new PhpPresentation();

// Set properties
echo date('H:i:s') . ' Set properties'.EOL;
$objPHPPresentation->getDocumentProperties()->setCreator('PHPOffice')
                                  ->setLastModifiedBy('PHPPresentation Team')
                                  ->setTitle('Sample 07 Title')
                                  ->setSubject('Sample 07 Subject')
                                  ->setDescription('Sample 07 Description')
                                  ->setKeywords('office 2007 openxml libreoffice odt php')
                                  ->setCategory('Sample Category');

// Remove first slide
echo date('H:i:s') . ' Remove first slide'.EOL;
$objPHPPresentation->removeSlideByIndex(0);

// Set Style
$oFill = new Fill();
$oFill->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('FFE06B20'));

$oShadow = new Shadow();
$oShadow->setVisible(true)->setDirection(45)->setDistance(10);



fnSlide_Scatter($objPHPPresentation);

// Save file
echo write($objPHPPresentation, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
