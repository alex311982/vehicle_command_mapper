<?php

namespace Framework\Command;

interface InterfaceCommand {
    function execute() : InterfaceCommand;
}
