# SLogger

A Simple Logger class for PhP.

![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/kuran/SLogger/php)

## About

This is a simple Logger class meant to be easy to implement so that you don't have to worry about to much configuration.  
This class follow a PSR-3 standard but do not implement directly the logger interface to make full use of enums as the error levels.

## Basic Usage

The minimum setup needed to use the Logger class.

```php
<?php
require_once("vendor/Autoloader.php");

use Kuran\SLOGGER\{Logger, ErrorLevel, Managers\FileManager};

/* Instantiate the class.
* Then create a new Manager. The FileManager include a default LineFormatter,
* which writes to 'app.log' by default.
*/
$log = new Logger( array( new FileManager() ) );


/* Simple log.
*  Needs a message body, and an array for context.
*/
$log->alert(
    message: "Test message for the file {:file}",
    context: array(
        ":file" => __FILE__,
        ":extras" => array(
            ["name" => "Admin", "username" => "admin"],
            ["name" => "Root", "username" => "root"]
            )
        )
);
```

## Logger class options

### - **_`Constructor`_**

| Argument | Description                                |
| -------- | ------------------------------------------ |
| managers | set an array of managers at instanciation. |

```php
    __construct(array $managers = array())
```

Same as creating a logger without argument then using the **_`setManagers()`_** function

### - **_`setManagers method`_**

This method is used to set an array of managers to the logger.  
This will completly replace the Logger's managers list.

```php
    setManagers(managers: = array(
        new FileManager(filePath: 'debug.log', level: ErrorLevel::Debug, formater: null),
        new FileManager(filePath: 'errors.log', level: ErrorLevel::Error, formater: null)
        )
    );
```

Many managers can be used to log messages to different files, or using different methods (Database...). Or to log messages with different Error Levels.

### - **_`addManager method`_**

This method is used to add a simgle manager to the managers stack.  
If you want to add another **_`Manager`_** later in your code.

```php
    addManager(ManagerInterface $manager);
```

## FileManager options

### - **_`Constructor`_**

all arguments are optional.
| Argument | Description |
|----------|------------------------------------------------------------------------------------------|
| filePath | If no filepath is defined, it will log message to **_`app.log`_** by default |
| level | Default level is **_`ErrorLevel::ERROR`_** |
| formater | If no Formater is defined, it will default to a **_`LineFormater`_** with default options. |

```php
__construct(
        filePath: = 'app.log',
        level: = ErrorLevel::ERROR,
        formater: = null)
```

### - **_`setFormater`_**

used to replace the Formater already in place.

```php
    setFormater(FormaterInterface $formater)
```

### Usage

```php
    $manager = new FileManager(
        filePath: "path/to/logfile.log",
        level: ErrorLevel::INFO, // Set the minimum Error level for this manager.
        formater: new LineFormater()
    )

    // Setting multiple managers with different Error Levels

    $log = new Logger();

    $errorManager = new FileManager(
        filePath: "error.log",
        level: ErrorLevel::ERROR
    );
    $debugManager = new FileManager(
        filePath: "debug.log",
        level: ErrorLevel::DEBUG
    );

    //set the Manager list to $errorManager and $debugManager
    $log->setManagers(array($errorManager, $debugManager));

    // add $manager to the list of managers
    $log->addManager($manager);
```

#### Error Levels

The Error levels are defined as follow in the **_`ErrorLevel`_** enum

```php
enum ErrorLevel: int
{
    case EMERGENCY = 800; //ErrorLevel::EMERGENCY
    case ALERT     = 700; //ErrorLevel::ALERT
    case CRITICAL  = 600; //ErrorLevel::CRITIAL
    case ERROR     = 500; //ErrorLevel::ERROR
    case WARNING   = 400; //ErrorLevel::WARNING
    case NOTICE    = 300; //ErrorLevel::NOTICE
    case INFO      = 200; //ErrorLevel::INFO
    case DEBUG     = 100; //ErrorLevel::DEBUG
}
```

ErrorLevel entry can be returned by name or number using the enum methods fromValue(int) and fromName(string).

```php
    ErrorLevel::fromValue(700); // ErrorLevel::ALERT
    ErrorLevel::fromName('Notice'); // ErrorLevel::NOTICE
```

Both will throw an exeption if the value or name are invalid.

## LineFormater options

### - **_`Constructor`_**

All arguments are optional.

| Argument   | Description                                                                        |
| ---------- | ---------------------------------------------------------------------------------- |
| format     | If no format is defined, it will default to **Date \[ Level \] > Message Context** |
| timeFormat | If no date format is defined, it will default to **Y-m-d H:i:s**                   |

```php
    __construct(
        string $format = null,
        string $timeFormat = null
        )
```

### Usage

```php
$formater = new LineFormater(
    format: "{:date} {:errorLevel} {:message} {:context}",
    timeFormat: "m-d-Y H:i"
);
```

For every entry used in the format using {:parameter}, a replacement will be made with entries from the context array.