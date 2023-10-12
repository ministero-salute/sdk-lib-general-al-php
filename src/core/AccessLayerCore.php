<?php
namespace AccessLayerMdS\Core
{
    use AccessLayerMdS\Interface\IRecord;
    use AccessLayerMdS\Model\RequestFlux;
    use AccessLayerMdS\Model\RequestSingleRecord;
    use AccessLayerMdS\Model\ResponseFlux;
    use AccessLayerMdS\Model\ResponseGetInfo;
    use AccessLayerMdS\Model\ResponseSendFile;
    use AccessLayerMdS\Model\ResponseSingleRecord;
    use AccessLayerMdS\Service\ServiceGateway;
    use Exception;
    use HttpMethods;
    use ModOp;
    use ObjectName;

    class AccessLayerCore extends Base
    {

        private string $remotePath;
        private string $fluxName;
        private string $endpoint;

        public function Init(string $host)
        {
            $this->remotePath = $host;
        }

        public function SendFlux(int $idClient, string $path, ModOp $mod, string $annoRiferimento, string $periodoRiferimento, string $codiceRegione) : ResponseFlux
        {            
            try
            {
                $response = null;

                $vars = array('{remotePath}' => $this->remotePath, '{endpoint}' => $this->endpoint, '{fluxName}' => $this->fluxName);
                $baseUri = strtr("{remotePath}/{endpoint}/{fluxName}", $vars);

                $request = new RequestFlux();
                $request->idClient = $idClient;
                $request->nomeFile = $path;
                $request->modalitaOperativa = $mod->getModOpString();
                $request->annoRiferimento = $annoRiferimento;
                $request->periodoRiferimento = $periodoRiferimento;
                $request->codiceRegione = $codiceRegione;

                $jsonRequest = json_encode($request); 

                $service = new ServiceGateway($baseUri);
                $responseApi = $service->callApiGateway(HttpMethods::POST, "", $jsonRequest);

                if($responseApi != null) {
                    $response = parent::cast(ObjectName::ResponseFlux, $responseApi);
                    $response->success = true;
                } else {
                    throw new Exception("${baseUri} - response error.");
                }
            }
            catch (Exception $e) {
                $response = new ResponseFlux();
                $response->success = false;
                $response->message = $e->getMessage();
            }

            return $response;
        }

        protected function SendSingleRecord(int $idClient, IRecord $record, ModOp $mod, string $annoRiferimento, string $periodoRiferimento, string $codiceRegione) : ResponseSingleRecord
        {
            try 
            {
                $response = null;

                $vars = array('{remotePath}' => $this->remotePath, '{endpoint}' => $this->endpoint, '{fluxName}' => $this->fluxName);
                $baseUri = strtr("{remotePath}/{endpoint}/{fluxName}", $vars);

                $request = new RequestSingleRecord();
                $request->idClient = strval($idClient);
                $request->modalitaOperativa = $mod->getModOpString();
                $request->recordDto = $record;
                $request->annoRiferimento = $annoRiferimento;
                $request->periodoRiferimento = $periodoRiferimento;
                $request->codiceRegione = $codiceRegione;

                $jsonRequest = json_encode($request); 

                $service = new ServiceGateway($baseUri);
                $responseApi = $service->callApiGateway(HttpMethods::POST, "record", $jsonRequest);

                if($responseApi != null) {
                    $response = parent::cast(ObjectName::ResponseSingleRecord, $responseApi);
                    $response->success = true;
                } else {
                    throw new Exception("${baseUri} - response error.");
                }
            }
            catch (Exception $e) {
                $response = new ResponseSingleRecord();
                $response->success = false;
                $response->message = $e->getMessage();
            }

            return $response;
        }

        public function GetInfo(int $idClient, int $idRun) : ResponseGetInfo
        {             
            try 
            {
                $response = null;
                
                $vars = array('{$remotePath}' => $this->remotePath, '{$endpoint}' => $this->endpoint, '{$fluxName}' => $this->fluxName);
                $baseUri = strtr("{remotePath}/{endpoint}/{fluxName}", $vars);    

                if ($idClient == 0 && $idRun == 0) {
                    throw new Exception("GetInfo not start");
                }

                $queryParams = [];    
                if ($idClient != 0) {
                   $queryParams["idClient"] = $idClient; 
                } if ($idRun != 0) {
                    $queryParams["idRun"] = $idRun; 
                }
                
                $service = new ServiceGateway($baseUri);
                $responseApi = $service->callApiGateway(HttpMethods::GET, "info", $queryParams);

                if ($responseApi != null) {
                    $response = parent::cast(ObjectName::ResponseGetInfo, $responseApi);
                    $response->success = true;
                } else {
                    throw new Exception("${baseUri} - response error.");
                }
            }
            catch (Exception $e) {
                $response = new ResponseGetInfo();
                $response->success = false;
                $response->message = $e->getMessage();
            }
            
            return $response;
        }

        public function getRemotePath() {
            return $this->remotePath;
        }

        /**
         * Set the value of RemotePath
         *
         * @return  self // why?
         */ 
        public function setRemotePath($remotePath) {
            $this->remotePath = $remotePath->getParametersString();
            return $this;
        }

        public function getFluxName() {
            return $this->fluxName;
        }

        /**
         * Set the value of fluxName
         *
         * @return  self // why?
         */ 
        public function setFluxName($fluxName) {
            $this->fluxName = $fluxName->getParametersString();
            return $this;
        }

        public function getEndpoint(){
            return $this->endpoint;
        }

        /**
         * Set the value of endpoint
         *
         * @return  self // why?
         */ 
        public function setEndpoint($endpoint){
            $this->endpoint = $endpoint->getParametersString();
            return $this;
        }
    }
}

?>