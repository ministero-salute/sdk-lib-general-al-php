<?php

namespace AccessLayerMdS\AVN_SM
{
    use AccessLayerMdS\Interface\IRecord;

    class Record implements IRecord
    {
        public string $modalita;
        public string $tipoTrasmissione;
        public string $codRegione;
        public string $idAssistito;
        public string $tipoErogatore;
        public string $codStruttura;
        public string $codCondizioneSanitaria;
        public string $codCategoriaRischio;
        public string $codiceAICVaccino;
        public string $denomVaccino;
        public string $codTipoFormulazione;
        public string $viaSomministrazione;
        public string $lottoVaccino;
        public string $dataScadenza;
        public string $modalitaPagamento;
        public string $dataSomministrazione;
        public string $sitoInoculazione;
        public string $codiceComuneSomministrazione;
        public string $codiceAslSomministrazione;
        public string $codiceRegioneSomministrazione;
        public string $statoEsteroSomministrazione;
        public string $codiceAntigene;
        public int $dose;
        public int $validitaCI;
        public int $tipologiaCI;
        public string $sesso;
        public string $dataNascita;
        public string $codiceComuneResidenza;
        public string $codiceAslResidenza;
        public string $codiceRegioneResidenza;
        public string $statoEsteroResidenza;
        public string $dataTrasferimentoResidenza;
        public string $codiceComuneDomicilio;
        public string $codiceAslDomicilio;
        public string $codiceRegioneDomicilio;
        public string $cittadinanza;
        public string $dataDecesso;
    }
}
