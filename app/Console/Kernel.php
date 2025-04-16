<?php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // Schedule the command to run weekly (for example)
    $schedule->command('reports:send-weekly')->weekly();
}

