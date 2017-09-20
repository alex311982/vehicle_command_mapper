<?php

namespace Framework\Command;

/**
 * Class AbstractCommand
 * @package Framework\Command
 */
abstract class AbstractCommand implements InterfaceCommand
{
    /**
     *
     * @var bool
     */
    protected $isExecuted = false;

    /**
     *
     * @var bool
     */
    protected $response;

    /**
     *
     * @return bool
     */
    public function getResponse(): bool
    {
        return $this->response;
    }

    /**
     *
     * @return bool
     */
    public function isExecuted(): bool
    {
        return $this->isExecuted;
    }

    /**
     * This method will be invoked before Actual Command's execution
     */
    public function preExecution()
    {

    }

    /**
     * This method will be invoked after Actual Command's execution
     */
    public function postExecution()
    {

    }

    /**
     * Execute Command
     * @uses: processCommand()
     *
     * @param void
     * @return InterfaceCommand
     */
    public final function execute() : InterfaceCommand
    {
        $this->preExecution();
        $this->response = $this->processCommand();
        if ($this->response == true) {
            $this->isExecuted = true;
        }
        $this->postExecution();

        return $this;
    }

    /**
     * Abstract Method
     * Execute a Command
     *  @return bool
     */
    abstract protected function processCommand(): bool;
}
