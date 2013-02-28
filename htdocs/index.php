<?php

$geshi = new GeSHi(
	file_get_contents(\Foomo\Services\Demo\Module::getHtdocsDir('js/clientDemo.js')), 
	'javascript'
);

$highlightedJS = $geshi->parse_code();

echo \Foomo\HTMLDocument::getInstance()
	->setTitle('service proxy demo')
	->addJavascripts(array(
		'js/jquery-1.7.2.min.js',
		'services/demo.php/Foomo.Services.RPC/generateJQueryClient',
		'js/clientDemo.js'
	))
	->addStylesheet('h1 {font-size:14px;display:inline;}')
	->addBody('<h1>Foomo JS RPC client demo</h1>')
	->addBody('<pre>js/clientDemo.js</pre>')
	->addBody($highlightedJS)
;