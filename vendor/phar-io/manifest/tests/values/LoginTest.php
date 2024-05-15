<?php
/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PharIo\Manifest;

use PHPUnit\Framework\TestCase;

/**
 * @covers PharIo\Manifest\Login
 */
class LoginTest extends TestCase {
    
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/auth/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

}
