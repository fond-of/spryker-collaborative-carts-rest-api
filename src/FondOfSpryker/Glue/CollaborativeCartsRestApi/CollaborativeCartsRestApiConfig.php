<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi;

class CollaborativeCartsRestApiConfig
{
    public const RESOURCE_COLLABORATIVE_CARTS = 'collaborative-carts';

    public const CONTROLLER_COLLABORATIVE_CARTS = 'collaborative-carts-resource';

    public const ACTION_COLLABORATIVE_CARTS_POST = 'post';

    public const COLLABORATIVE_CARTS_ACTION_CLAIM = 'action';
    public const COLLABORATIVE_CARTS_ACTION_RELEASE = 'release';

    public const RESPONSE_CODE_COLLABORATIVE_CARTS_UNKNOWN_ERROR = '100';
    public const RESPONSE_CODE_COLLABORATIVE_CARTS_NOT_FOUND = '101';
    public const RESPONSE_COD_COLLABORATIVE_CARTS_MISSING_CART_ID = '102';


    public const RESPONSE_DETAIL_COLLABORATIVE_CARTS_UNKNOWN_ERROR = 'Unknown error.';
    public const RESPONSE_DETAIL_COLLABORATIVE_CARTS_NOT_FOUND = 'Could not find quote to claim.';
    public const RESPONSE_DETAIL_COLLABORATIVE_CARTS_MISSING_CART_ID = 'MIssing cart id';

}
