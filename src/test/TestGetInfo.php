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
    require __DIR__ . "/../model/request/RequestGetInfo.php";
    require __DIR__ . "/../model/response/ResponseGetInfo.php";

    use AccessLayerMdS\DPM\AccessLayer;
    use PHPUnit\Framework\TestCase;

    class TestGetInfo extends TestCase
    {
        /**
         * @dataProvider getinfoProviderInstance
         */
        public function testInfoInstance($idClient, $idRun, $expected)
        {
            $accessLayerDPM = new AccessLayer();
            $response = $accessLayerDPM->GetInfo($idClient, $idRun);
            $this->assertInstanceOf($expected, $response);  
        }


        public function getinfoProviderInstance()
        {
            return [
                [1, 2, "AccessLayerMdS\Model\ResponseGetInfo"]
            ];
        }
    }
}
?>