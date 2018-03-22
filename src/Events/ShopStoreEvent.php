<?php


namespace SimpleShop\Store\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ShopStoreEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $storeId;

    /**
     * @var string
     */
    public $action = 'delete';

    /**
     * Create a new event instance.
     *
     * @param int $storeId
     * @param string $action
     */
    public function __construct(int $storeId, string $action = 'delete')
    {
        //
        $this->storeId = $storeId;
        $this->action = $action;
    }
}
