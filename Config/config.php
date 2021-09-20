<?php

return [
    'binary' => 'chromium-browser',
    'params' => [
        'landscape'           => false,             // default to false
        'printBackground'     => false,             // default to false
        'displayHeaderFooter' => false,             // default to false
        'preferCSSPageSize'   => false,             // default to false ( reads parameters directly from @page )
        'marginTop'           => 0.0,              // defaults to ~0.4 (must be float, value in inches)
        'marginBottom'        => 0.4,              // defaults to ~0.4 (must be float, value in inches)
        'marginLeft'          => 0.4,              // defaults to ~0.4 (must be float, value in inches)
        'marginRight'         => 0.4,              // defaults to ~0.4 (must be float, value in inches)
        'paperWidth'          => 8.5,              // defaults to 8.5 (must be float, value in inches)
        'paperHeight'         => 11.0,              // defaults to 8.5 (must be float, value in inches)
        'headerTemplate'      => '',               // see details above
        'footerTemplate'      => '',               // see details above
        'scale'               => 0.9,              // defaults to 1.0 (must be float)
    ]

];
