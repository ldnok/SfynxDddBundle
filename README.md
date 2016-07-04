INSTALL
=======

in composer.json of your project :
```
"jms/serializer-bundle": "*",
"sfynx-project/tool-ddd-bundle": "2.8.0"
```

in AppKernel.php add the following :
```
...
new JMS\SerializerBundle\JMSSerializerBundle(),
new \Sfynx\DddBundle\SfynxDddBundle(),
...
```