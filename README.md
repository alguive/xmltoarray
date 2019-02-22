## Convert Xml to Array

A simply way to convert from XML to Array.

```
$xmlPath = 'filepath';
$xmlToArray = new \Alvaro\Xmltoarray\XmlParser($xmlPath);
$arrayResult = $xmlToArray->parse();
```

```
<?xml version="1.0" encoding="UTF-8"?>
<COUNTRIES>
    <COUNTRY>
        <NAME>SPAIN</NAME>
        <CAPITAL>MADRID</CAPITAL>
    </COUNTRY>
    <COUNTRY>
        <NAME>GERMANY</NAME>
        <CAPITAL>BERLIN</CAPITAL>
    </COUNTRY>
</COUNTRIES>
```

This will retrieve:

```
$array = [
  "COUNTRIES" => [
    "COUNTRY" => [
      0 => [
        "NAME" => "SPAIN"
        "CAPITAL" => "MADRID"
      ],
      1 => [
        "NAME" => "GERMANY"
        "CAPITAL" => "BERLIN"
      ]
    ]
  ]
]
```

### Set custom root key
```
$xmlToArray = new \Alvaro\Xmltoarray\XmlParser($xmlPath);
$xmlToArray->setRootElementText('TEST');
$arrayResult = $xmlToArray->parse();
```


This will retrieve:

```
$array = [
  "TEST" => [
    "COUNTRY" => [
      0 => [
        "NAME" => "SPAIN"
        "CAPITAL" => "MADRID"
      ],
      1 => [
        "NAME" => "GERMANY"
        "CAPITAL" => "BERLIN"
      ]
    ]
  ]
]
```


### Without root element

```
$xmlToArray = new \Alvaro\Xmltoarray\XmlParser($xmlPath);
$xmlToArray->includeRootElement(false);
$arrayResult = $xmlToArray->parse();
```

This will retrieve:

```
$array = [
  "COUNTRY" => [
    0 => [
      "NAME" => "SPAIN"
      "CAPITAL" => "MADRID"
    ],
    1 => [
      "NAME" => "GERMANY"
      "CAPITAL" => "BERLIN"
    ]
  ]
]
```

### Get the root element name

```
$xmlToArray = new \Alvaro\Xmltoarray\XmlParser($xmlPath);
$rootElement = $xmlToArray->getRootElementText(false);
```
This will retrieve:
```
COUNTRIES
```


--
Made with ❤️ in BCN