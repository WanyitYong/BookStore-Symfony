<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepageResponseCodeOkay()
    { // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();

    // Assert
        $client->request($httpMethod, $url);
    // Assert
        $this->assertSame( Response::HTTP_OK, $client->getResponse()->getStatusCode() );
    }
    public function testHomepageContentContainsHelloWorld()
    { // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Home Page';


        // Assert
        $client->request($httpMethod, $url);

        // to lower case
        $searchTextLowerCase = strtolower($searchText);
        $contentLowerCase = strtolower($content);
        // Assert
        $this->assertContains( $searchTextLowerCase, $contentLowerCase );

    }

    /**
     * @dataProvider basicPagesTextProvider
     */
    public function testPublicPagesContainBasicText($url, $exepctedLowercaseText)
    { // Arrange
        $httpMethod = 'GET'; $client = static::createClient();
        // Act
        $client->request($httpMethod, $url); $content =
        $client->getResponse()->getContent(); $statusCode =
        $client->getResponse()->getStatusCode();

        // to lower case
        $contentLowerCase = strtolower($content);
        // Assert - status code 200
        $this->assertSame(Response::HTTP_OK, $statusCode);
        // Assert - expected content
        $this->assertContains( $exepctedLowercaseText, $contentLowerCase );
}
    public function basicPagesTextProvider()
    {
        return [ ['/', 'Home'], ['/about', 'About'], ];
    }

}
