# colored_cli
Enum of colors for creating colored texts in the console


##install

```console
> composer require "ufo-cms/colored_cli: *"
```


#use

```php
use \UfoCms\ColoredCli;

...

echo CliColor::RED->value. "Some text" . CliColor::RESET->value;

```
