<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi;

class CollaborativeCartsRestApiConfig
{
    public const RESOURCE_COLLABORATIVE_CARTS = 'collaborative-carts';

    public const CONTROLLER_COLLABORATIVE_CARTS = 'collaborative-carts-resource';

    public const ACTION_COLLABORATIVE_CARTS_POST = 'post';

    public const ACTION_CLAIM = 'claim';
    public const ACTION_RELEASE = 'release';

    public const RESPONSE_CODE_CART_ID_MISSING = '4500';
    public const RESPONSE_CODE_INVALID_ACTION = '4501';
    public const RESPONSE_CODE_NOT_CLAIMED = '4502';
    public const RESPONSE_CODE_NOT_RELEASED = '4503';

    public const RESPONSE_DETAIL_CART_ID_MISSING = 'Cart id is missing.';
    public const RESPONSE_DETAIL_INVALID_ACTION = 'Invalid value for action.';
    public const RESPONSE_DETAIL_NOT_CLAIMED = 'Cart could not be claimed.';
    public const RESPONSE_DETAIL_NOT_RELEASED = 'Cart could not be released.';
}
