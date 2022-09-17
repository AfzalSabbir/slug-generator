<?php

return [
    "set-on-create" => true, // Whether to set the slug when the model is created
    "set-on-update" => false, // Whether to update the slug when the target field is updated
    "target-field"  => "title", // The field that will be used to generate the slug
    "separator"     => "-", // The separator that will be used to separate the words
    "slug-field"    => "slug", // The field that will be used to store the slug
];
