<?php

namespace AccessLayerMdS\SISM_TER
{
    require 'loader.php';

    use AccessLayerMdS\Core\AccessLayerCore;
    use AccessLayerMdS\Model\ResponseSingleRecord;
    use AccessLayerMdS\SISM_TER\Record;
    use Exception;
    use ModOp;
    use Parameters;

    class AccessLayer extends AccessLayerCore
    {
        function __construct()
        {
            parent::setRemotePath(Parameters::REMOTE_PATH_DPM);
            parent::setEndpoint(Parameters::ENDPOINT);
            parent::setFluxName(Parameters::FLUSSO_SISM_TER);
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
                $response = new ResponseSingleRecord();
                $response->success = false;
                $response->message = $e->getMessage();
            }

            return $response;
        }
    }
}