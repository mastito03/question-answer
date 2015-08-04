<?php

return [

    'encoding' => 'UTF-8',
    'finalize' => true,
    'preload'  => false,
    'cachePath' => storage_path('purifier'),
    'settings' => [
        'default' => [
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'h1,h2,h3,h4,h5,h6,sup[id],sub,div[style|class],b,strong,i,em,ins,del,a[href|title|name|id|rev|class],ul,ol,li[id],p[style],br,span[style],img[width|height|alt|src],pre,code[class],blockquote,small,table[summary],thead,tbody,th[abbr],td[abbr],tr',
            'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => false,
            'definitions' => [
                'def' => [
                    'id' => 'html5-definitions',
                    'rev' => 1
                ],
                'elements' => [
                    ['figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common'],
                    ['figcaption', 'Inline', 'Flow', 'Common']
                ],
                'attributes' => [
                    ['iframe', 'allowfullscreen', 'Bool']
                ]
            ]
        ],
        "youtube" => [
            "HTML.SafeIframe" => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%",
        ],
    ],

];
