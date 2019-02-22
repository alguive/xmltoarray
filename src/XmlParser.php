<?php

declare(strict_types=1);

namespace Alvaro\Xmltoarray;

use SimpleXMLElement;

class XmlParser implements Parser
{

	/**
	 * @var string
	 */
	private $filePath;

	/**
	 * @var SimpleXMLElement
	 */
	private $xmlContent;

	/**
	 * @var string
	 */
	private $rootElementText;

	/**
	 * @var boolean
	 */
	private $rootElement = true;

	/**
	 * Constructor
	 *
	 * @param string $filePath
	 */
	public function __construct(string $filePath)
	{
		$this->filePath = $filePath;

		$this->setXmlContent();
	}

	/**
	 * Parse the XML file.
	 *
	 * @return array
	 */
	public function parse(): array
	{
		$xmlArray = $this->jsonDecode($this->jsonEncode($this->xmlContent));

		return $this->rootElement ? $this->buildWithRootElement($xmlArray) : $xmlArray;
	}

	/**
	 * Includes the root element into generated array
	 *
	 * @param bool $rootElement
	 *
	 * @return self
	 */
	public function includeRootElement(bool $rootElement): self
	{
		$this->rootElement = $rootElement;

		return $this;
	}

	/**
	 * Returns the XML root element
	 *
	 * @return string|null
	 */
	public function getRootElementText(): ?string
	{
		if (!$this->rootElementText || null === $this->rootElementText) {
			$this->setRootElementText();
		}

		return $this->rootElementText;
	}

	/**
	 * Setting root element text from the xml content
	 *
	 * @param string|null $rootElement
	 */
	public function setRootElementText(string $rootElement = null): self
	{
		if (null !== $this->xmlContent) {
			$this->rootElementText = (null === $rootElement) ? $this->xmlContent->getName() : $rootElement;
		}

		return $this;
	}

	/**
	 * Setting the XML file content.
	 */
	private function setXmlContent(): self
	{
		$this->xmlContent = simplexml_load_file($this->filePath);

		return $this;
	}

	/**
	 * Encode the Simple XML Element into a json.
	 *
	 * @param SimpleXMLElement $xml
	 *
	 * @return string
	 */
	private function jsonEncode(SimpleXMLElement $xml): string
	{
		return json_encode($xml);
	}

	/**
	 * Decodes the Json String.
	 *
	 * @param string $xml
	 *
	 * @return array
	 */
	private function jsonDecode(string $xml): array
	{
		return json_decode($xml, true);
	}

	/**
	 * Returns the array with the root element as the main array container.
	 *
	 * @param array $xmlArray
	 *
	 * @return array
	 */
	private function buildWithRootElement(array $xmlArray): array
	{
		$rootElement[$this->getRootElementText()] = $xmlArray;

		return $rootElement;
	}
}
