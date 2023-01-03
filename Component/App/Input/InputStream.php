<?php
namespace App\Input;

use App\Utl\Utility;

class InputStream
{
    private string $command;
    private object $language;

    public function __construct()
    {
        $this->language = new Utility();
    }

    public function inputFromConsole(array $input): string
    {
        if (!isset($input[1])) {
            do {
                print ($this->language->lang("app.error_file_name"));
                $this->command = readline($this->language->lang("app.enter_file_name"));
            } while (empty ($this->command));
            return $this->command;
        }
        return $input[1];
    }

    public function exceptionHandler(String $message)
    {
        throw new \Exception($message);
    }
}
