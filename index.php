<?php

include './Iterator/HtmlIterator.php';

$htmlCode = new HtmlIterator(__DIR__ . '/page.html');

$changePage = fopen(__DIR__ . '/changePage.html','w+b');
$receivedPage = fopen(__DIR__ . '/receivedPage.txt','w+b');

foreach ($htmlCode as $key => $row) {
    $isMatched = preg_match(
        '/<+\bmeta\s\bname+=+"+keywords|description+"+[^>]*>|<+title+>+[^>]*>/',
        $row);
    if (!$isMatched) {
        print(trim($row));
        fwrite($changePage, $row);
    } else {
        fwrite($receivedPage, ltrim($row));
    }
}

fclose($changePage, $receivedPage);