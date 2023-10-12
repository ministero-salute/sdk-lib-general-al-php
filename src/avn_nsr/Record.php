<?php

namespace AccessLayerMdS\AVN_NSR
{
    use AccessLayerMdS\Interface\IRecord;

    class Record implements IRecord
    {
        public string $codIdAssistito;
        public string $modalita;
        public string $tipoTrasmissione;
        public string $codRegione;
        public int $validitaCI;
        public int $tipologiaCI;
        public string $sesso;
        public string $dataNascita;
        public string $codiceComuneResidenza;
        public string $codiceAslResidenza;
        public string $codiceRegioneResidenza;
        public string $statoResidenza;
        public string $dataTrasferimentoResidenza;
        public string $codiceComuneDomicilio;
        public string $codiceAslDomicilio;
        public string $codiceRegioneDomicilio;
        public string $cittadinanza;
        public string $dataDecesso;
        public string $codiceAntigene;
        public int $dose;
        public string $motivazione;
        public string $dataNonEffettuazione;
    }
}
