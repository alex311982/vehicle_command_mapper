<?php

namespace Framework\Command;

/**
 * Interface InterfaceCommand
 * @package Framework\Command
 */
interface InterfaceCommand {
    /**
     * @return InterfaceCommand
     */
    function execute() : InterfaceCommand;
}
