<?php
namespace WoohooLabs\Yin\Examples\Book\JsonApi\Resource;

use WoohooLabs\Yin\JsonApi\Transformer\AbstractResourceTransformer;

class RepresentativeResourceTransformer extends AbstractResourceTransformer
{
    /**
     * Provides information about the "type" member of the current resource.
     *
     * The method returns the type of the current resource.
     *
     * @param array $representative
     * @return string
     */
    public function getType($representative)
    {
        return "representative";
    }

    /**
     * Provides information about the "id" member of the current resource.
     *
     * The method returns the ID of the current resource which should be a UUID.
     *
     * @param array $representative
     * @return string
     */
    public function getId($representative)
    {
        return $representative["id"];
    }

    /**
     * Provides information about the "meta" member of the current resource.
     *
     * The method returns an array of non-standard meta information about the resource. If
     * this array is empty, the member won't appear in the response.
     *
     * @param array $representative
     * @return array
     */
    public function getMeta($representative)
    {
        return [];
    }

    /**
     * Provides information about the "links" member of the current resource.
     *
     * The method returns a new Links schema object if you want to provide linkage
     * data about the resource or null if it should be omitted from the response.
     *
     * @param array $representative
     * @return \WoohooLabs\Yin\JsonApi\Schema\Links|null
     */
    public function getLinks($representative)
    {
        return null;
    }

    /**
     * Provides information about the "attributes" member of the current resource.
     *
     * The method returns an array where the keys signify the attribute names,
     * while the values are callables receiving the domain object as an argument,
     * and they should return the value of the corresponding attribute.
     *
     * @param array $representative
     * @return array
     */
    public function getAttributes($representative)
    {
        return [
            "name" => function (array $representative) {
                return $representative["name"];
            },
            "email" => function (array $representative) {
                return $representative["email"];
            },
        ];
    }

    /**
     * Returns an array of relationship names which are included in the response by default.
     *
     * @param array $representative
     * @return array
     */
    public function getDefaultIncludedRelationships($representative)
    {
        return [];
    }

    /**
     * Provides information about the "relationships" member of the current resource.
     *
     * The method returns an array where the keys signify the relationship names,
     * while the values are callables receiving the domain object as an argument,
     * and they should return a new relationship instance (to-one or to-many).
     *
     * @param array $representative
     * @return array
     */
    public function getRelationships($representative)
    {
        return [];
    }
}
