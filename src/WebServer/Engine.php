<?php
/*
 * PSX is a open source PHP framework to develop RESTful APIs.
 * For the current version and informations visit <http://phpsx.org>
 *
 * Copyright 2010-2020 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace PSX\Engine\WebServer;

use PSX\Engine\DispatchInterface;
use PSX\Engine\EngineInterface;
use PSX\Http\Server\RequestFactory;
use PSX\Http\Server\ResponseFactory;
use PSX\Http\Server\Sender;

/**
 * Uses a classical PHP web server like Apache or Nginx. In this context we dont 
 * need to setup any web server instead the web server calls this code on every 
 * request. We get all request information from the global variables.
 * 
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class Engine implements EngineInterface
{
    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @inheritdoc
     */
    public function serve(DispatchInterface $dispatch): void
    {
        $requestFactory  = new RequestFactory($this->baseUrl);
        $responseFactory = new ResponseFactory();

        $response = $dispatch->route($requestFactory->createRequest(), $responseFactory->createResponse());

        (new Sender())->send($response);
    }
}
