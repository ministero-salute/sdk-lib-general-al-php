<?php

namespace AccessLayerMdS\MONITORAGGIO
{
    require 'loader.php';

    use AccessLayerMdS\Core\Base;
    use AccessLayerMdS\Model\ResponseGetInfoMonitoraggio;
    use AccessLayerMdS\Model\RequestGetInfoMonitoraggio;
    use AccessLayerMdS\Service\ServiceGateway;
    use Exception;
    use HttpMethods;
    use Parameters;
    use ObjectName;

    class AccessLayer extends Base
    {
        private string $remotePath;
        private string $endpoint;

        public function getRemotePath() {
            return $this->remotePath;
        }

        private function setRemotePath($remotePath) {
            $this->remotePath = $remotePath->getParametersString();
            return $this;
        }

        public function getEndpoint(){
            return $this->endpoint;
        }

        private function setEndpoint($endpoint){
            $this->endpoint = $endpoint->getParametersString();
            return $this;
        }

        function __construct()
        {
            $this->setEndpoint(Parameters::ENDPOINT_MONITORAGGIO);
        }

        public function Init(string $host)
        {
            $this->setRemotePath($host);
        }

        public function GetInfo(array $idsUpload, string $nomeFlusso, int $idRun) : ResponseGetInfoMonitoraggio
        {
            $response = null;

            try
            {
                $this->ValidateInit();

                if (is_array($idsUpload) == false || empty($idsUpload))
                    return new ResponseGetInfoMonitoraggio();

                $vars = array('{remotePath}' => $this->remotePath, '{endpoint}' => $this->endpoint);
                $baseUri = strtr("{remotePath}/{endpoint}", $vars);

                $querystring = '?';

                $querystring .= join(',', $idsUpload);

                if (isset($nomeFlusso) && $nomeFlusso !== '') {
                    $querystring .= '&nomeFlusso=' . $nomeFlusso;
                }

                if (isset($idRun) && $idRun !== 0) {
                    $querystring .= '&idRun=' . $idRun;
                }

                $request = new RequestGetInfoMonitoraggio();
                $request->idsUpload = $idsUpload;
                $request->nomeFlusso = $nomeFlusso;
                $request->idRun = $idRun;
                $jsonRequest = json_encode($request); 

                $service = new ServiceGateway($baseUri);
                $responseApi = $service->callApiGateway(HttpMethods::POST, "", $jsonRequest);

                if($responseApi != null) {
                    $response = parent::cast(ObjectName::ResponseGetInfoMonitoraggio, $responseApi);
                    $response->success = true;
                } else {
                    throw new Exception("${baseUri} - response error.");
                }
            }
            catch(Exception $e)
            {
                $response = new ResponseGetInfoMonitoraggio();
                $response->success = false;
                $response->message = $e->getMessage();
            }

            return $response;
        }

        private function ValidateInit()
        {
            if ($this->getRemotePath() == null) throw new Exception('Impostare AccessLayer::RemotePath.');
        }
    }
}