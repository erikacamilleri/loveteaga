<?php     

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller {
    
    protected $statusCode = 200;
    
    protected $fractal;
    
    const CODE_WRONG_ARGS = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';
    const CODE_FORBIDDEN = 'GEN-GTFO';
    
    public function __construct() 
    {
        $this->fractal = new \League\Fractal\Manager();
    }
    
    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    
    protected function respondWithItem($item, $callback, $includes = '')
    {
        $transformedData = fractal()->item($item)->transformWith($callback)->parseIncludes($includes)->toArray();
        return $this->respondWithArray($transformedData);
    }
    
    protected function respondWithMeta($item, $callback, array $meta = [])
    {
        $transformedData = fractal()->item($item)->transformWith($callback)->toArray();
        return $this->respondWithArray(array_merge($transformedData, ['meta' => $meta]));
    }
    
    protected function respondWithCollection($collection, $callback, $includes = '')
    {
        $transformedData = fractal()->collection($collection)->transformWith($callback)->parseIncludes($includes)->toArray();
        return $this->respondWithArray($transformedData);
    }
    
    protected function respondWithArray(array $array, array $headers = [], $transformer = null)
    {
        if($transformer) {
            $array = call_user_func(array($transformer, 'transform'), $array);
        }
        return response()->json($array, $this->statusCode, $headers);
    }
    
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
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
    
    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
            ->respondWithError($message, self::CODE_FORBIDDEN);
    }
    
    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }
    
    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message, self::CODE_NOT_FOUND);
    }
    
    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
            ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }
    
    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
            ->respondWithError($message, self::CODE_WRONG_ARGS);
    }
}
