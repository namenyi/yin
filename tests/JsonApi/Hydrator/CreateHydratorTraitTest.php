<?php
namespace WoohooLabsTest\Yin\JsonApi\Hydrator;

use PHPUnit_Framework_TestCase;
use WoohooLabs\Yin\JsonApi\Request\Request;
use WoohooLabsTest\Yin\JsonApi\Utils\StubCreateHydrator;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Stream;

class CreateHydratorTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \WoohooLabs\Yin\JsonApi\Exception\ResourceTypeMissing
     */
    public function testHydrateWhenBodyEmpty()
    {
        $body = [];

        $hydrator = $this->createHydrator(false, "1");
        $hydrator->hydrateForCreate($this->createRequest($body), []);
    }

    /**
     * @expectedException \WoohooLabs\Yin\JsonApi\Exception\ResourceTypeMissing
     */
    public function testHydrateWhenBodyDataEmpty()
    {
        $body = [
            "data" => []
        ];

        $hydrator = $this->createHydrator(false, "1");
        $hydrator->hydrateForCreate($this->createRequest($body), []);
    }

    public function testHydrateWhenGeneratingId()
    {
        $type = "user";
        $id = "1";
        $body = [
            "data" => [
                "type" => $type
            ]
        ];

        $hydrator = $this->createHydrator(false, $id);
        $domainObject = $hydrator->hydrateForCreate($this->createRequest($body), []);
        $this->assertEquals(["id" => $id], $domainObject);
    }

    /**
     * @expectedException \WoohooLabs\Yin\JsonApi\Exception\ClientGeneratedIdNotSupported
     */
    public function testHydrateWhenBodyDataIdNotSupported()
    {
        $type = "user";
        $id = "1";
        $body = [
            "data" => [
                "type" => $type,
                "id" => $id
            ]
        ];

        $hydrator = $this->createHydrator(true, $id);
        $hydrator->hydrateForCreate($this->createRequest($body), []);
    }

    public function testHydrateBodyDataId()
    {
        $type = "user";
        $id = "1";
        $body = [
            "data" => [
                "type" => $type,
                "id" => $id
            ]
        ];

        $hydrator = $this->createHydrator(false, $id);
        $domainObject = $hydrator->hydrateForCreate($this->createRequest($body), []);
        $this->assertEquals(["id" => $id], $domainObject);
    }

    private function createRequest(array $body)
    {
        $psrRequest = new ServerRequest();
        $psrRequest = $psrRequest
            ->withParsedBody($body)
            ->withBody(new Stream("php://memory", "rw"));
        $psrRequest->getBody()->write(json_encode($body));

        $request = new Request($psrRequest);

        return $request;
    }

    /**
     * @param bool $clientGeneratedIdException
     * @param string $generatedId
     * @return \WoohooLabs\Yin\JsonApi\Hydrator\CreateHydratorTrait
     */
    private function createHydrator($clientGeneratedIdException = false, $generatedId = "")
    {
        return new StubCreateHydrator($clientGeneratedIdException, $generatedId);
    }
}
