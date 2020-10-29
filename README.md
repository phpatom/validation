<h3 align="center">Validation</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)


</div>

---

<p align="center">
    An intuitive library to validate PSR-7 server requests
    <br> 
</p>

## 📝 Table of Contents

- [Prerequisites](#prerequisites)
- [Installing](#installing)
- [Testing](#testing)
- [Coding Style](#coding_style)
- [Getting Started](#getting_started)
- [Usage](#usage)
- [Contributing](#contributing)
- [Authors](#authors)


## Prerequisites <a name = "prerequisites"></a>


- PHP 7.3 +
- Composer 


## Installing <a name = "installing"></a>

The recommended way to install is via Composer:


```
composer require phpatom/validation
```


## Testing Installing <a name = "testing"></a>
 
```
composer test
```

### Coding style <a name = "coding_style"></a>

```
./vendor/bin/phpcs
```

## Getting Started <a name = "getting_started"></a>
```php
$v = new \Atom\Validation\Validator();
$v->assert("title")->is()->present()->filled()->alphaNumeric()->between(10,255);
$v->assert("post_id")->onQueryParams()->is()->present()->filled()->and()->follows(new PostExistenceConstraint());
$v->assert("content")->is()->presentAndFilled();
$v->assert("featured_image")->on(\Atom\Validation\Scope::files())->is()->present()->file()->image()->lessThan(200000);
$v->assert("created_at")->is()->present()->filled()->date()->and()->before("now");
  
$v->validate($request); // throw ValidationException   
//OR
$v->check($request);
if($v->failed()){
   return $v->errors();
}
```

## Usage <a name="usage"></a>

## Contributing <a name = "contributing"></a>
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.


## ✍️ Author <a name = "authors"></a>

- [@dani-gouken](https://github.com/dani-gouken) - Idea & Initial work

