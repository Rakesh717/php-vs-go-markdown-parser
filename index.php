<?php

require_once __DIR__ . '/vendor/autoload.php';

use League\CommonMark\CommonMarkConverter;

$ffi = FFI::cdef("const char* ParseMarkdown(char* input);", __DIR__ . '/go/main.so');

$converter = new CommonMarkConverter([
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
]);

$markdown = file_get_contents(__DIR__ . '/test.md');

$stats = [];

$iterations = [1, 1000, 10000, 50000];

foreach ($iterations as $iteration) {
    $t1 = 0;
    $t2 = 0;

    for ($i = 0; $i < $iteration; $i++) {
        $t1 += timeit(fn ()  => $ffi->ParseMarkdown($markdown));
        $t2 += timeit(fn ()  => $converter->convert($markdown));
    }
    $stats[] = [
        'iteration' => $iteration,
        'go' => $t1,
        'php' => $t2,
    ];
}

var_dump($stats);

function timeit($fn)
{
    $start = microtime(true);
    $fn();
    return (microtime(true) - $start) . PHP_EOL;
}
