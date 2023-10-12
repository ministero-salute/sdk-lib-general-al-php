<?php
namespace AccessLayerMdS\Model
{
    use DateTime;

    class ResponseGetInfo extends BaseResponse
    {
        public string $idRun;
        public string $idClient;
        public array $idUploads;
        public string $tipoElaborazione;
        public string $modOperativa;
        public DateTime $dataInizioEsecuzione;
        public DateTime $dataFineEsecuzione;
        public string $statoEsecuzione;
        public string $fineAssociatiRun;
        public string $nomeFlusso;
        public int $numeroRecord;
        public int $numeroRecordAccettati;
        public int $numeroRecordScartati;
        public string $version;
        public DateTime $timestampCreazione;
        public string $utenza;
        public string $api;
        public string $identificativoSoggettoAlimentante;
        public string $tipoAtto;
        public string $numeroAtto;
        public string $tipoEsitoMds;
        public DateTime $dataRicevutaMds;
        public string $codiceRegione;
        public string $annoRiferimento;
        public string $periodoRiferimento;
        public string $nomeFileOutputMds;
        public string $esitoAcquisizioneFlusso;
        public string $codiceErroreInvioFlusso;
        public string $testoErroreInvioFlusso;
    } 
}
?>