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



