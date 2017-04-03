# Dualhand Dumper Bundle

*Purpose of this bundle:*

This bundle prints the object's properties that are active in their sonata admin class.

*EXAMPLE:*

1. you have a class that extends another and for the current project you don't use all parent properties.
    > dumper-bundle prints only the fields on the associated sonata admin
2. print a dump. try to find all translatable properties. is not easy, uh?
    > dumper-bundle prints all translatable properties of the object
3. if you're a frontend developer or you just want to have all the properties of an object printed in twig.. this is your bundle!

##### IMPORTANT! -> This bundle requires symfony2 and sonata2

*INSTALL:*
```
composer require dualhand/dumper-bundle
```
*USAGE:*

just put this in your twig template

```{{ prop(object) }}```


if you want to report a bug, please do it in <a href="https://github.com/DualHand/DumperBundle">github</a> or mail me <a href="mailto:david@dualhand.com">david@dualhand.com</a> 

twitter: <a href="https://twitter.com/fodaveg">@fodaveg</a>
