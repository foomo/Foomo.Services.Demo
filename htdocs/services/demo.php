<?php

Foomo\Services\RPC::create(new \Foomo\Services\Demo\Service)
	->serializeWith(new Foomo\Services\RPC\Serializer\JSON())
	->clientNamespace('DemoProxy')
	->run()
;