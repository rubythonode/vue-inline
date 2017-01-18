# vue-inline

Vue inline is a beta package wich goal is not more than keeping a confident and organized data source. Each of repositories that extend from it is meant to maintain separate concerns.

I created this solution after dealing with Vue. js templates and Blade. The solution is an approach to keep organized and centralized the information passed down to each Vue.js components using the inline-template attribute.



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


# How to build a component body

To make a component body you will have to call the methods from the component create, As so,

```php
public function profile()
{
    return $this->tagName('users-profile')
        ->withAlerts()
        ->withTrans()
        ->whitErrors()
        ->render();
}

```










