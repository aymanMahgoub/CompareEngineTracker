# CompareEngineTracker

- used to Compare properties form the same objects using @PropertyTracker annotation return isChanged (true/false) and changedList if exist.

## About

* We build **CompareEngineTracker** to suitable all php apps that need to keep track changing that happened to two objects (model, entities, documents ...etc).

## Installing

* Via Composer
```
$ composer require ayman-mahgoub/Compare-engine-tracker
```

## Getting Started
* add @propertyTracker annotation above your object property
```
    /**
    *@propertyTracker
    */
    private $name;
```
* pass the two models to compareEngineTracker.
```
     $reader        = new AnnotationReader();
     $compareEngine = new CompareEngineTracker($reader);
     $result        = $compareEngine->compare($oldObject, $newObject);
```

* result will contain isChanged index hold if the new object is changed or not and changedList index hold every property oldVal and newVal.

## Running the tests

`$ composer test`

# **please note that** 
* For now compare works only for two object form the same type.

## Contributing

* Please read [CONTRIBUTING.md](https://github.com/aymanMahgoub/CompareEngineTracker/blob/master/CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Ayman Mahgoub** - *Initial work* - [aymanMahgoub](https://github.com/aymanMahgoub)

* See also the list of [contributors](https://github.com/aymanMahgoub/CompareEngineTracker/contributors) who participated in this project.

## License

* This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/aymanMahgoub/CompareEngineTracker/blob/master/LICENSE.md) file for details
