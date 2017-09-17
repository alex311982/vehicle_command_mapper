<?php

namespace Framework\Command;

abstract class AbstractCommand implements InterfaceCommand
{
    /**
     *
     * @var bool
     */
    protected $isExecuted = false;

    /**
     *
     * @var mixed
     */
    protected $response;

    /**
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     *
     * @return bool
     */
    public function isExecuted()
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
     * @return mixed | $response
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
     *  @return mixed | $response
     */
    abstract protected function processCommand();
}
