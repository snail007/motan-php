<?php
namespace Motan;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-01-09 at 00:43:01.
 */
class ClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Client
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $url = new \Motan\URL(DEFAULT_TEST_URL);
        $url->setConnectionTimeOut(50000);
        $url->setReadTimeOut(50000);
        $this->object = new Client($url);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Motan\Client::getEndPoint
     * @todo   Implement testGetEndPoint().
     */
    public function testGetEndPoint()
    {
        $params = [
            'hello'=>'motan-php',
            'a'=>'b'
        ];
        $this->object->doCall('Hello', $params);
        $ep = $this->object->getEndPoint();
        $this->assertEquals($ep->getResponseHeader(), $this->object->getResponseHeader());
    }

    /**
     * @covers Motan\Client::getResponseHeader
     * @todo   Implement testGetResponseHeader().
     */
    public function testGetResponseHeader()
    {
        $params = [
            'hello'=>'motan-php',
            'a'=>'b'
        ];
        $this->object->doCall('Hello', $params);
        $resp_header = $this->object->getResponseHeader();
        $this->assertEquals($resp_header->getMagic(), 0xF1F1);
    }

    /**
     * @covers Motan\Client::getResponseMetadata
     * @todo   Implement testGetResponseMetadata().
     */
    public function testGetResponseMetadata()
    {
        $params = [
            'hello'=>'motan-php',
            'a'=>'b'
        ];
        $this->object->doCall('Hello', $params);
        $rs = $this->object->getResponseMetadata();
        if (defined('MESH_CALL')) {
            $this->assertEquals($rs, []);
        }
        else {
            $this->assertEquals($rs, []);
        }
    }

    /**
     * @covers Motan\Client::getResponseException
     * @todo   Implement testGetResponseException().
     */
    public function testGetResponseException()
    {
        $this->object->doCall('HelloX', 222, 123, 124, ['string','arr']);
        $rs = $this->object->getResponseException();
        if (defined('MESH_CALL')) {
            $this->assertEquals($rs, '{"errcode":500,"errmsg":"FailOverHA call fail 1 times. Exception: provider call panic","errtype":1}');
        }
        else {
            $this->assertEquals($rs, '{"errcode":500,"errmsg":"provider call panic","errtype":1}');
        }
    }

    /**
     * @covers Motan\Client::getResponse
     * @todo   Implement testGetResponse().
     */
    public function testGetResponse()
    {
        $params = [
            'hello'=>'motan-php',
            'a'=>'b'
        ];
        $this->object->doCall('Hello', $params);
        $rs = $this->object->getResponse();
        $this->assertObjectHasAttribute('_type', $rs);
    }

    /**
     * @covers Motan\Client::doCall
     * @todo   Implement testDoCall().
     */
    public function testDoCall()
    {
        $params = [
            'hello'=>'motan-php',
            'a'=>'b'
        ];
        $rs = $this->object->doCall('Hello', $params);
        if (defined('MESH_CALL')) {
            $this->assertEquals($rs, '[]-------[128 1 2 128 1 2]');
        }
        else {
            $this->assertEquals($rs, "[]-------[128 1 2 128 1 2]");
        }
    }

    /**
     * @covers Motan\Client::__call
     * @todo   Implement test__call().
     */
    public function test__call()
    {
        $params = [
            'hello'=>'motan-php',
            'a'=>'b'
        ];
        $rs = $this->object->Hello($params);
        $this->assertEquals($rs, "[]-------[128 1 2 128 1 2]");
    }

    /**
     * @covers Motan\Client::multiCall
     * @todo   Implement testMultiCall().
     */
    public function testMultiCall()
    {
        $url_str1 = 'motan2://127.0.0.1:9981/com.weibo.HelloMTService?group=motan-demo-rpc&method=Hello&a=a&b=b';
        $url_str2 = 'motan2://127.0.0.1:9981/com.weibo.HelloMTService?group=motan-demo-rpc&method=HelloW&a=a&b=b';
        $url1 = new \Motan\URL($url_str1);
        $url2 = new \Motan\URL($url_str2);
        $rs = $this->object->multiCall([$url1, $url2]);
        $this->assertEquals($rs[0], '[]-------[128 1 2 128 1 2]');

        $rs_empty = $this->object->multiCall([]);
        $this->assertEquals($rs_empty, []);
    }
}
