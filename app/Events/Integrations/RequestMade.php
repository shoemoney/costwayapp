<?php

namespace App\Events\Integrations;

use App\Integrations\Http\Request;
use App\Integrations\Http\Response;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RequestMade
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /** @var \App\Integrations\Http\Request */
    public $request;

    /** @var \App\Integrations\Http\Response */
    public $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
