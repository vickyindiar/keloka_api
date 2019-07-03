<?php

return [
    "_HTTP_OK" => 200, //The request has succeeded. The information returned with the response is dependent on the method used in the request,
    "_HTTP_CREATED" => 201, //The request has been fulfilled, resulting in the creation of a new resource
    "_HTTP_ACCEPT" => 202, //The request has been accepted for processing, but the processing has not been completed.

    "_HTTP_BAD_REQUEST" => 400, //The request could not be understood by the server due to malformed syntax.
    "_HTTP_UNAUTHORIZED" => 401,
    "_HTTP_FORBIDDEN" => 403, //The request was valid, but the server is refusing action.
    "_HTTP_NOT_FOUND" => 404, //he requested resource could not be found but may be available in the future.
    "_HTTP_REQUEST_TIMEOUT" => 408, // The client did not produce a request within the time that the server was prepared to wait.

    "_HTTP_INTERNAL_SERVER_ERROR" => 500, //The server encountered an unexpected condition which prevented it from fulfilling the request.



];
