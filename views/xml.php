<?php
/**
 * @var int $id
 * @var string $name
 * @var int[] $grades
 * @var string $status [pass, fail]
 * @var int $average
 */

$gradeList = "";
foreach ($grades as $key => $grade) {
    $gradeList .= "<$key>{$grade}</$key>";
}

$xml = <<<XML
<?xml version='1.0' standalone='yes'?>
<student>
<id>{$id}</id>
<name>{$name}</name>
<gradeList>
    $gradeList
</gradeList>
<average>
    $average
</average>
<pass>
    $status
</pass>
</student>
XML;

echo $xml;