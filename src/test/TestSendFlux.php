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
    require __DIR__ . "/../model/request/RequestFlux.php";
    require __DIR__ . "/../model/response/ResponseFlux.php";

    use AccessLayerMdS\DPM\AccessLayer;
    use ModOp;
    use PHPUnit\Framework\TestCase;

    class TestSendFlux extends TestCase
    {
        /**
         * @dataProvider sendFluxProvider
         */
        public function testSendFluxInstance($idClient, $path, $modOp, $expected)
        {
            $accessLayerDPM = new AccessLayer();
            $response = $accessLayerDPM->SendFlux($idClient, $path, $modOp);
            $this->assertInstanceOf($expected, $response);  
        }


        public function sendFluxProvider()
        {
            return [
                [1, "/path", ModOp::Test, "AccessLayerMdS\Model\ResponseFlux"]
            ];
        }
    }
}
?>