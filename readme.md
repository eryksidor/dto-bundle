
# Data transfer objects bundle for Symfony projects

[![Latest Version on Packagist](https://img.shields.io/packagist/v/esidor/dto-bundle.svg?style=flat-square)](https://packagist.org/packages/esidor/dto-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/esidor/dto-bundle.svg?style=flat-square)](https://packagist.org/packages/esidor/dto-bundle)

## Installation

You can install the package via composer:

```bash
composer require esidor/dto-bundle
```

Optionally you can enable param converters
```yaml
sensio_framework_extra:
    request:
        converters: true
```

## Usage

The goal of this bundle is allow to serialize arrays to DTO's. Here is example DTO class:

```php

use Esidor\DtoBundle\Object\AbstractDto;
use DateTime;

class SignInDto extends AbstractDto
{

     /**
      * @var string|null
      */
     public ?string $email;

     /**
      * @var string|null
      */
     public ?string $password;

     /**
      * @var int|null
      */
     #[Assert\NotNull]
     #[Assert\Positive]
     public ?int $smsCode;
}
```

You could create this DTO like:

```php
$signInDto = new SignInDto(
    [
          'email': 'test@example.com',
          'password': '12345678',
          'smsCode': 234
    ]
);
```

## Builtin class types and casters

In DTO class you can use as type standard types, DateTime class, classes which extend AbstractDto class and array containing all of above

```php
      /**
      * @var DateTime|null
      */
     public ?DateTime $date;

     /**
      * @var TestDto
      */
     public TestDto $test;

     /**
      * @var TestDto[]
      */
     #[DtoArray(type: TestDto::class)]
     public array $testDtoGroup;

     /**
      * @var DateTime[]
      */
     #[DtoArray(type: DateTime::class)]
     public array $possibleDates;
```

As you see if you want to cast array of elements you must use attribute

```php
#[DtoArray(type: TestDto::class)]
```

As type you can pass any of allowed types

## Custom types and casters

TODO in next release


## Validation
You can use Symfony Validator Constraints

```php
     /**
      * @var string|null
      */
     #[Assert\NotBlank]
     #[Assert\Email()]
     public ?string $email;

     /**
      * @var string|null
      */
     #[Assert\NotBlank]
     #[Assert\Length(min: 8)]
     public ?string $password;


     /**
      * @var TestDto|null
      */
     #[Assert\Type(TestDto::class)]
     #[Assert\NotNull]
     #[Assert\Valid]
     public TestDto $test;

     /**
      * @var DateTime[]
      */
     #[DtoArray(type: DateTime::class)]
     #[Assert\Count(max: 3)]
     #[Assert\All([
          new Assert\Type(type: DateTime::class),
          new Assert\GreaterThan('2023-01-01')
     ])]
     public array $dates;
```

After creating DTO instance you can validate it

```php
$errors = $validator->validate($dto)
```

## Argument resolvers
We provide 2 argument resolvers: DtoArgumentValueResolver and DtoConstraintViolationListResolver so you can automatically convert request params to dto and validate this dto object

```php
     #[Post(path: '/sign-in')]
     public function signIn(SignInDto $signInDto, DtoConstraintViolationList $dtoConstraintViolationList)
     {
          if(!$dtoConstraintViolationList->isValid()){
               $errors = $dtoConstraintViolationList->toArray();
          }
     }
```

## Testing
TODO in next release

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
