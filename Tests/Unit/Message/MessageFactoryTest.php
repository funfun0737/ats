<?php
namespace PAGEmachine\Ats\Tests\Unit\Message;

use PAGEmachine\Ats\Domain\Model\Application;
use PAGEmachine\Ats\Message\MessageFactory;
use PAGEmachine\Ats\Message\ReplyMessage;
use PAGEmachine\Ats\Message\UndefinedMessageException;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/*
 * This file is part of the PAGEmachine ATS project.
 */

/**
 * Testcase for MessageFactory
 */
class MessageFactoryTest extends UnitTestCase
{
    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * Set up this testcase
     */
    protected function setUp()
    {
        $this->messageFactory = new MessageFactory();

    }

    /**
     * @test
     */
    public function createsMessageForType() {

        $message = $this->prophesize(ReplyMessage::class);
        $objectManager = $this->prophesize(ObjectManager::class);
        $this->inject($this->messageFactory, "objectManager", $objectManager->reveal());

        $application = new Application();

        $objectManager->get(ReplyMessage::class)->shouldBeCalled()->willReturn($message->reveal());
        $message->setApplication($application)->shouldBeCalled();

        $this->assertEquals($message->reveal(), $this->messageFactory->createMessage("reply", $application));
    }

    /**
     * @test
     */
    public function throwsErrorIfInvalidMessageTypeisGiven() {

        $this->expectException(UndefinedMessageException::class);
        $this->expectExceptionCode(1489678614);

        $this->messageFactory->createMessage("foobar", new Application());
    }
    
}
