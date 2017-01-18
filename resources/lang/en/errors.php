<?php

return [

    'oh_snap' => 'Oh snap!',
    'wrong_input' => 'The information given does not match our records, please try again!',
    'login_throttling' => 'You have reached the maximum login attempts allowed. Try again in [:time] seconds.',

    'request' => [
        'title' => 'Request Error',
        'message' => 'Unexpected request, try again!'
    ],

    'validation' => [
        'title' => 'Validation Error',
        'message' => 'There was a problem validating the request, try again!'
    ],

    'whoops' => [
        'title' => 'Whoops, looks like something went wrong.',
        'message' => 'There was an internal error processing your request.'
    ],

    'inputs' => [
        'required' => 'The field is required.',
        'url' => 'The field format is invalid.',
        'dateISO' => 'Please enter a valid date.',
        'numeric' => 'The field must be a number.',
        'phone' => 'The field may have a valid format.',
        'alpha' => 'The field may only contains letters.',
        'integer' => 'The field may be an integer number.',
        'blank' => 'The field does not allow blank spaces.',
        'email' => 'The field may be a valid email address.',
        'confirmed' => 'The field confirmation does not match.',
        'exists' => 'The selected field does not match our records.',
        'alphaNum' => 'The field may only contains letters and numbers.',
        'phone' => 'The field does not have a valid phone number format.',
    ],

    '403' => [
        'title' => 'This action is unauthorized!',
        'message' => 'There was a problem validating the request, try again!'
    ],

    '404' => [
        'title' => 'Page Not Found',
        'message' => 'Sorry, but the page you are looking for has not been found. Try checking the URL for errors and hit the refresh button on your browser.'
    ],

    '422' => [
        'title' => 'Unprocessable Entity',
        'message' => 'The request was well-formed but was unable to be followed due to semantic errors.'
    ],

    '500' => [
        'title' => 'Internal Server Error',
        'message' => 'The server encountered something unexpected that did not allow it to complete the request.'
    ]

];
