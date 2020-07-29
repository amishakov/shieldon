<?php
/**
 * This file is part of the Shieldon package.
 *
 * (c) Terry L. <contact@terryl.in>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * php version 7.1.0
 * 
 * @category  Web-security
 * @package   Shieldon
 * @author    Terry Lin <contact@terryl.in>
 * @copyright 2019 terrylinooo
 * @license   https://github.com/terrylinooo/shieldon/blob/2.x/LICENSE MIT
 * @link      https://github.com/terrylinooo/shieldon
 * @see       https://shieldon.io
 */

declare(strict_types=1);

namespace Shieldon\FirewallTest\Panel;

if (!defined('SHIELDON_PANEL_BASE')) {
    define('SHIELDON_PANEL_BASE', '/firewall/panel');
}

class ConfigMethodsTraitTest extends \Shieldon\FirewallTest\ShieldonTestCase
{
    public function testSaveConfigCheckActionLoggerFalse()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveConfigCheckActionLogger');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [false]);

        $this->assertFalse($result);
    }

    public function testSaveConfigCheckActionLoggerFalseIsDisable()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('loggers.action.enable', false);

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveConfigCheckActionLogger');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveConfigCheckIptablesFalse()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveConfigCheckIptables');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [false]);

        $this->assertFalse($result);
    }

    public function testSaveConfigCheckIptablesIsDisable()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('iptables.enable', false);

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveConfigCheckIptables');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveConfigCheckDataDriverFalse()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('driver_type', 'file');

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveConfigCheckDataDriver');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [false]);

        $this->assertFalse($result);
    }

    public function testSaveConfigCheckDataDriverTrue()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('driver_type', 'file');

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveConfigCheckDataDriver');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveCofigCheckDataDriverRedis()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('drivers.redis.host', '127.0.0.1');
        $baseController->setConfig('drivers.redis.port', 6379);

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveCofigCheckDataDriverRedis');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveCofigCheckDataDriverRedisWithInalidSettings()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('drivers.redis.host', '127.0.0.1');
        $baseController->setConfig('drivers.redis.port', 1234);

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveCofigCheckDataDriverRedis');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertFalse($result);
    }

    public function testSaveCofigCheckDataDriverFile()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('drivers.file.directory_path', BOOTSTRAP_DIR . '/../tmp/shieldon');

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveCofigCheckDataDriverFile');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveCofigCheckDataDriverSqlLite()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('drivers.sqlite.directory_path', BOOTSTRAP_DIR . '/../tmp/shieldon');

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveCofigCheckDataDriverSqlLite');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveCofigCheckDataDriverMySql()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('drivers.mysql.host', '127.0.0.1');
        $baseController->setConfig('drivers.mysql.dbname', 'shieldon_unittest');
        $baseController->setConfig('drivers.mysql.user', 'shieldon');
        $baseController->setConfig('drivers.mysql.pass', 'taiwan');
        $baseController->setConfig('drivers.mysql.charset', 'utf8');

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveCofigCheckDataDriverMySql');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertTrue($result);
    }

    public function testSaveCofigCheckDataDriverMySqlWithInvaldeSettings()
    {
        $firewall = new \Shieldon\Firewall\Firewall();
        $baseController = new \Shieldon\Firewall\Panel\BaseController();
        $baseController->setConfig('drivers.mysql.host', '127.0.0.1');
        $baseController->setConfig('drivers.mysql.dbname', 'shieldon_unittest');
        $baseController->setConfig('drivers.mysql.user', 'user_not_exists');
        $baseController->setConfig('drivers.mysql.pass', 'password_not_correct');
        $baseController->setConfig('drivers.mysql.charset', 'utf8');

        $reflection = new \ReflectionObject($baseController);
        $method = $reflection->getMethod('saveCofigCheckDataDriverMySql');
        $method->setAccessible(true);
        $result = $method->invokeArgs($baseController, [true]);

        $this->assertFalse($result);
    }
}