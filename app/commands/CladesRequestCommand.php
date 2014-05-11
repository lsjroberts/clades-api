<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CladesRequestCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clades:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request an api endpoint';

    public function fire()
    {
        $endpoint = $this->argument('endpoint');
        $request = Request::instance();

        $request->server->set('HTTP_ACCEPT', 'application/json');
        $request->server->set('REQUEST_URI', $endpoint);

        $response = Route::dispatch($request);

        $content = json_decode($response->getContent());

        if (isset($content->data))
        {
            if (is_array($content->data))
            {
                list($headers, $rows) = array_divide($content->data);
            }
            else
            {
                list($headers, $rows) = array_divide(get_object_vars($content->data));
                $rows = array($rows);
            }

            foreach ($rows as &$row)
            {
                // $row = $recursiveImplode($row);
                foreach ($row as &$item)
                {
                    if (is_object($item)) {
                        $item = $this->recursiveImplode(get_object_vars($item));
                    } elseif (is_array($item)) {
                        $item = $this->recursiveImplode($item);
                    }
                }
            }

            $table = $this->getHelperSet()->get('table');
            $table->setHeaders($headers)->setRows($rows);
            $table->render($this->getOutput());
        }
        elseif (isset($content->error))
        {
            $this->error(sprintf("%s: %s", $content->error->code, $content->error->message));
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('endpoint', InputArgument::REQUIRED, 'Endpoint to request, e.g. /taxa/1'),
        );
    }

    protected function recursiveImplode($array)
    {
        $string = "";

        foreach ($array as $key => $item) {
            if (is_object($item)) {
                $string .= $this->recursiveImplode(get_object_vars($item)) . "\n\n";
            } elseif (is_array($item)) {
                $string .= $this->recursiveImplode($item) . "\n";
            } else {
                $string .= $key . ': ' . $item . "\n";
            }
        }

        $string = substr($string, 0, -1);

        return $string;
    }

}