<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    protected $userRepository;
    protected $userService;

    public function setUp()
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userService = new UserService($this->userRepository);
    }

    public function testGetAmountWorksWithEmptyArray()
    {
        $this->userRepository->method('findAll')->willReturn([]);

        $amount = $this->userService->getAmount();

        $this->assertEquals(0, $amount);
    }

    public function testGetAmountWorksWith2Items()
    {
        $this->userRepository->method('findAll')->willReturn([
            $this->createMock(User::class),
            $this->createMock(User::class)
        ]);

        $amount = $this->userService->getAmount();

        $this->assertEquals(2, $amount);
    }
}
