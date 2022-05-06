<?php

namespace App\Http\Meta;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PaginationMeta',
    description: "Pagination meta",
    properties: [
        new OA\Property(
            property: 'current_page',
            description: "Current page",
            type: 'integer',
            format: 'int32',
            example: 1
        ),
        new OA\Property(
            property: 'last_page',
            description: "Last page",
            type: 'integer',
            format: 'int32',
            example: 2
        ),
        new OA\Property(
            property: 'from',
            description: "From",
            type: 'integer',
            format: 'int32',
            example: 1
        ),
        new OA\Property(
            property: 'to',
            description: "To",
            type: 'integer',
            format: 'int32',
            example: 2
        ),
        new OA\Property(
            property: 'per_page',
            description: "Per page",
            type: 'integer',
            format: 'int32',
            example: 2
        ),
        new OA\Property(
            property: 'total',
            description: "Total",
            type: 'integer',
            format: 'int32',
            example: 4
        ),
        new OA\Property(
            property: 'path',
            description: "Path",
            type: 'string',
            format: 'uri',
            example: 'http://localhost/api/v1/cakes?page=1',
        ),
    ],
    type: 'object'
)]
class PaginationMeta
{

}
