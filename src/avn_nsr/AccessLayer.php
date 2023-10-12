<?php

namespace AccessLayerMdS\AVN_NSR
{
    require 'loader.php';

    use AccessLayerMdS\Core\AccessLayerCore;
    use AccessLayerMdS\Interface\IRecord;
    use AccessLayerMdS\Model\ResponseSingleRecord;
    use AccessLayerMdS\AVN_NSR\Record;
    use Exception;
    use ModOp;
    use Parameters;

    class AccessLayer extends AccessLayerCore
    {
        function __construct()
        {
            parent::setRemotePath(Parameters::REMOTE_PATH_DPM);
            parent::setEndpoint(Parameters::ENDPOINT);
            parent::setFluxName(Parameters::FLUSSO_AVN_NSR);
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