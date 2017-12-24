# Eskirex Dotify Component
Hello.
This is Dotify component.

## Examples
```php
<?php
    use Eskirex\Component\Dotify\Dotify;
    $arr = [
        'foo' => [
            'bar' => 'baz'
        ]
    ];

    $dotify = new Dotify($arr); // Optional method "setArray" or "setReferenceArray"
                                // Optional anonymous helper function "dotify()"

    print_r($dotify->get('foo'));       // Array
                                        // (
                                        //     [bar] => baz
                                        // )

    print_r($dotify->merge('foo', [     // Array
        'baz' => 'bar'                  // (
    ]));                                //     [bar] => baz
                                        //     [baz] => bar
                                        // )
                                        
    
```
## License
MIT