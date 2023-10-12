<?php

namespace AccessLayerMdS\DIR
{
    use AccessLayerMdS\Interface\IRecord;

    class Record implements IRecord
    {
        public string $RegioneErogante;
        public int $AnnoDiRiferimento;
        public int $MeseDiRiferimento;
        public string $CodiceAziendaSanitariaErogante;
        public int $TipoErogatore;
        public string $TipoStrutturaErogante;
        public string $CodiceStrutturaErogante;
        public string $IdentificativoAssistito;
        public int $ValiditaCodIdentAssistito;
        public int $TipologiaCodIdentAssistito;
        public string $DataNascitaAssistito;
        public string $SessoAssistito;
        public string $AslAssistito;
        public int $Cittadinanza;
        public string $StatoEsteroDiResidenza;
        public string $CodiceIstituzioneCompetente;
        public string $TipoOperazione;
        public string $TipoCanale;
        public string $CodiceEsenzione;
        public int $TipoErogazione;
        public int $TipoDiEsenzione;
        public int $TipoContatto;
        public string $IdContatto;
        public string $DataErogazione;
        public string $QuotaFissaAssistito;
        public string $QuotaPercentualeAssistito;
        public string $DataPrescrizione;
        public string $CostoServizioRicetta;
        public string $CodicePrescrittore;
        public string $TipoPrescrittore;
        public int $TipoFarmaco;
        public string $CodiceFarmaco;
        public string $Quantita;
        public int $FattoreDiConversione;
        public string $Targatura;
        public string $CostoAcquisto;
        public string $CostoServizio;
    }
}
