<?php
namespace AccessLayerMdS\Model
{
    use AccessLayerMdS\Model\EsitiValidazione as ModelEsitiValidazione;

    class ResponseSingleRecord extends BaseResponse
    {
        public bool $isValidato;
        public ModelEsitiValidazione $esitiValidazione;
        public string $nomeTracciato;
        public string $idRun;
        public string $idClient;
    } 
}
?>