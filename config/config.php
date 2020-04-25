<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Backdrop API server url
    |--------------------------------------------------------------------------
    |
    | URL of your backend Backdorp cms api site from where to pull the data
    |
    */

    'backdrop_api_server' => env('BACKDROP_API_SERVER', 'https://example.com'),

    /*
    |--------------------------------------------------------------------------
    | Node mapping configuration
    |--------------------------------------------------------------------------
    |
    | Optionally, you can configure a mapping for each node type you are
    | from the backend. Each node type is an array of fields which will be
    | converted to an object property on $node. Each of these fields contain
    | a roperty 'type' for 'single' or 'multiple' field type, a 'properties'
    | property for the chained properties to get a single field value or to
    | get the array of a multiple field. Finally, a 'multiple' field type has
    | a property 'value' of chained properties to get a single value.
    |
    | This is an example:
    |
    |'node_types' => [
    |    'post' => [
    |       'title' => [
    |            'type' => 'single',
    |            'properties' => [
    |                '#node',
    |                'title'
    |            ],
    |        ],
    |        'body' => [
    |           'type' => 'single',
    |           'properties' => [
    |               '#node',
    |               'body',
    |               'und',
    |               0,
    |               'value'
    |           ],
    |        ],
    |        'date' => [
    |            'type' => 'multiple',
    |            'properties' => [
    |                'field_date',
    |                '#items,
    |            ],
    |            'value' => [
    |                'value',
    |            ],
    |        ],
    |    ],
    |],
    |
    | This example will create the following mapping:
    |
    | $node object for your blade  |  JSON data from backend
    |-------------------------------------------------------
    | $node->title                ->   JSON->#node->title
    | $node->body                ->   JSON->#node->body->und[0]['value']
    |     each value of date[]    ->     each ->value of the #items[] array
    |
    | Then you only have to use the object $node in your blade files to print
    | out any of the properties just mapped, in this case $node->title, as a
    | string, and $node->date as an array of date values you can iterate to.
    |
    | If you don't use this mapping, you'll have to see at the JSON and use, as
    | for this example, $node->{'#node'}->title for the title, and
    | $node->field_date->{'#items}[0]->value for the first date value.
    |
    */
    'node_types' => [

    ],

];
