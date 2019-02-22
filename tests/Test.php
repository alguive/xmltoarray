<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{

	protected $xmlParser;

	public function setUp()
	{
		$xmlPath = realpath('countries.xml');
		$this->xmlParser = new \Alvaro\Xmltoarray\XmlParser($xmlPath);
	}

	public function tearDown()
	{
		unset($this->xmlParser);
	}

	public function testXmlToBasicArray()
	{
		$xmlArray = $this->xmlParser->parse();
		$this->assertContainsOnly('array', $xmlArray);
	}

	public function testGetRootElementText()
	{
		$rootElement = $this->xmlParser->getRootElementText();

		$this->assertEquals('COUNTRIES', $rootElement);
	}

	public function testSetCustomRootElementText()
	{
		$customRootElement = 'CUSTOM';
		$this->xmlParser->setRootElementText($customRootElement);

		$rootElement = $this->xmlParser->getRootElementText();
		$this->assertEquals($customRootElement, $rootElement);
	}

	public function testWithCustomRootElement()
	{
		$customRootElement = 'CUSTOM';
		$this->xmlParser->setRootElementText($customRootElement);

		$xmlArray = $this->xmlParser->parse();
		$this->assertArrayHasKey($customRootElement, $xmlArray);
	}

}
