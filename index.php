<?php
//Task
// An array of integer numbers is given, where each number represents the weight of a thing.
// Write an algorithm that places all things into the least possible amount of boxes, given the maximum weight capacity of the box.

//Random data samples
$dataSample = [
            [
                'things' => [1, 7, 8, 1, 2, 8, 7, 4, 2, 3, 2, 4, 1, 6, 3, 7, 4, 1, 5, 6, 5, 2, 3, 1, 1, 2, 4],
                'boxSize' => 8,
            ],
            [
                'things' => [1, 41, 47, 86, 13, 26, 88, 70, 4, 20, 3, 20, 40, 1, 56, 35, 79, 4, 15, 55, 65,
                             5, 98, 84, 90, 3, 1, 14, 2, 44],
                'boxSize' => 100,
            ],
            [
                'things' => [145, 977, 578, 887, 923, 5, 6, 745, 83, 1, 222, 87, 7, 4, 2, 388, 28, 477, 16,
                             999, 6, 3, 965, 7, 488, 1, 523, 633, 52, 222, 333, 143, 11, 233, 488],
                'boxSize' => 1000,
            ],
            [
                'things' => [1453, 74, 9977, 1435, 24, 822, 73, 4424, 252, 3344, 2, 4667, 8765, 63, 2343, 733, 344, 13,
                             5, 63, 20, 11, 88, 999, 12, 2, 5, 66, 90, 55, 2094, 8888, 1, 341, 8087, 999],
                'boxSize' => 10000,
            ],
];

//Used data from sample. Change $sampleNo to 0...3 use other sample.
$sampleNo = 3;
$things = $dataSample[$sampleNo]['things'];
$boxSize = $dataSample[$sampleNo]['boxSize'];


//Initial empty boxes
$allBoxes = [];
$newBox = [];

// Things sorted in descending order
arsort($things);

// First box added
$allBoxes[] = $newBox;

//TODO: check if $thing is >.5 of boxSize, if true, skip to logic under 'else' (add to new box at once).

// Packing
foreach ($things as $thing) {

    $resetWhileLoop = true;
    while ($resetWhileLoop == true) {

        // Checking each box for enough empty space; adding item if found; adding new empty box if not;
        // adding item into the new box; repeat
        foreach ($allBoxes as $key => $box) {
            $boxSpaceRemaining = $boxSize - array_sum($allBoxes[$key]);
            if ($boxSpaceRemaining >= $thing) {
                $allBoxes[$key][] = $thing;
                $resetWhileLoop = false;
                break;
            } else if ($key < (count($allBoxes) - 1)) {
                continue;
            } else {
                $allBoxes[] = $newBox;
                $allBoxes[$key+1][] = $thing;
                $resetWhileLoop = false;
                break;
            }
        }
    }
}

// Printing out results
foreach ($allBoxes as $key => $value) {
    ?>
        <p>Box No.<?= $key + 1 ?>:  [<?= implode("] [", $value) ?>]<p>
        <p style="margin-left:100px">Filled: <?= array_sum($value) / $boxSize * 100 ?>%</p>
        <hr>
    <?php
}

