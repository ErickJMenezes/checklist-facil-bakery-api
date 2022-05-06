<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Http\Meta;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PaginationLinks',
    description: "Pagination links",
    properties: [
        new OA\Property(
            property: 'first',
            description: "First page",
            type: "string",
            format: "uri",
            example: "http://localhost/api/v1/cakes?page=1",
        ),
        new OA\Property(
            property: 'last',
            description: "Last page",
            type: "string",
            format: "uri",
            example: "http://localhost/api/v1/cakes?page=2"
        ),
        new OA\Property(
            property: 'next',
            description: "Next page",
            type: "string",
            format: "uri",
            example: "http://localhost/api/v1/cakes?page=2",
            nullable: true,
        ),
        new OA\Property(
            property: 'prev',
            description: "Previous page",
            type: "string",
            format: "uri",
            example: "http://localhost/api/v1/cakes?page=1",
            nullable: true,
        ),
    ],
    type: "object"
)]
class PaginationLinks
{
}
