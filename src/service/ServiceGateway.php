<?php
namespace AccessLayerMdS\Service {

    use Exception;
    use GuzzleHttp\Exception\GuzzleException;
    use HttpMethods;
    use Status;

    class ServiceGateway extends BaseService {

        public function __construct(string $baseUri) {
            parent::initClient($baseUri);
        }

        public function callApiGateway(HttpMethods $httpMethod, string $uri, string|array $params) : mixed {
            try {
                if($httpMethod->getHttpValue()) {
                    $response = $this->client->request($httpMethod->getHttpMethod(), $uri, [ 'json' => $params ]);
                } else {
                    $response = $this->client->request($httpMethod->getHttpMethod(), $uri, [ 'query' => $params ]);
                }
                $code = $response->getStatusCode();
                $status = Status::OK;
                if($code == $status->getStatusCode()) {
                    if ($body = $response->getBody()) {
                        return json_decode($body->getContents());
                    }
                    return null;
                }
                return null;
            } catch(GuzzleException $e) {
                throw new Exception("callApiGateway : ". $e);
            }    
        }

    }    
}

?>