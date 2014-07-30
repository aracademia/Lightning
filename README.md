# Lightning Laravel Forms
=========

*Create Laravel forms with a single line of code*

### Installation ( using composer )
1. Add the code below to your `composer.json` file
<p>
    ```
    "require-dev":
    {
        "aracademia/lightning": "~1.0"
    }
    ```
</p>
2. Run Composer update in your terminal

3. Add the service provider below to `app/config/app.php` under the `providers` array
    ```
    'Aracademia\Lightning\LightningFormServiceProvider'
    ```
4. Publish the config file by running the command below in your terminal. After that the config file will be placed under `app/config/packages/aracademia/lightning`
    <p>```
    php artisan config:publish aracademia/lightning
    ```</p>

### How to use the package
Let's use an example to see how easy this package is. We are going to create a contact us form.
open a view file, make sure it has `.blade.php` extension, then enter the following code
    ```
    {{Lightning::create('contact')}}
    ```
That's it. These three words will create a contact us form with the following fields: First Name, Last Name, Email, Message, Submit button using bootstrap styling, and the post url will be the current page url by default.

If you would like to create a login form, then all you have to do is change the name contact to login
    ```
    {{Lightning::create('login')}}
    ```
That will create a login form with email and password fields.
######Ok, that's cool... but wait a minute! what if I want to add other fields or maybe edit the existing fields? what if I want to add attributes to my fields or override the class? how about changing the form action url?*
Don't worry, we got your back. This package is very flexible and customizable.

### Edit the config file
Let's first start by editing the config file. Let's say we want to add a new form that allows the user to add their personal information to their profile.

1. Go to the config file, and add another nested array under the forms array with the form name and the fields
```
    "forms"   =>  [
        'contact'       => 'first_name,last_name,email,message',
        'login'         =>  'email,password',
        'register'      =>  'first_name,last_name,email,password,password_confirmation',
        'personalInfo'  =>  'age, telephone, homephone, favorite_movie'//...etc you got the idea
```

2. Go to your view where you want to place the form and call
<p>
    ```
    {{Lightning::create('personalInfo')}}
    ```
</p>

You can add more fields or remove some from the existing forms in the config file to suit your needs.

The inputTypes array in the config file show some common input field names linked to their html 5 types, that way if you don't want to specify the type of an input manually, this array will set the correct input types to the name.
For example, the email input name will have a type of `email` automatically instead of the default `text`
You can add more names to the array, however keep in mind that the type of the name needs to be compatible with laravel Form facade.
In addition, we can also override the type of any field. check the `Inline Customization` section below for more information

The rest of the config file are just bootstrap classes and div wrapper. You can change those if you are not using bootstrap.

### Inline Customization

The create method for the lightning form accepts 4 arguments
Lightning::create(1,[2],[3],[4])

1. First argument is a string. It is the name of the form we want to create. ex: login, register, contact...

2. This argument uses the laravel form open argument. we can pass url, route, action, method...etc ex: ```Lightning::create('register',['url'=>'login','method'=>'post'....])```

3. Here we can add or edit fields to the form and their attributes. make sure to separate the attribute name and value with a colon `:` and a comma `,` between the attributes. ex: ```Lightning::form('create',['route'=>'product.create'],['name'=>'required:required, id:productName, class:bar'])```

4. Last argument is an array for the submit button. ex: ```Lightning::create('survey',null,null,['name'=>'submit','value'=>'Send','class'=>'btn btn-primary'])```

Take a look at this example. We are going to customize the registration form

```
{{Lightning::create('register',['route'=>'register.create'],['age'=>'required:required,type:number','mobile'=>'type:tel'],['value'=>'Join','class'=>'btn btn-success'])}}
```
The code above will create a registration form with the default fields in the config file in addition to two new fields (age, mobile).
if you want to override an existing field attributes, simply pass the name of the field and the attributes you want to add or override.
