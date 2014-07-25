<?php
/**
 * User: rrafia
 * Date: 7/23/14
 */
return [
    'forms'   =>  [
        'contact'   => 'first_name,last_name,email,message',
        'login'     =>  'email,password',
        'register'  =>  'first_name,last_name,email,password,password_confirmation'
    ],
    'inputTypes'    =>  [
        'email'                     =>  'email',
        'email_confirmation'        =>  'email',
        'password'                  =>  'password',
        'password_confirmation'     =>  'password',
        'description'               =>  'textarea',
        'bio'                       =>  'textarea',
        'body'                      =>  'textarea',
        'message'                   =>  'textarea',
        'hidden'                    =>  'hidden',
        'file'                      =>  'file',
        'select'                    =>  'select',
        'checkbox'                  =>  'checkbox',
        'radio'                     =>  'radio',

    ],
    'htmlWrapper'   =>  'div',
    'divGroupClass' =>  'form-group',
    'inputClass'    =>  'form-control',
    'submitClass'   =>  'btn btn-default',
    'submitName'    =>  'submit'
];