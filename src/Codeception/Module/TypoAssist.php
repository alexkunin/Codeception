<?php

namespace Codeception\Module;

use Codeception\Module as CodeceptionModule;
use Exception;
use ReflectionClass;
use ReflectionMethod;
use function sprintf;

class TypoAssist extends CodeceptionModule
{
    private function getCandidates($methodName)
    {
        $coreModules = [
            AMQP::class,
            Apc::class,
            Asserts::class,
            Cli::class,
            DataFactory::class,
            Db::class,
            Doctrine2::class,
            FTP::class,
            Filesystem::class,
            Laravel5::class,
            Lumen::class,
            Memcache::class,
            MongoDb::class,
            Phalcon::class,
            PhpBrowser::class,
            Queue::class,
            REST::class,
            Redis::class,
            SOAP::class,
            Sequence::class,
            Symfony::class,
            TypoAssist::class,
            WebDriver::class,
            Yii2::class,
            ZF2::class,
            ZendExpressive::class,
        ];

        $candidates = [];

        foreach ($coreModules as $class) {
            $r = new ReflectionClass($class);
            foreach ($r->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getName() === $methodName) {
                    $candidates[] = $class . '->' . $method->getName();
                }
            }
        }

        return $candidates;
    }

    public function __call($methodName, $arguments)
    {
        $message = sprintf(
            'Unknown method "%s" was called. Candidates: %s',
            $methodName,
            join(', ', $this->getCandidates($methodName))
        );
        $this->debug($message);
        // TODO: throw typed exception instead
        throw new Exception($message);
    }
}
