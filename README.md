# mime_utils

A helper class for working with MIME types.
Should be particularly useful for validating file uploads.

Based on the MIME type list [found here.](https://gist.github.com/tylerlee/53609bff1346cebf8f0a85b6be29a88e)

## Install

Via Composer

``` bash
$ composer require imonroe/mime_utils
```

## Usage

``` php
  $allowed_mimes = new MimeUtils;
  // You can allow all the available types:
  $allowed_mimes->allow_all();
  
  // or you can allow just certain subtypes:
  $allowed_mimes->allow('image');
  $allowed_mimes->allow('video');
  
  // text types include htm, html, css
  $allowed_mimes->allow('text');
  $allowed_mimes->allow('audio');
  
  // The application types allow potentially problematic types, e.g., pdf, swf, js, class
  // enable it only if necessary.
  $allowed_mimes->allow('application');
  $allowed_mimes->allow('ms-office');
  $allowed_mimes->allow('open-office');
  $allowed_mimes->allow('wordperfect');
  $allowed_mimes->allow('iwork');
  
  // You can get the allowed extenstions as a string:
  $mime_string = 'mimes:' . $allowed_mimes->get_extensions('string');
  // or as an array: 
  $mime_string = 'mimes:' . $allowed_mimes->get_extensions('array');
  // or as JSON:
  $mime_string = 'mimes:' . $allowed_mimes->get_extensions('json');

  // You can also get the types in the same way, in the same formats:
  $mime_string = 'mimes:' . $allowed_mimes->get_types('string');
  // or 
  $mime_string = 'mimes:' . $allowed_mimes->get_types('array');
  // or 
  $mime_string = 'mimes:' . $allowed_mimes->get_types('json');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ian@ianmonroe.com instead of using the issue tracker.

## Credits

- [Ian Monroe](https://www.ianmonroe.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
