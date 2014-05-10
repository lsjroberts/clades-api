<?php namespace Clades;

use App;
use Input;
use Response;
use YamlDumper;
use BaseController;
use League\Fractal\Manager;
use League\Fractal\Cursor\Cursor;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use Illuminate\HTTP\Response as IlluminateResponse;

class ApiController extends BaseController
{
    const CODE_WRONG_ARGS = 'GENERIC-WRONG-ARGS';
    const CODE_NOT_FOUND = 'GENERIC-NOT-FOUND';
    const CODE_INTERNAL_ERROR = 'GENERIC-INTERNAL';
    const CODE_UNAUTHORIZED = 'GENERIC-UNAUTHORIZED';
    const CODE_FORBIDDEN = 'GENERIC-FORBIDDEN';
    const CODE_INVALID_MIME_TYPE = 'GENERIC-MIME-TYPE';

    protected $fractal;

    protected $statusCode = 200;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    public function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    public function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200)
        {
            trigger_error(
                "Why are you responding with an error on a 200?",
                E_USER_WARNING
            );
        }

        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message, self::CODE_FORBIDDEN);
    }

    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    public function errorNotFound($message = 'Resource not found')
    {
        return $this->setStatusCode(404)->respondWithError($message, self::CODE_NOT_FOUND);
    }

    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)->respondWithError($message, self::CODE_WRONG_ARGS);
    }

    /**
     * Respond to an api request with an array of data in the requested
     * content type. If the content type is not supported or invalid
     * return an error response as json.
     *
     * @param array $array
     * @param array $headers
     * @return IlluminateResponse
     */
    public function respondWithArray(array $array, array $headers = [])
    {
        $mimeParts = (array) explode(';', Input::server('HTTP_ACCEPT'));
        $mimeType = strtolower($mimeParts[0]);

        switch ($mimeType)
        {
            case 'application/json':
                $contentType = 'application/json';
                $content = json_encode($array);
                break;

            case 'application/x-yaml':
                $contentType = 'application/x-yaml';
                $dumper = new YamlDumper();
                $content = $dumper->dump($array, 2);
                break;

            default:
                $contentType = 'application/json';
                if (App::environment() == 'production')
                {
                    $content = json_encode([
                        'error' => [
                            'code' => static::CODE_INVALID_MIME_TYPE,
                            'http_code' => 415,
                            'message' => sprintf('Content of type %s is not supported', $mimeType)
                        ]
                    ]);
                }
                else
                {
                    $content = json_encode($array);
                }

                break;
        }

        $response = Response::make($content, $this->statusCode, $headers);
        $response->header('Content-Type', $contentType);

        return $response;
    }

}