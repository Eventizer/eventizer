<?php

/**
 * Copyright 2014-2015 Eventizer
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
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or on http://eventizer.org/License-12c.html
 * 
 * Eventizer code core is based by https://livehelperchat.com/
 */

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 1);
@ini_set('session.gc_maxlifetime', 200000);
@ini_set('session.cookie_lifetime', 2000000);
@ini_set('session.cookie_httponly',1);

require_once "ezcomponents/Base/src/base.php"; // dependent on installation method, see below
spl_autoload_register(array('ezcBase','autoload'), true, false);

require_once "lib/vendor/autoload.php"; // dependent on installation method, see below

ezcBase::addClassRepository( './','./lib/autoloads');
erLhcoreClassSystem::init();

// Include global functions
include_once "lib/core/lhcore/lhglobalfunctions.php";

// your code here
ezcBaseInit::setCallback(
	'ezcInitDatabaseInstance',
	'erLhcoreClassLazyDatabaseConfiguration'
);

$Result = erLhcoreClassModule::moduleInit();

$tpl = erLhcoreClassTemplate::getInstance('pagelayouts/main.php');
$tpl->set('Result',$Result);

if (isset($Result['pagelayout'])) {
	$tpl->setFile('pagelayouts/'.$Result['pagelayout'].'.php');
}

echo $tpl->fetch();
