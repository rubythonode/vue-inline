# Vue Inline

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gocanto/vue-inline.svg?style=flat-square)](https://img.shields.io/packagist/v/gocanto/vue-inline.svg)
<a href="https://github.com/gocanto/vue-inline/blob/master/LICENSE"><img src="https://img.shields.io/npm/l/easiest-js-validator.svg" alt="License"></a>
[![Total Downloads](https://img.shields.io/packagist/dt/gocanto/vue-inline.svg?style=flat-square)](https://img.shields.io/packagist/dt/gocanto/vue-inline.svg?style=flat-square)

Vue inline is a beta package wich goal is not more than keeping a confident and organized data source. Each of repositories that extend from it is meant to maintain separate concerns.

I created this solution after dealing with Vue. js templates and Blade. The solution is an approach to keep organized and centralized the information passed down to each Vue.js components using the inline-template attribute.


# Who is this for?

This package is meant to be for those developers who do not like to have everything mixed out. Those who like to have everything in the right place and organized. For examples: 

Instead of having something like this within your controllers: 

```php
return view('users.profile', [
    'component' => [
        'is' => 'users:profile',
        'profile'  => [
            'subject' => 'Gustavo',
            'name' => 'gustavoocanto@gmail.com'
        ]
    ]
]);
```

you will be able to decouple concerns and have everything coded as reusable as possible, like so: 

```php
return view('users.profile', [
    'component' => component('users:profile', ['profile' => $user])
]);
```


# Installation

Begin by installing the package through Composer. Run the following command in your terminal:

```bash
composer require gocanto/vue-inline
```

Once composer is done, add the package service provider in the providers array in `config/app.php`:

```php
Gocanto\VueInline\VueInlineServiceProvider::class
```



# Settings

You will be able to set the VueInline Namespace which is the one to be used to build components repository. A repository is an object where you will write all the components related to a concern, for examples: You can have a User repository and a login method to retrieve the login component body.

To have the configuration file within your project, you will have to type the following command in your console, as so: 

```
php artisan vendor:publish --tag=vueinline
```

Then you have to set the namespace value shipped within the configuration file located in ```config/vueinline.php```



# How it works

The package is shipped with two ways to building repositories. The first one can be done through the ```php component()``` <a href="https://github.com/gocanto/vue-inline/blob/master/tests/VueInlineTest.php#L20" _target="blank">helper</a>, and the second one is done through the <a href="https://github.com/gocanto/vue-inline/blob/master/tests/VueInlineTest.php#L53">concrete implementation</a>.

The constructor takes two parameters, the first one is the component signature, and the second is any optional external data you wish to pass down to the component. 

* Example ***without*** external data, <a href="https://github.com/gocanto/vue-inline/blob/master/tests/VueInlineTest.php#L20" _target="blank">See example</a>.

* Example ***with*** external data, <a href="https://github.com/gocanto/vue-inline/blob/master/tests/VueInlineTest.php#L64" _target="blank">See example</a>. 



# Create a repository

To create a ***new repository***, you will have to create a new class within the namespace specified in the configuration file. Then you have to extends from it in order for you to make use of its functionality. As so, 

```php
use Gocanto\VueInline\VueInline;

class Users extends VueInline
{
    public function profile()
    {
        //
    }
}
```

To create a ***new component*** within the existing repository, you will have to type as many methods as components you wish to have in this repository. As shown above with the ***profile*** method.


<a href="https://github.com/gocanto/vue-inline/blob/master/tests/Components/Users.php" _target="blank">See demo here</a>


# How to build a component body

To make a component body you will have to call the methods from the component create, As so,

```php
public function profile()
{
    return $this->tagName('users-profile')
        ->withAlerts()
        ->withTrans()
        ->whitErrors()
        ->withProps([
            'email' => [
                'subject' => 'testing',
                'name' => 'Gustavo Ocanto',
                'to' => 'gustavoocanto@gmail.com',
            ]
        ])
        ->render();
}

```

<a href="https://github.com/gocanto/vue-inline/blob/master/tests/Components/Users.php" _target="blank">See demo here</a>



# What each method does

* tagName: Set the component identifier in order for it to be picked up from Vue.js. Example: <component is="tagName"></component>

* withAlerts: Set a translation array with translations to be used within your JS, as a confirmation dialog.

* whitErrors: Set a translation array with translations to show some errors within your JS, as a confirmation dialog.

* withTrans: Set a translation array with translations to be used within your JS.

* withDefault: Sometimes you need to make use of all these translations, so this method is just a sugar that includes the errors, alerts and translates. 

* withProps: Set external data to be passed down to the Vue.js component as additional properties.

* render: Returns an array with the component props body and identifier.

<a href="https://github.com/gocanto/vue-inline/blob/master/tests/Components/Users.php" _target="blank">See demo here</a>


# How translations are selected

Translations are selected by the composition between the ***repository*** and the ***component*** asked for. For example, if the request was something like this ```php component('users:profile')```, then translations would be picked up as so, ```php trans('users.profile)```.

Sometimes you need to create a different component, but you want to use the same group of translations used by another component, so you will have to call ```php ->loadTransFrom('profile')``` method within a component creation process. Then you will have the profiles translations available in it. Example can be seen <a href="https://github.com/gocanto/vue-inline/blob/master/tests/Components/Users.php#L50" _target="blank">here</a>

<a href="https://github.com/gocanto/vue-inline/blob/master/resources/lang/en/users.php" _target="blank">Translation file example</a>


# The errors list

The errors list are picked up either from its translation section or from a errors language file. See the validation right <a href="https://github.com/gocanto/vue-inline/blob/master/src/VueInline.php#L104" _target="blank">here</a>

<a href="https://github.com/gocanto/vue-inline/blob/master/resources/lang/en/errors.php" _target="blank">Translation errors file example</a>


# Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.


# License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.



Don't forget to [follow me on twitter](https://twitter.com/gocanto)!

Thanks!

Gustavo Ocanto.
gustavoocanto@gmail.com











