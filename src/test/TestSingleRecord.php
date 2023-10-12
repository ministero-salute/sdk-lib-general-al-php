<?php

namespace AccessLayerMdS\Test {

    require __DIR__ . "/../core/Base.php";
    require __DIR__ . "/../interface/IAccessLayer.php";
    require __DIR__ . "/../interface/IRecord.php";
    require __DIR__ . "/../core/AccessLayerCore.php";
    require __DIR__ . "/../dpm/AccessLayer.php";
    require __DIR__ . "/../dpm/Record.php";
    require __DIR__ . "/../service/BaseService.php";
    require __DIR__ . "/../service/ServiceGateway.php";
    require __DIR__ . "/../enum/HttpMethods.php";
    require __DIR__ . "/../enum/Status.php";
    require __DIR__ . "/../enum/ModOp.php";
    require __DIR__ . "/../model/request/RequestSingleRecord.php";
    require __DIR__ . "/../model/response/ResponseSingleRecord.php";


    use AccessLayerMdS\DPM\AccessLayer;
    use AccessLayerMdS\DPM\Record;
    use AccessLayerMdS\Model\ResponseSingleRecord;
    use ModOp;
    use PHPUnit\Framework\TestCase;

    class TestSingleRecord extends TestCase
    {
        /**
         * @dataProvider singleRecordProviderInstance
         */
        public function testSingleRecordInstance($idClient, $record, $modOp, $expected)
        {
            $accessLayerDPM = new AccessLayer();
            $response = $accessLayerDPM->SendSingleRecord($idClient, $record, $modOp);
            $this->assertInstanceOf($expected, $response);  
        }

        /**
         * @dataProvider singleRecordProviderError
         */
        public function testSingleRecordResultError($idClient, $record, $modOp, $expected)
        {
            $accessLayerDPM = new AccessLayer();
            $response = $accessLayerDPM->SendSingleRecord($idClient, $record, $modOp);
            $this->assertEquals($expected, $response);  
        }


        /**
         * @dataProvider singleRecordProviderOk
         */
        public function testSingleRecordResulOk($idClient, $record, $modOp, $expected)
        {
            $accessLayerDPM = new AccessLayer();
            $response = $accessLayerDPM->SendSingleRecord($idClient, $record, $modOp);
            $this->assertEquals($expected->isValidato, $response->isValidato);  
        }

        public function singleRecordProviderInstance()
        {
            $record = new Record();
            return [
                [1, $record, ModOp::Test, "AccessLayerMdS\Model\ResponseSingleRecord"]
            ];
        }

        public function singleRecordProviderError()
        {
            $response = new ResponseSingleRecord();
            $response->isValidato = false;
            $record = new Record();
            $record->dataSottoscrizione = "10/10/2010";
            return [
                [1, $record, ModOp::Test, $response]
            ];
        }

        public function singleRecordProviderOk()
        {
            $response = new ResponseSingleRecord();
            $response->isValidato = true;
            $record = new Record();
            return [
                [1, $record, ModOp::Test, $response]
            ];
        }

    }
}
?>