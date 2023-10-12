<?php

namespace AccessLayerMdS\DPM
{
    require 'loader.php';

    use AccessLayerMdS\Core\AccessLayerCore;
    use AccessLayerMdS\DPM\Record;
    use AccessLayerMdS\Interface\IRecord;
    use AccessLayerMdS\Model\RequestSendFile;
    use AccessLayerMdS\Model\ResponseSendFile;
    use AccessLayerMdS\Model\ResponseSingleRecord;
    use AccessLayerMdS\Model\ResponseStateVerify;
    use AccessLayerMdS\Service\ServiceGateway;
    use Exception;
    use HttpMethods;
    use ModOp;
    use ObjectName;
    use Parameters;

    class AccessLayer extends AccessLayerCore 
    {
        function __construct()
        {
            parent::setRemotePath(Parameters::REMOTE_PATH_DPM);
            parent::setEndpoint(Parameters::ENDPOINT);
            parent::setFluxName(Parameters::FLUSSO_DPM);
        }

        public function SingleRecord(int $IdClient, Record $record, ModOp $mod, string $annoRiferimento, string $periodoRiferimento, string $codiceRegione) : ResponseSingleRecord
        {
            try
            {
                $response = parent::SendSingleRecord($IdClient, $record, $mod, $annoRiferimento, $periodoRiferimento, $codiceRegione);
                $response->success = true;
            }
            catch(Exception $e)
            {
                // log $e->getMessage()
                $response = new ResponseSingleRecord();
                $response->success = false;
                $response->message = $e->getMessage();
                return $response;
            }
        }

        public function SendFile(string $idClient, string $nomeFile) : ResponseSendFile
        {
            try
            {
                $response = null;

                $endpoint = Parameters::ENDPOINT_API2->getParametersString();
                str_replace($endpoint, "{nomeFlusso}", parent::getFluxName());

                $vars = array('{remotePath}' => $this->remotePath, '{endpoint}' => $endpoint);
                $baseUri = strtr("{remotePath}/{endpoint}", $vars);

                $request = new RequestSendFile();
                $request->idClient = $idClient;
                $request->nomeFile = $nomeFile;

                $jsonRequest = json_encode($request); 

                $service = new ServiceGateway($baseUri);
                $responseApi = $service->callApiGateway(HttpMethods::POST, "", $jsonRequest);

                if($responseApi != null) {
                    $response = parent::cast(ObjectName::ResponseSendFile, $responseApi);
                    $response->success = true;
                } else {
                    throw new Exception("${baseUri} - response error.");
                }
            }
            catch (Exception $e) {
                $response = new ResponseSendFile();
                $response->success = false;
                $response->message = $e->getMessage();
            }

            return $response;
        }

        public function StateVerify(string $identificativoSoggettoAlimentante,
                                    string $regioneSoggettoAlimentante,
                                    string $cap,
                                    string $codiceSoggettoAlimentante,
                                    string $indirizzo)
        {
            try
            {
                $response = null;

                $endpoint = Parameters::ENDPOINT_API3->getParametersString();
                str_replace($endpoint, "{nomeFlusso}", parent::getFluxName());
                str_replace($endpoint, "{identificativoSoggettoAlimentante}", $identificativoSoggettoAlimentante);

                $vars = array('{$remotePath}' => $this->remotePath, '{$endpoint}' => $this->endpoint);
                $baseUri = strtr("{remotePath}/{endpoint}", $vars);    

                $queryParams = [];    
                if ($regioneSoggettoAlimentante != null)
                {
                   $queryParams["regioneSoggettoAlimentante"] = $regioneSoggettoAlimentante; 
                }
                if ($cap != null)
                {
                    $queryParams["cap"] = $cap; 
                }
                if ($codiceSoggettoAlimentante != null)
                {
                   $queryParams["codiceSoggettoAlimentante"] = $codiceSoggettoAlimentante; 
                }
                if ($indirizzo != null)
                {
                    $queryParams["indirizzo"] = $indirizzo; 
                }
                
                $service = new ServiceGateway($baseUri);
                $responseApi = $service->callApiGateway(HttpMethods::GET, "info", $queryParams);

                if($responseApi != null) {
                    $response = parent::cast(ObjectName::ResponseStateVerify, $responseApi);
                    $response->success = true;
                } else {
                    throw new Exception("${baseUri} - response error.");
                }
            }
            catch (Exception $e) {
                $response = new ResponseStateVerify();
                $response->success = false;
                $response->message = $e->getMessage();
            }

            return $response;
        }
    }

}